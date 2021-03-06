<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'nombre' => $this->first_name,
            'apellido' => $this->last_name,
            'correo' => $this->email,
            'nombre_completo' => $this->first_name . ' ' . $this->last_name,
            'fecha_creacion' => $this->created_at,
            'role' => $this->role->name_role
        ];
    }
}
