<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Affiliate;
use App\Models\AffiliateTransaction;

class HomeController extends Controller
{
    public function index() {

        // dd('here');
        return view('admin.dashboard');
    }

    public function userTransaction() {

        // dd('here');
    
        $list = Transaction::with('user_info')->get();
        // dd($list);
        return view('admin.user_transaction',compact('list'));
    }

    public function affiliateTransaction() {

        // dd('here');
    
        $list = AffiliateTransaction::with('transaction_info','transaction_info.user_info','affiliate_info')->get();
        // dd($list);
        return view('admin.affiliate_transaction',compact('list'));
    }
}
