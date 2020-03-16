<?php

namespace Tests\Feature;

use App\Jobs\GetSymbolList;
use App\Services\HttpClient;
use App\Symbol;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\MockedDataTrait;

class SymbolParserTest extends TestCase
{

    use RefreshDatabase, DispatchesJobs, MockedDataTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSymbolParser()
    {
        $mock = $this->mock(HttpClient::class);
        $mock->shouldReceive('request')
            ->andReturn(new Response(200, $this->mockedHeadersForSymbolsParser,
                file_get_contents(base_path('/tests/Mock/symbolsData.json'))));
        $this->dispatch(new GetSymbolList());
        $this->assertEquals($this->parsedDataForSymbolsParser, Symbol::select(['symbol', 'name'])->get()->toJson());
    }
}
