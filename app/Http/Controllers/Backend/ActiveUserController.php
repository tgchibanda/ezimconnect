<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
    public function AllUsers(){
        $users = User::where('role','user')->latest()->get();
        return view('backend.user.all_user_data',compact('users'));

    } // End Mehtod 

    public function AllVendors(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('backend.user.all_vendor_data',compact('vendors'));

    }
    
}
