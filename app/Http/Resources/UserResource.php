<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Company;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'adress'        => $this->adress,
            'tel'           => $this->tel,
            'birthday'      => $this->birthday,
            'role'          => $this->role,
            'email'         => $this->email,
            'status'        => $this->status,
            'idcompany'     => optional($this->company)->id,
            'namecompany'   => optional($this->company)->nom,
            'raison_social' => optional($this->company)->raison_social,
            'emailcompany'  => optional($this->company)->email,
            'adresscompany' => optional($this->company)->adresse,
            'telcompany'    => optional($this->company)->tel,
            'date_creation' => optional($this->company)->date_creation,
            'description'   => optional($this->company)->description,               
        ];
    }
}
