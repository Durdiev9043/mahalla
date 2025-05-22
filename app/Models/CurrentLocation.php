<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentLocation extends Model
{
    protected $fillable=['lat','lang','user_id','district_id','village_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
