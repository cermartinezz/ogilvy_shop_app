<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Stock extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo_barra' => $this->code_bar,
            'marca' => $this->brand,
            'modelo' => $this->model,
            'precio' => $this->price,
            'oferta' => $this->discount,
            'descuento' => $this->percentage_discount,
            'disponible' => $this->available,
            'producto' => $this->product->name,
        ];
    }
}
