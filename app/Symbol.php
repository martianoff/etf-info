<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{

    protected $table = 'symbols';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'symbol', 'data_source',
    ];

    public function countryInformation()
    {
        return $this->hasMany(SymbolCountry::class);
    }

    public function sectorInformation()
    {
        return $this->hasMany(SymbolSector::class);
    }

    public function holdingInformation()
    {
        return $this->hasMany(SymbolHolding::class);
    }

}
