<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Affiliate;

class FrontEndController extends Controller
{
    public function validePromoCode(Request $request) {

        if ($request->ajax()) {
            $promo_code = $request->promo_code;
            
          
            $result = Affiliate::where('code',$promo_code)->get();
           
            $result_count = count($result);
            return response($result_count);
        }

        

    }

    public function index() {

        

        return view('welcome');

    }


}
