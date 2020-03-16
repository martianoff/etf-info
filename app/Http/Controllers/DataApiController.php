<?php


namespace App\Http\Controllers;


use App\Http\Resources\SymbolDetail;
use App\Http\Resources\Symbols;
use App\Symbol;

class DataApiController extends Controller
{

    public function symbols()
    {
        return new Symbols(Symbol::all());
    }

    public function data($symbol)
    {
        $symbol = Symbol::with([
            'countryInformation:symbol_id,country_name,weight',
            'sectorInformation:symbol_id,sector_name,weight',
            'holdingInformation:symbol_id,holding_name,weight,shares',
        ])->where('symbol', $symbol)->firstOrFail();

        return new SymbolDetail($symbol);
    }

}
