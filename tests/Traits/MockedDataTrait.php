<?php


namespace Tests\Traits;


use App\User;

trait MockedDataTrait
{

    private $mockedHeadersForSymbolsParser = ['content-type' => 'application/json; charset=utf-8'];
    private $parsedDataForSymbolsParser = '[{"symbol":"SRLN","name":"SPDR\u00ae Blackstone \/ GSO Senior Loan ETF"},{"symbol":"TIPX","name":"SPDR\u00ae Bloomberg Barclays 1-10 Year TIPS ETF"},{"symbol":"BIL","name":"SPDR\u00ae Bloomberg Barclays 1-3 Month T-Bill ETF"},{"symbol":"CWB","name":"SPDR\u00ae Bloomberg Barclays Convertible Securities ETF"},{"symbol":"EBND","name":"SPDR\u00ae Bloomberg Barclays Emerging Markets Local Bond ETF"},{"symbol":"JNK","name":"SPDR\u00ae Bloomberg Barclays High Yield Bond ETF"},{"symbol":"IBND","name":"SPDR\u00ae Bloomberg Barclays International Corporate Bond ETF"},{"symbol":"BWX","name":"SPDR\u00ae Bloomberg Barclays International Treasury Bond ETF"},{"symbol":"FLRN","name":"SPDR\u00ae Bloomberg Barclays Investment Grade Floating Rate ETF"},{"symbol":"SJNK","name":"SPDR\u00ae Bloomberg Barclays Short Term High Yield Bond ETF"},{"symbol":"BWZ","name":"SPDR\u00ae Bloomberg Barclays Short Term International Treasury Bond ETF"},{"symbol":"DWFI","name":"SPDR\u00ae Dorsey Wright\u00ae Fixed Income Allocation ETF"},{"symbol":"EMTL","name":"SPDR\u00ae DoubleLine\u00ae Emerging Markets Fixed Income ETF"},{"symbol":"STOT","name":"SPDR\u00ae DoubleLine\u00ae Short Duration Total Return Tactical ETF"},{"symbol":"TOTL","name":"SPDR\u00ae DoubleLine\u00ae Total Return Tactical ETF"},{"symbol":"RWO","name":"SPDR\u00ae Dow Jones\u00ae Global Real Estate ETF"},{"symbol":"DIA","name":"SPDR\u00ae Dow Jones\u00ae Industrial Average ETF Trust"},{"symbol":"RWX","name":"SPDR\u00ae Dow Jones\u00ae International Real Estate ETF"},{"symbol":"RWR","name":"SPDR\u00ae Dow Jones\u00ae REIT ETF"},{"symbol":"FEZ","name":"SPDR\u00ae EURO STOXX 50\u00ae ETF"},{"symbol":"SMEZ","name":"SPDR\u00ae EURO STOXX\u00ae Small Cap ETF"},{"symbol":"WIP","name":"SPDR\u00ae FTSE International Government Inflation-Protected Bond ETF"},{"symbol":"XITK","name":"SPDR\u00ae FactSet Innovative Technology ETF"},{"symbol":"DGT","name":"SPDR\u00ae Global Dow ETF"},{"symbol":"GLDM","name":"SPDR\u00ae Gold MiniShares<sup>SM<\/sup> Trust"},{"symbol":"GLD","name":"SPDR\u00ae Gold Shares"},{"symbol":"SYE","name":"SPDR\u00ae MFS Systematic Core Equity ETF"},{"symbol":"SYG","name":"SPDR\u00ae MFS Systematic Growth Equity ETF"},{"symbol":"SYV","name":"SPDR\u00ae MFS Systematic Value Equity ETF"},{"symbol":"LOWC","name":"SPDR\u00ae MSCI ACWI Low Carbon Target ETF"},{"symbol":"CWI","name":"SPDR\u00ae MSCI ACWI ex-US ETF"},{"symbol":"EFAX","name":"SPDR\u00ae MSCI EAFE Fossil Fuel Reserves Free ETF"},{"symbol":"QEFA","name":"SPDR\u00ae MSCI EAFE StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"EEMX","name":"SPDR\u00ae MSCI Emerging Markets Fossil Fuel Reserves Free ETF"},{"symbol":"QEMM","name":"SPDR\u00ae MSCI Emerging Markets StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"QUS","name":"SPDR\u00ae MSCI USA StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"QWLD","name":"SPDR\u00ae MSCI World StrategicFactors<sup>SM<\/sup> ETF"},{"symbol":"XNTK","name":"SPDR\u00ae NYSE Technology ETF"},{"symbol":"HYMB","name":"SPDR\u00ae Nuveen Bloomberg Barclays High Yield Municipal Bond ETF"},{"symbol":"TFI","name":"SPDR\u00ae Nuveen Bloomberg Barclays Municipal Bond ETF"},{"symbol":"SHM","name":"SPDR\u00ae Nuveen Bloomberg Barclays Short Term Municipal Bond ETF"},{"symbol":"SPAB","name":"SPDR\u00ae Portfolio Aggregate Bond ETF"},{"symbol":"SPBO","name":"SPDR\u00ae Portfolio Corporate Bond ETF"},{"symbol":"SPDW","name":"SPDR\u00ae Portfolio Developed World ex-US ETF"},{"symbol":"SPEM","name":"SPDR\u00ae Portfolio Emerging Markets ETF"},{"symbol":"SPEU","name":"SPDR\u00ae Portfolio Europe ETF"},{"symbol":"SPHY","name":"SPDR\u00ae Portfolio High Yield Bond ETF"},{"symbol":"SPIB","name":"SPDR\u00ae Portfolio Intermediate Term Corporate Bond ETF"},{"symbol":"SPTI","name":"SPDR\u00ae Portfolio Intermediate Term Treasury ETF"},{"symbol":"SPLB","name":"SPDR\u00ae Portfolio Long Term Corporate Bond ETF"},{"symbol":"SPTL","name":"SPDR\u00ae Portfolio Long Term Treasury ETF"},{"symbol":"SPGM","name":"SPDR\u00ae Portfolio MSCI Global Stock Market ETF"},{"symbol":"SPMB","name":"SPDR\u00ae Portfolio Mortgage Backed Bond ETF"},{"symbol":"SPTM","name":"SPDR\u00ae Portfolio S&P 1500\u00ae Composite Stock Market ETF"},{"symbol":"SPMD","name":"SPDR\u00ae Portfolio S&P 400\u00ae Mid Cap ETF"},{"symbol":"SPLG","name":"SPDR\u00ae Portfolio S&P 500\u00ae ETF"},{"symbol":"SPYG","name":"SPDR\u00ae Portfolio S&P 500\u00ae Growth ETF"},{"symbol":"SPYD","name":"SPDR\u00ae Portfolio S&P 500\u00ae High Dividend ETF"},{"symbol":"SPYV","name":"SPDR\u00ae Portfolio S&P 500\u00ae Value ETF"},{"symbol":"SPSM","name":"SPDR\u00ae Portfolio S&P 600\u00ae Small Cap ETF"},{"symbol":"SPSB","name":"SPDR\u00ae Portfolio Short Term Corporate Bond ETF"},{"symbol":"SPTS","name":"SPDR\u00ae Portfolio Short Term Treasury ETF"},{"symbol":"SPIP","name":"SPDR\u00ae Portfolio TIPS ETF"},{"symbol":"ONEV","name":"SPDR\u00ae Russell 1000 Low Volatility Focus ETF"},{"symbol":"ONEO","name":"SPDR\u00ae Russell 1000 Momentum Focus ETF"},{"symbol":"ONEY","name":"SPDR\u00ae Russell 1000 Yield Focus ETF"},{"symbol":"SPY","name":"SPDR\u00ae S&P 500\u00ae ETF Trust"},{"symbol":"EDIV","name":"SPDR\u00ae S&P Emerging Markets Dividend ETF"},{"symbol":"CNRG","name":"SPDR\u00ae S&P Kensho Clean Power ETF"},{"symbol":"ROKT","name":"SPDR\u00ae S&P Kensho Final Frontiers ETF"},{"symbol":"FITE","name":"SPDR\u00ae S&P Kensho Future Security ETF"},{"symbol":"SIMS","name":"SPDR\u00ae S&P Kensho Intelligent Structures ETF"},{"symbol":"KOMP","name":"SPDR\u00ae S&P Kensho New Economies Composite ETF"},{"symbol":"HAIL","name":"SPDR\u00ae S&P Kensho Smart Mobility ETF"},{"symbol":"MDY","name":"SPDR\u00ae S&P MIDCAP 400\u00ae ETF Trust"},{"symbol":"MMTM","name":"SPDR\u00ae S&P\u00ae 1500 Momentum Tilt ETF"},{"symbol":"VLU","name":"SPDR\u00ae S&P\u00ae 1500 Value Tilt ETF"},{"symbol":"MDYG","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Growth ETF"},{"symbol":"MDYV","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Value ETF"},{"symbol":"SPYB","name":"SPDR\u00ae S&P\u00ae 500 Buyback ETF"},{"symbol":"SPYX","name":"SPDR\u00ae S&P\u00ae 500 Fossil Fuel Reserves Free ETF"},{"symbol":"SLY","name":"SPDR\u00ae S&P\u00ae 600 Small Cap ETF"},{"symbol":"SLYG","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Growth ETF"},{"symbol":"SLYV","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Value ETF"},{"symbol":"XAR","name":"SPDR\u00ae S&P\u00ae Aerospace & Defense ETF"},{"symbol":"KBE","name":"SPDR\u00ae S&P\u00ae Bank ETF"},{"symbol":"XBI","name":"SPDR\u00ae S&P\u00ae Biotech ETF"},{"symbol":"KCE","name":"SPDR\u00ae S&P\u00ae Capital Markets ETF"},{"symbol":"GXC","name":"SPDR\u00ae S&P\u00ae China ETF"},{"symbol":"SDY","name":"SPDR\u00ae S&P\u00ae Dividend ETF"},{"symbol":"GMF","name":"SPDR\u00ae S&P\u00ae Emerging Asia Pacific ETF"},{"symbol":"EWX","name":"SPDR\u00ae S&P\u00ae Emerging Markets Small Cap ETF"},{"symbol":"WDIV","name":"SPDR\u00ae S&P\u00ae Global Dividend ETF"},{"symbol":"GII","name":"SPDR\u00ae S&P\u00ae Global Infrastructure ETF"},{"symbol":"GNR","name":"SPDR\u00ae S&P\u00ae Global Natural Resources ETF"},{"symbol":"XHE","name":"SPDR\u00ae S&P\u00ae Health Care Equipment ETF"},{"symbol":"XHS","name":"SPDR\u00ae S&P\u00ae Health Care Services ETF"},{"symbol":"XHB","name":"SPDR\u00ae S&P\u00ae Homebuilders ETF"},{"symbol":"KIE","name":"SPDR\u00ae S&P\u00ae Insurance ETF"},{"symbol":"DWX","name":"SPDR\u00ae S&P\u00ae International Dividend ETF"},{"symbol":"GWX","name":"SPDR\u00ae S&P\u00ae International Small Cap ETF"},{"symbol":"XWEB","name":"SPDR\u00ae S&P\u00ae Internet ETF"},{"symbol":"XME","name":"SPDR\u00ae S&P\u00ae Metals & Mining ETF"},{"symbol":"NANR","name":"SPDR\u00ae S&P\u00ae North American Natural Resources ETF"},{"symbol":"XES","name":"SPDR\u00ae S&P\u00ae Oil & Gas Equipment & Services ETF"},{"symbol":"XOP","name":"SPDR\u00ae S&P\u00ae Oil & Gas Exploration & Production ETF"},{"symbol":"XPH","name":"SPDR\u00ae S&P\u00ae Pharmaceuticals ETF"},{"symbol":"KRE","name":"SPDR\u00ae S&P\u00ae Regional Banking ETF"},{"symbol":"XRT","name":"SPDR\u00ae S&P\u00ae Retail ETF"},{"symbol":"XSD","name":"SPDR\u00ae S&P\u00ae Semiconductor ETF"},{"symbol":"XSW","name":"SPDR\u00ae S&P\u00ae Software & Services ETF"},{"symbol":"XTH","name":"SPDR\u00ae S&P\u00ae Technology Hardware ETF"},{"symbol":"XTL","name":"SPDR\u00ae S&P\u00ae Telecom ETF"},{"symbol":"XTN","name":"SPDR\u00ae S&P\u00ae Transportation ETF"},{"symbol":"FISR","name":"SPDR\u00ae SSGA Fixed Income Sector Rotation ETF"},{"symbol":"SHE","name":"SPDR\u00ae SSGA Gender Diversity Index ETF"},{"symbol":"GAL","name":"SPDR\u00ae SSGA Global Allocation ETF"},{"symbol":"INKM","name":"SPDR\u00ae SSGA Income Allocation ETF"},{"symbol":"RLY","name":"SPDR\u00ae SSGA Multi-Asset Real Return ETF"},{"symbol":"LGLV","name":"SPDR\u00ae SSGA US Large Cap Low Volatility Index ETF"},{"symbol":"XLSR","name":"SPDR\u00ae SSGA US Sector Rotation ETF"},{"symbol":"SMLV","name":"SPDR\u00ae SSGA US Small Cap Low Volatility Index ETF"},{"symbol":"ULST","name":"SPDR\u00ae SSGA Ultra Short Term Bond ETF"},{"symbol":"ZCAN","name":"SPDR\u00ae Solactive Canada ETF"},{"symbol":"ZDEU","name":"SPDR\u00ae Solactive Germany ETF"},{"symbol":"ZHOK","name":"SPDR\u00ae Solactive Hong Kong ETF"},{"symbol":"ZJPN","name":"SPDR\u00ae Solactive Japan ETF"},{"symbol":"ZGBR","name":"SPDR\u00ae Solactive United Kingdom ETF"},{"symbol":"PSK","name":"SPDR\u00ae Wells Fargo\u00ae Preferred Stock ETF"},{"symbol":"XLC","name":"The Communication Services Select Sector SPDR\u00ae Fund"},{"symbol":"XLY","name":"The Consumer Discretionary Select Sector SPDR\u00ae Fund"},{"symbol":"XLP","name":"The Consumer Staples Select Sector SPDR\u00ae Fund"},{"symbol":"XLE","name":"The Energy Select Sector SPDR\u00ae Fund"},{"symbol":"XLF","name":"The Financial Select Sector SPDR\u00ae Fund"},{"symbol":"XLV","name":"The Health Care Select Sector SPDR\u00ae Fund"},{"symbol":"XLI","name":"The Industrial Select Sector SPDR\u00ae Fund"},{"symbol":"XLB","name":"The Materials Select Sector SPDR\u00ae Fund"},{"symbol":"XLRE","name":"The Real Estate Select Sector SPDR\u00ae Fund"},{"symbol":"XLK","name":"The Technology Select Sector SPDR\u00ae Fund"},{"symbol":"XLU","name":"The Utilities Select Sector SPDR\u00ae Fund"}]';
    private $parsedDataForDetailsParser = '{"id":1,"symbol":"EDIV","name":"SPDR\\\\u00ae S&P Emerging Markets Dividend ETF","data_source":"\/us\/en\/individual\/etfs\/funds\/spdr-sp-emerging-markets-dividend-etf-ediv","country_information":[{"symbol_id":1,"country_name":"China","weight":26.67},{"symbol_id":1,"country_name":"Taiwan","weight":20.83},{"symbol_id":1,"country_name":"South Africa","weight":17.21},{"symbol_id":1,"country_name":"Thailand","weight":14.88},{"symbol_id":1,"country_name":"Malaysia","weight":5.9399999999999995},{"symbol_id":1,"country_name":"India","weight":2.76},{"symbol_id":1,"country_name":"United Arab Emirates","weight":2.5},{"symbol_id":1,"country_name":"Hong Kong","weight":2.09},{"symbol_id":1,"country_name":"Indonesia","weight":1.43},{"symbol_id":1,"country_name":"Mexico","weight":1.31},{"symbol_id":1,"country_name":"Chile","weight":1.07},{"symbol_id":1,"country_name":"Luxembourg","weight":0.8},{"symbol_id":1,"country_name":"Qatar","weight":0.69},{"symbol_id":1,"country_name":"Poland","weight":0.62},{"symbol_id":1,"country_name":"United States","weight":0.45},{"symbol_id":1,"country_name":"Greece","weight":0.27},{"symbol_id":1,"country_name":"Philippines","weight":0.25},{"symbol_id":1,"country_name":"Russia","weight":0.25}],"sector_information":[{"symbol_id":1,"sector_name":"Financials","weight":26.65},{"symbol_id":1,"sector_name":"Real Estate","weight":10.3},{"symbol_id":1,"sector_name":"Materials","weight":10.26},{"symbol_id":1,"sector_name":"Consumer Staples","weight":9.69},{"symbol_id":1,"sector_name":"Industrials","weight":8.67},{"symbol_id":1,"sector_name":"Energy","weight":7.85},{"symbol_id":1,"sector_name":"Utilities","weight":7.6},{"symbol_id":1,"sector_name":"Information Technology","weight":7.32},{"symbol_id":1,"sector_name":"Communication Services","weight":6.73},{"symbol_id":1,"sector_name":"Consumer Discretionary","weight":3.67},{"symbol_id":1,"sector_name":"Health Care","weight":1.23}],"holding_information":[{"symbol_id":1,"holding_name":"China Resources Land Limited","weight":3.95,"shares":2862000},{"symbol_id":1,"holding_name":"Hengan International Group Co. Ltd.","weight":3.7,"shares":1594000},{"symbol_id":1,"holding_name":"Taiwan Semiconductor Manufacturing Co. Ltd.","weight":3.39,"shares":1105000},{"symbol_id":1,"holding_name":"Longfor Group Holdings Ltd.","weight":3.27,"shares":2246500},{"symbol_id":1,"holding_name":"China Mobile Limited","weight":3.15,"shares":1409000},{"symbol_id":1,"holding_name":"CITIC Limited","weight":2.89,"shares":8487000},{"symbol_id":1,"holding_name":"Formosa Plastics Corporation","weight":2.77,"shares":3159000},{"symbol_id":1,"holding_name":"Power Grid Corporation of India Limited","weight":2.43,"shares":3466119},{"symbol_id":1,"holding_name":"Guangdong Investment Limited","weight":2.42,"shares":4024000},{"symbol_id":1,"holding_name":"Cnooc Limited","weight":2.41,"shares":7644000}]}';
    private $expectedStockApiOutput = '{"data":[{"id":1,"symbol":"SRLN","name":"SPDR\u00ae Blackstone \/ GSO Senior Loan ETF"},{"id":2,"symbol":"TIPX","name":"SPDR\u00ae Bloomberg Barclays 1-10 Year TIPS ETF"},{"id":3,"symbol":"BIL","name":"SPDR\u00ae Bloomberg Barclays 1-3 Month T-Bill ETF"},{"id":4,"symbol":"CWB","name":"SPDR\u00ae Bloomberg Barclays Convertible Securities ETF"},{"id":5,"symbol":"EBND","name":"SPDR\u00ae Bloomberg Barclays Emerging Markets Local Bond ETF"},{"id":6,"symbol":"JNK","name":"SPDR\u00ae Bloomberg Barclays High Yield Bond ETF"},{"id":7,"symbol":"IBND","name":"SPDR\u00ae Bloomberg Barclays International Corporate Bond ETF"},{"id":8,"symbol":"BWX","name":"SPDR\u00ae Bloomberg Barclays International Treasury Bond ETF"},{"id":9,"symbol":"FLRN","name":"SPDR\u00ae Bloomberg Barclays Investment Grade Floating Rate ETF"},{"id":10,"symbol":"SJNK","name":"SPDR\u00ae Bloomberg Barclays Short Term High Yield Bond ETF"},{"id":11,"symbol":"BWZ","name":"SPDR\u00ae Bloomberg Barclays Short Term International Treasury Bond ETF"},{"id":12,"symbol":"DWFI","name":"SPDR\u00ae Dorsey Wright\u00ae Fixed Income Allocation ETF"},{"id":13,"symbol":"EMTL","name":"SPDR\u00ae DoubleLine\u00ae Emerging Markets Fixed Income ETF"},{"id":14,"symbol":"STOT","name":"SPDR\u00ae DoubleLine\u00ae Short Duration Total Return Tactical ETF"},{"id":15,"symbol":"TOTL","name":"SPDR\u00ae DoubleLine\u00ae Total Return Tactical ETF"},{"id":16,"symbol":"RWO","name":"SPDR\u00ae Dow Jones\u00ae Global Real Estate ETF"},{"id":17,"symbol":"DIA","name":"SPDR\u00ae Dow Jones\u00ae Industrial Average ETF Trust"},{"id":18,"symbol":"RWX","name":"SPDR\u00ae Dow Jones\u00ae International Real Estate ETF"},{"id":19,"symbol":"RWR","name":"SPDR\u00ae Dow Jones\u00ae REIT ETF"},{"id":20,"symbol":"FEZ","name":"SPDR\u00ae EURO STOXX 50\u00ae ETF"},{"id":21,"symbol":"SMEZ","name":"SPDR\u00ae EURO STOXX\u00ae Small Cap ETF"},{"id":22,"symbol":"WIP","name":"SPDR\u00ae FTSE International Government Inflation-Protected Bond ETF"},{"id":23,"symbol":"XITK","name":"SPDR\u00ae FactSet Innovative Technology ETF"},{"id":24,"symbol":"DGT","name":"SPDR\u00ae Global Dow ETF"},{"id":25,"symbol":"GLDM","name":"SPDR\u00ae Gold MiniShares<sup>SM<\/sup> Trust"},{"id":26,"symbol":"GLD","name":"SPDR\u00ae Gold Shares"},{"id":27,"symbol":"SYE","name":"SPDR\u00ae MFS Systematic Core Equity ETF"},{"id":28,"symbol":"SYG","name":"SPDR\u00ae MFS Systematic Growth Equity ETF"},{"id":29,"symbol":"SYV","name":"SPDR\u00ae MFS Systematic Value Equity ETF"},{"id":30,"symbol":"LOWC","name":"SPDR\u00ae MSCI ACWI Low Carbon Target ETF"},{"id":31,"symbol":"CWI","name":"SPDR\u00ae MSCI ACWI ex-US ETF"},{"id":32,"symbol":"EFAX","name":"SPDR\u00ae MSCI EAFE Fossil Fuel Reserves Free ETF"},{"id":33,"symbol":"QEFA","name":"SPDR\u00ae MSCI EAFE StrategicFactors<sup>SM<\/sup> ETF"},{"id":34,"symbol":"EEMX","name":"SPDR\u00ae MSCI Emerging Markets Fossil Fuel Reserves Free ETF"},{"id":35,"symbol":"QEMM","name":"SPDR\u00ae MSCI Emerging Markets StrategicFactors<sup>SM<\/sup> ETF"},{"id":36,"symbol":"QUS","name":"SPDR\u00ae MSCI USA StrategicFactors<sup>SM<\/sup> ETF"},{"id":37,"symbol":"QWLD","name":"SPDR\u00ae MSCI World StrategicFactors<sup>SM<\/sup> ETF"},{"id":38,"symbol":"XNTK","name":"SPDR\u00ae NYSE Technology ETF"},{"id":39,"symbol":"HYMB","name":"SPDR\u00ae Nuveen Bloomberg Barclays High Yield Municipal Bond ETF"},{"id":40,"symbol":"TFI","name":"SPDR\u00ae Nuveen Bloomberg Barclays Municipal Bond ETF"},{"id":41,"symbol":"SHM","name":"SPDR\u00ae Nuveen Bloomberg Barclays Short Term Municipal Bond ETF"},{"id":42,"symbol":"SPAB","name":"SPDR\u00ae Portfolio Aggregate Bond ETF"},{"id":43,"symbol":"SPBO","name":"SPDR\u00ae Portfolio Corporate Bond ETF"},{"id":44,"symbol":"SPDW","name":"SPDR\u00ae Portfolio Developed World ex-US ETF"},{"id":45,"symbol":"SPEM","name":"SPDR\u00ae Portfolio Emerging Markets ETF"},{"id":46,"symbol":"SPEU","name":"SPDR\u00ae Portfolio Europe ETF"},{"id":47,"symbol":"SPHY","name":"SPDR\u00ae Portfolio High Yield Bond ETF"},{"id":48,"symbol":"SPIB","name":"SPDR\u00ae Portfolio Intermediate Term Corporate Bond ETF"},{"id":49,"symbol":"SPTI","name":"SPDR\u00ae Portfolio Intermediate Term Treasury ETF"},{"id":50,"symbol":"SPLB","name":"SPDR\u00ae Portfolio Long Term Corporate Bond ETF"},{"id":51,"symbol":"SPTL","name":"SPDR\u00ae Portfolio Long Term Treasury ETF"},{"id":52,"symbol":"SPGM","name":"SPDR\u00ae Portfolio MSCI Global Stock Market ETF"},{"id":53,"symbol":"SPMB","name":"SPDR\u00ae Portfolio Mortgage Backed Bond ETF"},{"id":54,"symbol":"SPTM","name":"SPDR\u00ae Portfolio S&P 1500\u00ae Composite Stock Market ETF"},{"id":55,"symbol":"SPMD","name":"SPDR\u00ae Portfolio S&P 400\u00ae Mid Cap ETF"},{"id":56,"symbol":"SPLG","name":"SPDR\u00ae Portfolio S&P 500\u00ae ETF"},{"id":57,"symbol":"SPYG","name":"SPDR\u00ae Portfolio S&P 500\u00ae Growth ETF"},{"id":58,"symbol":"SPYD","name":"SPDR\u00ae Portfolio S&P 500\u00ae High Dividend ETF"},{"id":59,"symbol":"SPYV","name":"SPDR\u00ae Portfolio S&P 500\u00ae Value ETF"},{"id":60,"symbol":"SPSM","name":"SPDR\u00ae Portfolio S&P 600\u00ae Small Cap ETF"},{"id":61,"symbol":"SPSB","name":"SPDR\u00ae Portfolio Short Term Corporate Bond ETF"},{"id":62,"symbol":"SPTS","name":"SPDR\u00ae Portfolio Short Term Treasury ETF"},{"id":63,"symbol":"SPIP","name":"SPDR\u00ae Portfolio TIPS ETF"},{"id":64,"symbol":"ONEV","name":"SPDR\u00ae Russell 1000 Low Volatility Focus ETF"},{"id":65,"symbol":"ONEO","name":"SPDR\u00ae Russell 1000 Momentum Focus ETF"},{"id":66,"symbol":"ONEY","name":"SPDR\u00ae Russell 1000 Yield Focus ETF"},{"id":67,"symbol":"SPY","name":"SPDR\u00ae S&P 500\u00ae ETF Trust"},{"id":68,"symbol":"EDIV","name":"SPDR\u00ae S&P Emerging Markets Dividend ETF"},{"id":69,"symbol":"CNRG","name":"SPDR\u00ae S&P Kensho Clean Power ETF"},{"id":70,"symbol":"ROKT","name":"SPDR\u00ae S&P Kensho Final Frontiers ETF"},{"id":71,"symbol":"FITE","name":"SPDR\u00ae S&P Kensho Future Security ETF"},{"id":72,"symbol":"SIMS","name":"SPDR\u00ae S&P Kensho Intelligent Structures ETF"},{"id":73,"symbol":"KOMP","name":"SPDR\u00ae S&P Kensho New Economies Composite ETF"},{"id":74,"symbol":"HAIL","name":"SPDR\u00ae S&P Kensho Smart Mobility ETF"},{"id":75,"symbol":"MDY","name":"SPDR\u00ae S&P MIDCAP 400\u00ae ETF Trust"},{"id":76,"symbol":"MMTM","name":"SPDR\u00ae S&P\u00ae 1500 Momentum Tilt ETF"},{"id":77,"symbol":"VLU","name":"SPDR\u00ae S&P\u00ae 1500 Value Tilt ETF"},{"id":78,"symbol":"MDYG","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Growth ETF"},{"id":79,"symbol":"MDYV","name":"SPDR\u00ae S&P\u00ae 400 Mid Cap Value ETF"},{"id":80,"symbol":"SPYB","name":"SPDR\u00ae S&P\u00ae 500 Buyback ETF"},{"id":81,"symbol":"SPYX","name":"SPDR\u00ae S&P\u00ae 500 Fossil Fuel Reserves Free ETF"},{"id":82,"symbol":"SLY","name":"SPDR\u00ae S&P\u00ae 600 Small Cap ETF"},{"id":83,"symbol":"SLYG","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Growth ETF"},{"id":84,"symbol":"SLYV","name":"SPDR\u00ae S&P\u00ae 600 Small Cap Value ETF"},{"id":85,"symbol":"XAR","name":"SPDR\u00ae S&P\u00ae Aerospace & Defense ETF"},{"id":86,"symbol":"KBE","name":"SPDR\u00ae S&P\u00ae Bank ETF"},{"id":87,"symbol":"XBI","name":"SPDR\u00ae S&P\u00ae Biotech ETF"},{"id":88,"symbol":"KCE","name":"SPDR\u00ae S&P\u00ae Capital Markets ETF"},{"id":89,"symbol":"GXC","name":"SPDR\u00ae S&P\u00ae China ETF"},{"id":90,"symbol":"SDY","name":"SPDR\u00ae S&P\u00ae Dividend ETF"},{"id":91,"symbol":"GMF","name":"SPDR\u00ae S&P\u00ae Emerging Asia Pacific ETF"},{"id":92,"symbol":"EWX","name":"SPDR\u00ae S&P\u00ae Emerging Markets Small Cap ETF"},{"id":93,"symbol":"WDIV","name":"SPDR\u00ae S&P\u00ae Global Dividend ETF"},{"id":94,"symbol":"GII","name":"SPDR\u00ae S&P\u00ae Global Infrastructure ETF"},{"id":95,"symbol":"GNR","name":"SPDR\u00ae S&P\u00ae Global Natural Resources ETF"},{"id":96,"symbol":"XHE","name":"SPDR\u00ae S&P\u00ae Health Care Equipment ETF"},{"id":97,"symbol":"XHS","name":"SPDR\u00ae S&P\u00ae Health Care Services ETF"},{"id":98,"symbol":"XHB","name":"SPDR\u00ae S&P\u00ae Homebuilders ETF"},{"id":99,"symbol":"KIE","name":"SPDR\u00ae S&P\u00ae Insurance ETF"},{"id":100,"symbol":"DWX","name":"SPDR\u00ae S&P\u00ae International Dividend ETF"},{"id":101,"symbol":"GWX","name":"SPDR\u00ae S&P\u00ae International Small Cap ETF"},{"id":102,"symbol":"XWEB","name":"SPDR\u00ae S&P\u00ae Internet ETF"},{"id":103,"symbol":"XME","name":"SPDR\u00ae S&P\u00ae Metals & Mining ETF"},{"id":104,"symbol":"NANR","name":"SPDR\u00ae S&P\u00ae North American Natural Resources ETF"},{"id":105,"symbol":"XES","name":"SPDR\u00ae S&P\u00ae Oil & Gas Equipment & Services ETF"},{"id":106,"symbol":"XOP","name":"SPDR\u00ae S&P\u00ae Oil & Gas Exploration & Production ETF"},{"id":107,"symbol":"XPH","name":"SPDR\u00ae S&P\u00ae Pharmaceuticals ETF"},{"id":108,"symbol":"KRE","name":"SPDR\u00ae S&P\u00ae Regional Banking ETF"},{"id":109,"symbol":"XRT","name":"SPDR\u00ae S&P\u00ae Retail ETF"},{"id":110,"symbol":"XSD","name":"SPDR\u00ae S&P\u00ae Semiconductor ETF"},{"id":111,"symbol":"XSW","name":"SPDR\u00ae S&P\u00ae Software & Services ETF"},{"id":112,"symbol":"XTH","name":"SPDR\u00ae S&P\u00ae Technology Hardware ETF"},{"id":113,"symbol":"XTL","name":"SPDR\u00ae S&P\u00ae Telecom ETF"},{"id":114,"symbol":"XTN","name":"SPDR\u00ae S&P\u00ae Transportation ETF"},{"id":115,"symbol":"FISR","name":"SPDR\u00ae SSGA Fixed Income Sector Rotation ETF"},{"id":116,"symbol":"SHE","name":"SPDR\u00ae SSGA Gender Diversity Index ETF"},{"id":117,"symbol":"GAL","name":"SPDR\u00ae SSGA Global Allocation ETF"},{"id":118,"symbol":"INKM","name":"SPDR\u00ae SSGA Income Allocation ETF"},{"id":119,"symbol":"RLY","name":"SPDR\u00ae SSGA Multi-Asset Real Return ETF"},{"id":120,"symbol":"LGLV","name":"SPDR\u00ae SSGA US Large Cap Low Volatility Index ETF"},{"id":121,"symbol":"XLSR","name":"SPDR\u00ae SSGA US Sector Rotation ETF"},{"id":122,"symbol":"SMLV","name":"SPDR\u00ae SSGA US Small Cap Low Volatility Index ETF"},{"id":123,"symbol":"ULST","name":"SPDR\u00ae SSGA Ultra Short Term Bond ETF"},{"id":124,"symbol":"ZCAN","name":"SPDR\u00ae Solactive Canada ETF"},{"id":125,"symbol":"ZDEU","name":"SPDR\u00ae Solactive Germany ETF"},{"id":126,"symbol":"ZHOK","name":"SPDR\u00ae Solactive Hong Kong ETF"},{"id":127,"symbol":"ZJPN","name":"SPDR\u00ae Solactive Japan ETF"},{"id":128,"symbol":"ZGBR","name":"SPDR\u00ae Solactive United Kingdom ETF"},{"id":129,"symbol":"PSK","name":"SPDR\u00ae Wells Fargo\u00ae Preferred Stock ETF"},{"id":130,"symbol":"XLC","name":"The Communication Services Select Sector SPDR\u00ae Fund"},{"id":131,"symbol":"XLY","name":"The Consumer Discretionary Select Sector SPDR\u00ae Fund"},{"id":132,"symbol":"XLP","name":"The Consumer Staples Select Sector SPDR\u00ae Fund"},{"id":133,"symbol":"XLE","name":"The Energy Select Sector SPDR\u00ae Fund"},{"id":134,"symbol":"XLF","name":"The Financial Select Sector SPDR\u00ae Fund"},{"id":135,"symbol":"XLV","name":"The Health Care Select Sector SPDR\u00ae Fund"},{"id":136,"symbol":"XLI","name":"The Industrial Select Sector SPDR\u00ae Fund"},{"id":137,"symbol":"XLB","name":"The Materials Select Sector SPDR\u00ae Fund"},{"id":138,"symbol":"XLRE","name":"The Real Estate Select Sector SPDR\u00ae Fund"},{"id":139,"symbol":"XLK","name":"The Technology Select Sector SPDR\u00ae Fund"},{"id":140,"symbol":"XLU","name":"The Utilities Select Sector SPDR\u00ae Fund"}]}';
    private $expectedStockDetailsApiOutput = '{"data":{"id":1,"symbol":"EDIV","name":"SPDR\\\\u00ae S&P Emerging Markets Dividend ETF","countryInformation":[{"country_name":"China","weight":26.67},{"country_name":"Taiwan","weight":20.83},{"country_name":"South Africa","weight":17.21},{"country_name":"Thailand","weight":14.88},{"country_name":"Malaysia","weight":5.9399999999999995},{"country_name":"India","weight":2.76},{"country_name":"United Arab Emirates","weight":2.5},{"country_name":"Hong Kong","weight":2.09},{"country_name":"Indonesia","weight":1.43},{"country_name":"Mexico","weight":1.31},{"country_name":"Chile","weight":1.07},{"country_name":"Luxembourg","weight":0.8},{"country_name":"Qatar","weight":0.69},{"country_name":"Poland","weight":0.62},{"country_name":"United States","weight":0.45},{"country_name":"Greece","weight":0.27},{"country_name":"Philippines","weight":0.25},{"country_name":"Russia","weight":0.25}],"sectorInformation":[{"sector_name":"Financials","weight":26.65},{"sector_name":"Real Estate","weight":10.3},{"sector_name":"Materials","weight":10.26},{"sector_name":"Consumer Staples","weight":9.69},{"sector_name":"Industrials","weight":8.67},{"sector_name":"Energy","weight":7.85},{"sector_name":"Utilities","weight":7.6},{"sector_name":"Information Technology","weight":7.32},{"sector_name":"Communication Services","weight":6.73},{"sector_name":"Consumer Discretionary","weight":3.67},{"sector_name":"Health Care","weight":1.23}],"holdingInformation":[{"holding_name":"China Resources Land Limited","weight":3.95,"shares":2862000},{"holding_name":"Hengan International Group Co. Ltd.","weight":3.7,"shares":1594000},{"holding_name":"Taiwan Semiconductor Manufacturing Co. Ltd.","weight":3.39,"shares":1105000},{"holding_name":"Longfor Group Holdings Ltd.","weight":3.27,"shares":2246500},{"holding_name":"China Mobile Limited","weight":3.15,"shares":1409000},{"holding_name":"CITIC Limited","weight":2.89,"shares":8487000},{"holding_name":"Formosa Plastics Corporation","weight":2.77,"shares":3159000},{"holding_name":"Power Grid Corporation of India Limited","weight":2.43,"shares":3466119},{"holding_name":"Guangdong Investment Limited","weight":2.42,"shares":4024000},{"holding_name":"Cnooc Limited","weight":2.41,"shares":7644000}]}}';

    /**
     * @return User
     */
    private function createUser()
    {
        return factory(User::class)->create([
            'name' => 'admin', 'email' => 'admin@app', 'password' => 'admin',
        ]);
    }
}