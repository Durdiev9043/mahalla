<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=['district_id','type','village_id','lat','lang'];


    public $tt=[1=>'Tuman (Shaxar) hokimligi',2=>'Kambag\'allik qisqartirish va aholi bandlikida ko\'maklashish bo\'limi',3=>'Ijtimoiyi himoya milliy agentligi tuman(shaxar) bo\'limi'];

}
