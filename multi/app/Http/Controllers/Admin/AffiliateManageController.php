<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\AffiliateAddRequest;
use Illuminate\Support\Str;



use App\Models\Affiliate;

class AffiliateManageController extends Controller
{
    public function index() {

        // dd('here');
        $list = Affiliate::all();
        // dd($user_list);
        return view('admin.affiliate.list',compact('list'));
    }


    public function create() {

        
        
        
        return view('admin.affiliate.create');
    }

    public function store(AffiliateAddRequest $request)
    {
        
        // dd($request->all());
       
        $affiliate = new Affiliate; 
       
        $affiliate->name = $request->name; 
        $affiliate->email = $request->email;
        $affiliate->password = bcrypt('12345678');
        $affiliate->code =  "Main-".Str::random(3) . uniqid();
        $affiliate->has_parent =  0; //create by admin .so no parent code
        $affiliate->balance =  0; //initially balance 0
        $affiliate->save();
        

        session()->flash('message', "Affiliate Created Successfully");
        return redirect()->route('admin.affiliate.list');
    }
}
