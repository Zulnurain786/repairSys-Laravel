<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    // public function extraFields(){
    //     return $this->hasMany(ExtraFields::class);  
    // }

    public function materials(){
        return $this->hasMany(Material::class);
    }
   

    public function company(){
        return $this->belongsTo(User::class,'company_id');
    }

    public function media(){
        return $this->hasMany(Media::class);
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->materials as $material) {
            $totalPrice += $material->price;
        }

        return $totalPrice;
    }
}
