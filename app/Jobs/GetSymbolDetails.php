<?php

namespace App\Jobs;

use App\Services\HttpClient;
use App\Symbol;
use App\SymbolCountry;
use App\SymbolHolding;
use App\SymbolSector;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetSymbolDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $dataSourceBase = 'https://www.ssga.com';
    private $symbol;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Symbol $symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(HttpClient $client)
    {
        if (!empty($this->symbol->data_source)) {
            $response = $client->request('GET', $this->dataSourceBase.$this->symbol->data_source);
            $data = $response->getBody()->getContents();
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($data);
            $this->upsertHoldingInformation($doc);
            $this->upsertCountryInformation($doc);
            $this->upsertSectorInformation($doc);
        }
    }

    private function upsertHoldingInformation($doc)
    {
        $xpath = new DOMXPath($doc);
        $holdingsRawData = $xpath->query('//div[@data-fundcomponent][@class="fund-top-holdings "]//tr');
        if ($holdingsRawData->count() > 0) {
            $holdingData = [];
            foreach ($holdingsRawData as $holdingsRawDataItem) {
                $name = $xpath->query('.//td[@data-label="Name:"]', $holdingsRawDataItem)[0]->nodeValue ?? "";
                $shares = $xpath->query('.//td[@data-label="Shares Held:"]', $holdingsRawDataItem)[0]->nodeValue ?? 0;
                $weight = $xpath->query('.//td[@data-label="Weight:"]', $holdingsRawDataItem)[0]->nodeValue ?? 0;
                if (!empty($name)) {
                    $holdingData[] = [
                        'symbol_id' => $this->symbol->getKey(), 'holding_name' => $name,
                        'weight' => $this->formatWeight($weight), 'shares' => $this->formatShares($shares),
                    ];
                }
            }
            SymbolHolding::insertOnDuplicateKey($holdingData, [
                'shares', 'weight',
            ]);
            SymbolHolding::where('symbol_id', $this->symbol->getKey())->whereNotIn('holding_name',
                array_column($holdingData, 'holding_name'))->delete();
        }
    }

    private function formatWeight($weight)
    {
        return rtrim($weight, '%');
    }

    private function formatShares($shares)
    {
        return str_replace(',', '', $shares);
    }

    private function upsertCountryInformation($doc)
    {
        $geoData = $doc->getElementById('fund-geographical-breakdown');
        if (!empty($geoData)) {
            $geoData = json_decode($geoData->getAttribute('value'));
            $countryData = [];
            foreach ($geoData->attrArray as $row) {
                $countryData[] = [
                    'symbol_id' => $this->symbol->getKey(), 'country_name' => $row->name->value,
                    'weight' => $this->formatWeight($row->weight->value),
                ];
            }
            SymbolCountry::insertOnDuplicateKey($countryData, [
                'weight',
            ]);
            SymbolCountry::where('symbol_id', $this->symbol->getKey())->whereNotIn('country_name',
                array_column($countryData, 'country_name'))->delete();
        }
    }

    private function upsertSectorInformation($doc)
    {
        $sectorRawData = $doc->getElementById('fund-sector-breakdown');
        if (!empty($sectorRawData)) {
            $sectorRawData = json_decode($sectorRawData->getAttribute('value'));
            $sectorData = [];
            foreach ($sectorRawData->attrArray as $row) {
                $sectorData[] = [
                    'symbol_id' => $this->symbol->getKey(), 'sector_name' => $row->name->value,
                    'weight' => $this->formatWeight($row->weight->value),
                ];
            }
            SymbolSector::insertOnDuplicateKey($sectorData, [
                'weight',
            ]);
            SymbolSector::where('symbol_id', $this->symbol->getKey())->whereNotIn('sector_name',
                array_column($sectorData, 'sector_name'))->delete();
        }
    }
}
