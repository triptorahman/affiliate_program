<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserManageController extends Controller
{
    public function index() {

        // dd('here');
        $user_list = User::all();
        // dd($user_list);
        return view('admin.user.list',compact('user_list'));
    }
}
