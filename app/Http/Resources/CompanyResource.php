<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;
class CompanyResource extends JsonResource
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
            'id'             => $this->id,
            'nom'            => $this->nom,
            'raison_social'  => $this->adresse,
            'email'          => $this->email,
            'adresse'        => $this->adresse,
            'tel'            => $this->tel,
            'date_creation'  => $this->date_creation,
            'description'    => $this->description,
            'admin'          => optional($this->admin)->name,
            'employes'       => UserResource::collection(User::where('id_company',$this->id)->get()),
        ];
    }
}
