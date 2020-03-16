<?php

namespace Tests\Feature;

use App\Jobs\GetSymbolDetails;
use App\Services\HttpClient;
use App\Symbol;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SymbolDataParserTest extends TestCase
{

    use RefreshDatabase, DispatchesJobs;

    private $mockedHeaders = [];

    private $mochedCompleteData = '{"id":1,"symbol":"EDIV","name":"SPDR\\\\u00ae S&P Emerging Markets Dividend ETF","data_source":"\/us\/en\/individual\/etfs\/funds\/spdr-sp-emerging-markets-dividend-etf-ediv","country_information":[{"symbol_id":1,"country_name":"China","weight":26.67},{"symbol_id":1,"country_name":"Taiwan","weight":20.83},{"symbol_id":1,"country_name":"South Africa","weight":17.21},{"symbol_id":1,"country_name":"Thailand","weight":14.88},{"symbol_id":1,"country_name":"Malaysia","weight":5.9399999999999995},{"symbol_id":1,"country_name":"India","weight":2.76},{"symbol_id":1,"country_name":"United Arab Emirates","weight":2.5},{"symbol_id":1,"country_name":"Hong Kong","weight":2.09},{"symbol_id":1,"country_name":"Indonesia","weight":1.43},{"symbol_id":1,"country_name":"Mexico","weight":1.31},{"symbol_id":1,"country_name":"Chile","weight":1.07},{"symbol_id":1,"country_name":"Luxembourg","weight":0.8},{"symbol_id":1,"country_name":"Qatar","weight":0.69},{"symbol_id":1,"country_name":"Poland","weight":0.62},{"symbol_id":1,"country_name":"United States","weight":0.45},{"symbol_id":1,"country_name":"Greece","weight":0.27},{"symbol_id":1,"country_name":"Philippines","weight":0.25},{"symbol_id":1,"country_name":"Russia","weight":0.25}],"sector_information":[{"symbol_id":1,"sector_name":"Financials","weight":26.65},{"symbol_id":1,"sector_name":"Real Estate","weight":10.3},{"symbol_id":1,"sector_name":"Materials","weight":10.26},{"symbol_id":1,"sector_name":"Consumer Staples","weight":9.69},{"symbol_id":1,"sector_name":"Industrials","weight":8.67},{"symbol_id":1,"sector_name":"Energy","weight":7.85},{"symbol_id":1,"sector_name":"Utilities","weight":7.6},{"symbol_id":1,"sector_name":"Information Technology","weight":7.32},{"symbol_id":1,"sector_name":"Communication Services","weight":6.73},{"symbol_id":1,"sector_name":"Consumer Discretionary","weight":3.67},{"symbol_id":1,"sector_name":"Health Care","weight":1.23}],"holding_information":[{"symbol_id":1,"holding_name":"China Resources Land Limited","weight":3.95,"shares":2862000},{"symbol_id":1,"holding_name":"Hengan International Group Co. Ltd.","weight":3.7,"shares":1594000},{"symbol_id":1,"holding_name":"Taiwan Semiconductor Manufacturing Co. Ltd.","weight":3.39,"shares":1105000},{"symbol_id":1,"holding_name":"Longfor Group Holdings Ltd.","weight":3.27,"shares":2246500},{"symbol_id":1,"holding_name":"China Mobile Limited","weight":3.15,"shares":1409000},{"symbol_id":1,"holding_name":"CITIC Limited","weight":2.89,"shares":8487000},{"symbol_id":1,"holding_name":"Formosa Plastics Corporation","weight":2.77,"shares":3159000},{"symbol_id":1,"holding_name":"Power Grid Corporation of India Limited","weight":2.43,"shares":3466119},{"symbol_id":1,"holding_name":"Guangdong Investment Limited","weight":2.42,"shares":4024000},{"symbol_id":1,"holding_name":"Cnooc Limited","weight":2.41,"shares":7644000}]}';

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
            ->andReturn(new Response(200, $this->mockedHeaders, file_get_contents(base_path('/tests/Mock/spdr.html'))));
        $this->dispatch(new GetSymbolDetails($spdr));
        $this->assertEquals($this->mochedCompleteData, Symbol::select(['id', 'symbol', 'name', 'data_source'])->with([
            'countryInformation:symbol_id,country_name,weight',
            'sectorInformation:symbol_id,sector_name,weight',
            'holdingInformation:symbol_id,holding_name,weight,shares',
        ])->whereSymbol('EDIV')->first()->toJson());
    }
}
