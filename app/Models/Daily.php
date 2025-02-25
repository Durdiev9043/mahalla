<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    protected $fillable=['user_id','time','day','lat','lang'];


    public function user(){
        return $this->belongsTo( User::class);
    }
}
