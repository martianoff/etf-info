<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SymbolDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'symbol' => $this->symbol,
            'name' => $this->name,
            'countryInformation' => CountryInformation::collection($this->whenLoaded('countryInformation')),
            'sectorInformation' => SectorInformation::collection($this->whenLoaded('sectorInformation')),
            'holdingInformation' => HoldingInformation::collection($this->whenLoaded('holdingInformation')),
        ];
    }
}
