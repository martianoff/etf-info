<?php

namespace Tests\Feature;

use App\Symbol;
use App\SymbolCountry;
use App\SymbolHolding;
use App\SymbolSector;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testData()
    {
        $this->createData();
        $this->assertDatabaseHas('symbols', [
            'symbol' => 'SPY',
        ]);
        $this->assertDatabaseHas('symbol_holdings', [
            'holding_name' => 'Microsoft',
        ]);
        $this->assertDatabaseHas('symbol_countries', [
            'country_name' => 'United States',
        ]);
        $this->assertDatabaseHas('symbol_sectors', [
            'sector_name' => 'Information Technology',
        ]);
    }

    /**
     * @return User
     */
    private function createData()
    {
        $symbol = factory(Symbol::class)->create([
            'symbol' => 'SPY',
        ]);
        factory(SymbolHolding::class)->create([
            'symbol_id' => $symbol->getKey(),
            'holding_name' => 'Microsoft',
            'shares' => 1,
            'weight' => 100,
        ]);
        factory(SymbolCountry::class)->create([
            'symbol_id' => $symbol->getKey(),
            'country_name' => 'United States',
            'weight' => 100,
        ]);
        factory(SymbolSector::class)->create([
            'symbol_id' => $symbol->getKey(),
            'sector_name' => 'Information Technology',
            'weight' => 100,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRelations()
    {
        $this->createData();
        $symbol = Symbol::with(['countryInformation', 'sectorInformation', 'holdingInformation'])->first();
        $this->assertNotNull($symbol->countryInformation);
        $this->assertNotNull($symbol->sectorInformation);
        $this->assertNotNull($symbol->holdingInformation);
    }
}
