<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    public function employes()
    {
        return $this->hasMany(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'id_admin','id');
    }


}

