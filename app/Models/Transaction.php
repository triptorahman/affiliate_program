<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    public function user_info(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
        
    }
}
