<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notifications\BalanceAddNotification;
use Illuminate\Support\Facades\Notification;


use App\Models\Transaction;
use App\Models\User;
use App\Models\Affiliate;
use App\Models\AffiliateTransaction;


use Auth;

class UserController extends Controller
{
    public function index() {
        return view('dashboard');
    }


    public function list() {

        // dd('here');
    
        $list = Transaction::where('user_id',Auth::user()->id)->get();
        // dd($user_list);
        return view('list',compact('list'));
    }


    public function create() {
        return view('create');
    }



    public function store(Request $request)
    {
        
        $this->validate(
            $request, 
            [   
                'amount' => 'required|numeric|min:1',
                
                
            ],
            [
                'amount.required' => 'Amount Field Required',
                
            ]
        );
       
        // dd($request->all());

        
       
        $transaction = new Transaction; 
       
        $transaction->amount = $request->amount; 
        $transaction->user_id = Auth::user()->id;
        $transaction->promo_code = Auth::user()->promo_code ? Auth::user()->promo_code :null;
        $transaction->save();

        
        $record = User::find(Auth::user()->id);
        $record->balance = $record->balance+$request->amount;
        $record->save();

        if(Auth::user()->promo_code){
            $affiliate_info = Affiliate::where('code',Auth::user()->promo_code)->first();

            
            //log table insert 
            
            if($affiliate_info->has_parent == 1){ // if main affiliate exist then Sub-affiliate get .20 and parent get .10

                /***Sub affiliate start */
                $affiliate = Affiliate::find($affiliate_info->id);
                
                $aff_transaction = new AffiliateTransaction; 
                $aff_transaction->amount = ($request->amount*0.20); 
                $aff_transaction->transaction_id = $transaction->id;
                $aff_transaction->affiliate_id = $affiliate->id;
                $aff_transaction->save();
                $aff_amount = $request->amount*0.20;
                //update
                $affiliate->balance = $affiliate->balance+$aff_amount;
                $affiliate->save();

                Notification::send($affiliate, new BalanceAddNotification($aff_amount,Auth::user()->email));

                

                /***Sub affiliate end */

                /***Main affiliate start */

                $parent_affiliate_info = Affiliate::where('code',$affiliate->parent_code)->first();

                $parent_affiliate = Affiliate::find($parent_affiliate_info->id);

                $parent_aff_transaction = new AffiliateTransaction; 
                $parent_aff_transaction->amount = ($request->amount*0.10); 
                $parent_aff_transaction->transaction_id = $transaction->id;
                $parent_aff_transaction->affiliate_id = $parent_affiliate->id;
                $parent_aff_transaction->save();

                $parent_amount = $request->amount*0.10;

                $parent_affiliate->balance = $parent_affiliate->balance+$parent_amount;
                $parent_affiliate->save();

                Notification::send($parent_affiliate, new BalanceAddNotification($parent_amount,Auth::user()->email));

                
                /***Main affiliate end */

            }else{ // if self main affiliate get .30

                $affiliate = Affiliate::find($affiliate_info->id);
                //insert log
                $aff_transaction = new AffiliateTransaction; 
                $aff_transaction->amount = ($request->amount*0.30); 
                $aff_transaction->transaction_id = $transaction->id;
                $aff_transaction->affiliate_id = $affiliate->id;
            
                $aff_transaction->save();

                $aff_amount = $request->amount*0.30;
                //update
                $affiliate->balance = $affiliate->balance+$aff_amount;
                $affiliate->save();

                Notification::send($affiliate, new BalanceAddNotification($aff_amount,Auth::user()->email));

            }



            
        }


        session()->flash('message', "Balance Add Sucessfully");
        return redirect()->route('user.balance.list');
    }
}
