<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymbolHolding extends Model
{

    protected $table = 'symbol_holdings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'holding_name', 'shares', 'weight',
    ];

    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }

}
