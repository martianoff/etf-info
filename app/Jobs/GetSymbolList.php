<?php

namespace App\Jobs;

use App\Services\HttpClient;
use App\Symbol;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetSymbolList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $dataSource = 'https://www.ssga.com/bin/v1/ssmp/fund/fundfinder';
    private $dataCountry = 'us';
    private $dataLanguage = 'en';
    private $dataProduct = 'etfs';

    private $updateSymbolDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($updateSymbolDetails = false)
    {
        $this->updateSymbolDetails = $updateSymbolDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(HttpClient $client)
    {
        $response = $client->request('GET', $this->dataSource, [
            'query' => [
                'country' => $this->dataCountry,
                'language' => $this->dataLanguage,
                'role' => 'individual',
                'product' => $this->dataProduct,
                'ui' => 'fund-finder',
            ],
        ]);
        $data = json_decode($response->getBody()->getContents());
        if (!is_null($data)) {
            $symbolData = [];
            foreach ($data->data->{$this->dataCountry}->funds->{$this->dataProduct}->overview->datas as $dataRow) {
                $symbolData[] = [
                    'name' => $dataRow->fundName, 'symbol' => $dataRow->fundTicker, 'data_source' => $dataRow->fundUri,
                ];
            }
            Symbol::insertOnDuplicateKey($symbolData, [
                'name', 'data_source',
            ]);
            Symbol::whereNotIn('symbol', array_column($symbolData, 'symbol'))->delete();
        }
        //schedule extended data parsing if required
        if ($this->updateSymbolDetails) {
            foreach (Symbol::all() as $symbol) {
                dispatch(new GetSymbolDetails($symbol));
            }
        }
    }
}
