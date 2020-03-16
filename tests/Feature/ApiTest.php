<?php

namespace Tests\Feature;

use App\Jobs\GetSymbolDetails;
use App\Jobs\GetSymbolList;
use App\Services\HttpClient;
use App\Symbol;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\MockedDataTrait;

class ApiTest extends TestCase
{

    use RefreshDatabase, DispatchesJobs, MockedDataTrait;

    /**
     * @return void
     */
    public function testApiWithoutAuth()
    {
        $response = $this->json('GET', '/api/symbols');
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function testStocksApi()
    {
        //get data using mocked http client
        $mock = $this->mock(HttpClient::class);
        $mock->shouldReceive('request')
            ->andReturn(new Response(200, $this->mockedHeadersForSymbolsParser,
                file_get_contents(base_path('/tests/Mock/symbolsData.json'))));
        $this->dispatch(new GetSymbolList());
        //create user for auth
        $this->createUser();
        $jwtServiceResponse = $this->json('POST', '/api/auth/login', [
            'email' => 'admin@app', 'password' => 'admin',
        ]);
        $response = $this->json('GET', '/api/symbols', [], [
            'Authentication: Bearer '.$jwtServiceResponse->json('access_token'),
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->expectedStockApiOutput, $response->content());
    }

    /**
     * @return void
     */
    public function testStockDetailsApi()
    {
        //declare some symbol for ongoing parsing
        $spdr = Symbol::create([
            'symbol' => 'EDIV', 'name' => "SPDR\u00ae S&P Emerging Markets Dividend ETF",
            "data_source" => "/us/en/individual/etfs/funds/spdr-sp-emerging-markets-dividend-etf-ediv",
        ]);
        //get data using mocked http client
        $mock = $this->mock(HttpClient::class);
        $mock->shouldReceive('request')
            ->andReturn(new Response(200, [], file_get_contents(base_path('/tests/Mock/spdr.html'))));
        $this->dispatch(new GetSymbolDetails($spdr));
        //create user for auth
        $this->createUser();
        $jwtServiceResponse = $this->json('POST', '/api/auth/login', [
            'email' => 'admin@app', 'password' => 'admin',
        ]);
        $response = $this->json('GET', '/api/symbols/'.$spdr->symbol, [], [
            'Authentication: Bearer '.$jwtServiceResponse->json('access_token'),
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->expectedStockDetailsApiOutput, $response->content());
    }
}
