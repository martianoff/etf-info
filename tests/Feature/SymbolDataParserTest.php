<?php

namespace Tests\Feature;

use App\Jobs\GetSymbolDetails;
use App\Services\HttpClient;
use App\Symbol;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\MockedDataTrait;

class SymbolDataParserTest extends TestCase
{

    use RefreshDatabase, DispatchesJobs, MockedDataTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSymbolDataParser()
    {
        $spdr = Symbol::create([
            'symbol' => 'EDIV', 'name' => "SPDR\u00ae S&P Emerging Markets Dividend ETF",
            "data_source" => "/us/en/individual/etfs/funds/spdr-sp-emerging-markets-dividend-etf-ediv",
        ]);
        $mock = $this->mock(HttpClient::class);
        $mock->shouldReceive('request')
            ->andReturn(new Response(200, [], file_get_contents(base_path('/tests/Mock/spdr.html'))));
        $this->dispatch(new GetSymbolDetails($spdr));
        $this->assertEquals($this->parsedDataForDetailsParser,
            Symbol::select(['id', 'symbol', 'name', 'data_source'])->with([
                'countryInformation:symbol_id,country_name,weight',
                'sectorInformation:symbol_id,sector_name,weight',
                'holdingInformation:symbol_id,holding_name,weight,shares',
            ])->whereSymbol('EDIV')->first()->toJson());
    }
}
