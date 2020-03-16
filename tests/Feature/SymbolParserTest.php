<?php

namespace Tests\Feature;

use App\Jobs\GetSymbolList;
use App\Services\HttpClient;
use App\Symbol;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SymbolParserTest extends TestCase
{

    use RefreshDatabase, DispatchesJobs;

    private $mockedHeaders = ['content-type' => 'application/json; charset=utf-8'];
    private $parsedData = '[{"symbol":"SRLN","name":"SPDR\u00ae Blackstone \/ GSO Senior Loan ETF"},{"symbol":"TIPX","name":"SPDR\u00ae Bloomberg Barclays 1-10 Year TIPS ETF"},{"symbol":"BIL","name":"SPDR\u00ae Bloomberg Barclays 1-3 Month T-Bill ETF"},{"symbol":"CWB","name":"SPDR\u00ae Bloomberg Barclays Convertible Securities ETF"},{"symbol":"EBND","name":"SPDR\u00ae Bloomberg Barclays Emerging Markets Local Bond ETF"},{"symbol":"JNK","name":"SPDR\u00ae Bloomberg Barclays High Yield Bond ETF"},{"symbol":"IBND","name":"SPDR\u00ae Bloomberg Barclays International Corporate Bond ETF"},{"symbol":"BWX","name":"SPDR\u00ae Bloomberg Barclays International Treasury Bond ETF"},{"symbol":"FLRN","name":"SPDR\u00ae Bloomberg Barclays Investment Grade Floating Rate ETF"},{"symbol":"SJNK","name":"SPDR\u00ae Bloomberg Barclays Short Term High Yield Bond ETF"},{"symbol":"BWZ","name":"SPDR\u00ae Bloomberg Barclays Short Term International Treasury Bond ETF"},{"symbol":"DWFI","name":"SPDR\u00ae Dorsey Wright\u00ae Fixed Income Allocation ETF"},{"symbol":"EMTL","name":"SPDR\u00ae DoubleLine\u00ae Emerging Markets Fixed Income ETF"},{"symbol":"STOT","name":"SPDR\u00ae DoubleLine\u00ae Short Duration Total Return Tactical ETF"},{"symbol":"TOTL","name":"SPDR\u00ae DoubleLine\u00ae Total Return Tactical ETF"},{"symbol":"RWO","name":"SPDR\u00ae Dow Jones\u00ae Global Real Estate ETF"},{"symbol":"DIA","name":"SPDR\u00ae Dow Jones\u00ae Industrial Average ETF Trust"},{"symbol":"RWX","name":"SPDR\u00ae Dow Jones\u00ae International Real Estate ETF"},{"symbol":"RWR","name":"SPDR\u00ae Dow Jones\u00ae REIT ETF"},{"symbol":"FEZ","name":"SPDR\u00ae EURO STOXX 50\u00ae ETF"},{"symbol":"SMEZ","name":"SPDR\u00ae EURO STOXX\u00ae Small Cap ETF"},{"symbol":"WIP","name":"SPDR\u00ae FTSE International Government Inflation-Protected Bond ETF"},{"symbol":"XITK","name":"SPDR\u00ae FactSet Innovative Technology ETF"},{"symbol":"DGT","name":"SPDR\u00ae Global Dow ETF"},{"symbol":"GLDM","name":"SPDR\u00ae Gold MiniShares<sup>SM<\/sup> Trust"},{"symbol":"GLD","name":"SPDR\u00ae Gold Shares"},{"symbol":"SYE","name":"SPDR\u00ae MFS Systematic Core Equity ETF"},{"symbol":"SYG","name":"SPDR\u00ae MFS Systematic Growth Equity ETF"},{"symbol":"SYV","name":"SPDR\u00ae MFS Systematic Value Equity ETF"},{"symbol":"LOWC","name":"SPDR\u00ae MSCI ACWI Low Carbon Target ETF"},{"symbol":"CWI","name":"SPDR\u00ae MSCI ACWI ex-US ETF"},{"symbol":"EFAX","name":"SPDR\u00ae MSCI EAFE Fossil Fuel Reserves Free ETF"},{"symbol":"QEFA","name":"SPDR\u00ae MSCI EAFE StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"EEMX","name":"SPDR\u00ae MSCI Emerging Markets Fossil Fuel Reserves Free ETF"},{"symbol":"QEMM","name":"SPDR\u00ae MSCI Emerging Markets StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"QUS","name":"SPDR\u00ae MSCI USA StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"QWLD","name":"SPDR\u00ae MSCI World StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"XNTK","name":"SPDR\u00ae NYSE Technology ETF"},{"symbol":"HYMB","name":"SPDR\u00ae Nuveen Bloomberg Barclays High Yield Municipal Bond ETF"},{"symbol":"TFI","name":"SPDR\u00ae Nuveen Bloomberg Barclays Municipal Bond ETF"},{"symbol":"SHM","name":"SPDR\u00ae Nuveen Bloomberg Barclays Short Term Municipal Bond ETF"},{"symbol":"SPAB","name":"SPDR\u00ae Portfolio Aggregate Bond ETF"},{"symbol":"SPBO","name":"SPDR\u00ae Portfolio Corporate Bond ETF"},{"symbol":"SPDW","name":"SPDR\u00ae Portfolio Developed World ex-US ETF"},{"symbol":"SPEM","name":"SPDR\u00ae Portfolio Emerging Markets ETF"},{"symbol":"SPEU","name":"SPDR\u00ae Portfolio Europe ETF"},{"symbol":"SPHY","name":"SPDR\u00ae Portfolio High Yield Bond ETF"},{"symbol":"SPIB","name":"SPDR\u00ae Portfolio Intermediate Term Corporate Bond ETF"},{"symbol":"SPTI","name":"SPDR\u00ae Portfolio Intermediate Term Treasury ETF"},{"symbol":"SPLB","name":"SPDR\u00ae Portfolio Long Term Corporate Bond ETF"},{"symbol":"SPTL","name":"SPDR\u00ae Portfolio Long Term Treasury ETF"},{"symbol":"SPGM","name":"SPDR\u00ae Portfolio MSCI Global Stock Market ETF"},{"symbol":"SPMB","name":"SPDR\u00ae Portfolio Mortgage Backed Bond ETF"},{"symbol":"SPTM","name":"SPDR\u00ae Portfolio S&P 1500\u00ae Composite Stock Market ETF"},{"symbol":"SPMD","name":"SPDR\u00ae Portfolio S&P 400\u00ae Mid Cap ETF"},{"symbol":"SPLG","name":"SPDR\u00ae Portfolio S&P 500\u00ae ETF"},{"symbol":"SPYG","name":"SPDR\u00ae Portfolio S&P 500\u00ae Growth ETF"},{"symbol":"SPYD","name":"SPDR\u00ae Portfolio S&P 500\u00ae High Dividend ETF"},{"symbol":"SPYV","name":"SPDR\u00ae Portfolio S&P 500\u00ae Value ETF"},{"symbol":"SPSM","name":"SPDR\u00ae Portfolio S&P 600\u00ae Small Cap ETF"},{"symbol":"SPSB","name":"SPDR\u00ae Portfolio Short Term Corporate Bond ETF"},{"symbol":"SPTS","name":"SPDR\u00ae Portfolio Short Term Treasury ETF"},{"symbol":"SPIP","name":"SPDR\u00ae Portfolio TIPS ETF"},{"symbol":"ONEV","name":"SPDR\u00ae Russell 1000 Low Volatility Focus ETF"},{"symbol":"ONEO","name":"SPDR\u00ae Russell 1000 Momentum Focus ETF"},{"symbol":"ONEY","name":"SPDR\u00ae Russell 1000 Yield Focus ETF"},{"symbol":"SPY","name":"SPDR\u00ae S&P 500\u00ae ETF Trust"},{"symbol":"EDIV","name":"SPDR\u00ae S&P Emerging Markets Dividend ETF"},{"symbol":"CNRG","name":"SPDR\u00ae S&P Kensho Clean Power ETF"},{"symbol":"ROKT","name":"SPDR\u00ae S&P Kensho Final Frontiers ETF"},{"symbol":"FITE","name":"SPDR\u00ae S&P Kensho Future Security ETF"},{"symbol":"SIMS","name":"SPDR\u00ae S&P Kensho Intelligent Structures ETF"},{"symbol":"KOMP","name":"SPDR\u00ae S&P Kensho New Economies Composite ETF"},{"symbol":"HAIL","name":"SPDR\u00ae S&P Kensho Smart Mobility ETF"},{"symbol":"MDY","name":"SPDR\u00ae S&P MIDCAP 400\u00ae ETF Trust"},{"symbol":"MMTM","name":"SPDR\u00ae S&P\u00ae 1500 Momentum Tilt ETF"},{"symbol":"VLU","name":"SPDR\u00ae S&P\u00ae 1500 Value Tilt ETF"},{"symbol":"MDYG","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Growth ETF"},{"symbol":"MDYV","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Value ETF"},{"symbol":"SPYB","name":"SPDR\u00ae S&P\u00ae 500 Buyback ETF"},{"symbol":"SPYX","name":"SPDR\u00ae S&P\u00ae 500 Fossil Fuel Reserves Free ETF"},{"symbol":"SLY","name":"SPDR\u00ae S&P\u00ae 600 Small Cap ETF"},{"symbol":"SLYG","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Growth ETF"},{"symbol":"SLYV","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Value ETF"},{"symbol":"XAR","name":"SPDR\u00ae S&P\u00ae Aerospace & Defense ETF"},{"symbol":"KBE","name":"SPDR\u00ae S&P\u00ae Bank ETF"},{"symbol":"XBI","name":"SPDR\u00ae S&P\u00ae Biotech ETF"},{"symbol":"KCE","name":"SPDR\u00ae S&P\u00ae Capital Markets ETF"},{"symbol":"GXC","name":"SPDR\u00ae S&P\u00ae China ETF"},{"symbol":"SDY","name":"SPDR\u00ae S&P\u00ae Dividend ETF"},{"symbol":"GMF","name":"SPDR\u00ae S&P\u00ae Emerging Asia Pacific ETF"},{"symbol":"EWX","name":"SPDR\u00ae S&P\u00ae Emerging Markets Small Cap ETF"},{"symbol":"WDIV","name":"SPDR\u00ae S&P\u00ae Global Dividend ETF"},{"symbol":"GII","name":"SPDR\u00ae S&P\u00ae Global Infrastructure ETF"},{"symbol":"GNR","name":"SPDR\u00ae S&P\u00ae Global Natural Resources ETF"},{"symbol":"XHE","name":"SPDR\u00ae S&P\u00ae Health Care Equipment ETF"},{"symbol":"XHS","name":"SPDR\u00ae S&P\u00ae Health Care Services ETF"},{"symbol":"XHB","name":"SPDR\u00ae S&P\u00ae Homebuilders ETF"},{"symbol":"KIE","name":"SPDR\u00ae S&P\u00ae Insurance ETF"},{"symbol":"DWX","name":"SPDR\u00ae S&P\u00ae International Dividend ETF"},{"symbol":"GWX","name":"SPDR\u00ae S&P\u00ae International Small Cap ETF"},{"symbol":"XWEB","name":"SPDR\u00ae S&P\u00ae Internet ETF"},{"symbol":"XME","name":"SPDR\u00ae S&P\u00ae Metals & Mining ETF"},{"symbol":"NANR","name":"SPDR\u00ae S&P\u00ae North American Natural Resources ETF"},{"symbol":"XES","name":"SPDR\u00ae S&P\u00ae Oil & Gas Equipment & Services ETF"},{"symbol":"XOP","name":"SPDR\u00ae S&P\u00ae Oil & Gas Exploration & Production ETF"},{"symbol":"XPH","name":"SPDR\u00ae S&P\u00ae Pharmaceuticals ETF"},{"symbol":"KRE","name":"SPDR\u00ae S&P\u00ae Regional Banking ETF"},{"symbol":"XRT","name":"SPDR\u00ae S&P\u00ae Retail ETF"},{"symbol":"XSD","name":"SPDR\u00ae S&P\u00ae Semiconductor ETF"},{"symbol":"XSW","name":"SPDR\u00ae S&P\u00ae Software & Services ETF"},{"symbol":"XTH","name":"SPDR\u00ae S&P\u00ae Technology Hardware ETF"},{"symbol":"XTL","name":"SPDR\u00ae S&P\u00ae Telecom ETF"},{"symbol":"XTN","name":"SPDR\u00ae S&P\u00ae Transportation ETF"},{"symbol":"FISR","name":"SPDR\u00ae SSGA Fixed Income Sector Rotation ETF"},{"symbol":"SHE","name":"SPDR\u00ae SSGA Gender Diversity Index ETF"},{"symbol":"GAL","name":"SPDR\u00ae SSGA Global Allocation ETF"},{"symbol":"INKM","name":"SPDR\u00ae SSGA Income Allocation ETF"},{"symbol":"RLY","name":"SPDR\u00ae SSGA Multi-Asset Real Return ETF"},{"symbol":"LGLV","name":"SPDR\u00ae SSGA US Large Cap Low Volatility Index ETF"},{"symbol":"XLSR","name":"SPDR\u00ae SSGA US Sector Rotation ETF"},{"symbol":"SMLV","name":"SPDR\u00ae SSGA US Small Cap Low Volatility Index ETF"},{"symbol":"ULST","name":"SPDR\u00ae SSGA Ultra Short Term Bond ETF"},{"symbol":"ZCAN","name":"SPDR\u00ae Solactive Canada ETF"},{"symbol":"ZDEU","name":"SPDR\u00ae Solactive Germany ETF"},{"symbol":"ZHOK","name":"SPDR\u00ae Solactive Hong Kong ETF"},{"symbol":"ZJPN","name":"SPDR\u00ae Solactive Japan ETF"},{"symbol":"ZGBR","name":"SPDR\u00ae Solactive United Kingdom ETF"},{"symbol":"PSK","name":"SPDR\u00ae Wells Fargo\u00ae Preferred Stock ETF"},{"symbol":"XLC","name":"The Communication Services Select Sector SPDR\u00ae Fund"},{"symbol":"XLY","name":"The Consumer Discretionary Select Sector SPDR\u00ae Fund"},{"symbol":"XLP","name":"The Consumer Staples Select Sector SPDR\u00ae Fund"},{"symbol":"XLE","name":"The Energy Select Sector SPDR\u00ae Fund"},{"symbol":"XLF","name":"The Financial Select Sector SPDR\u00ae Fund"},{"symbol":"XLV","name":"The Health Care Select Sector SPDR\u00ae Fund"},{"symbol":"XLI","name":"The Industrial Select Sector SPDR\u00ae Fund"},{"symbol":"XLB","name":"The Materials Select Sector SPDR\u00ae Fund"},{"symbol":"XLRE","name":"The Real Estate Select Sector SPDR\u00ae Fund"},{"symbol":"XLK","name":"The Technology Select Sector SPDR\u00ae Fund"},{"symbol":"XLU","name":"The Utilities Select Sector SPDR\u00ae Fund"}]';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSymbolParser()
    {
        $mock = $this->mock(HttpClient::class);
        $mock->shouldReceive('request')
            ->andReturn(new Response(200, $this->mockedHeaders,
                file_get_contents(base_path('/tests/Mock/symbolsData.json'))));
        $this->dispatch(new GetSymbolList());
        $this->assertEquals($this->parsedData, Symbol::select(['symbol', 'name'])->get()->toJson());
    }
}
