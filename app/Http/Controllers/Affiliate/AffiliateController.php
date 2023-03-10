<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affiliate;

use App\Models\AffiliateTransaction;

use Auth;

class AffiliateController extends Controller
{
    public function index() {
       
        $user = Affiliate::find(Auth::guard('affiliate')->user()->id);
        // dd($user->notifications);
        return view('affiliate.dashboard',compact('user'));
    }


    public function commision() {

        // dd('here');
        $affiliate_id =Auth::guard('affiliate')->user()->id;
        if(Auth::guard('affiliate')->user()->has_parent == 0){ //route block for sub affiliate

            $list = AffiliateTransaction::with('transaction_info','transaction_info.user_info')->where('affiliate_id',$affiliate_id)->get();
            // dd($list);
            return view('affiliate.transaction_list',compact('list'));

        }else{
            session()->flash('message', "Route Not Accessible");
            return redirect()->route('affiliate.dashboard');
        }
        
    }

    
}
