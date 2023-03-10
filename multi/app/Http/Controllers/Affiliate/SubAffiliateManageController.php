<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\SubAffiliateAddRequest;
use Illuminate\Support\Str;
use Auth;



use App\Models\Affiliate;

class SubAffiliateManageController extends Controller
{
    public function index() {

        // dd('here');
        $own_code =Auth::guard('affiliate')->user()->code;
        $list = Affiliate::where('parent_code',$own_code)->get();
        // dd($user_list);
        return view('affiliate.sub_affiliate.list',compact('list'));
    }


    public function create() {

        
        
        
        return view('affiliate.sub_affiliate.create');
    }

    public function store(SubAffiliateAddRequest $request)
    {
        
        // dd($request->all());

        
       
        $affiliate = new Affiliate; 
       
        $affiliate->name = $request->name; 
        $affiliate->email = $request->email;
        $affiliate->password = bcrypt('12345678');
        $affiliate->code =  "Sub-".Str::random(3) . uniqid();
        $affiliate->has_parent =  1; //create by Affiliate
        $affiliate->parent_code =  Auth::guard('affiliate')->user()->code; 
        $affiliate->balance =  0; //initially balance 0
        $affiliate->save();
        

        session()->flash('message', "Sub Affiliate Created Successfully");
        return redirect()->route('affiliate.sub_affiliate.list');
    }
}
