<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymbolSector extends Model
{

    protected $table = 'symbol_sectors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sector_name', 'weight',
    ];

    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }

}
