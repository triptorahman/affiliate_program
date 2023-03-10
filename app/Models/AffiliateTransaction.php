<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateTransaction extends Model
{
    use HasFactory;


    public function transaction_info(){
        return $this->hasOne('App\Models\Transaction', 'id', 'transaction_id');
        
    }

    public function affiliate_info(){
        return $this->hasOne('App\Models\Affiliate', 'id', 'affiliate_id');
        
    }
}
