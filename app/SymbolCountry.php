<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymbolCountry extends Model
{

    protected $table = 'symbol_countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_name', 'weight',
    ];

    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }

}
