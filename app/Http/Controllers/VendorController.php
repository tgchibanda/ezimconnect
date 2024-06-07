<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\ProfileHelper;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    }

    public function VendorDashboard()
    {
        return view('vendor.index');
    }

    public function VendorDestroy(Request $request)
    {
        $result = ProfileHelper::Destroy($request, ProfileHelper::GetAuthUserData()->role);
        return $result;
    }

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_profile_view', compact('vendorData'));
    }

    public function VendorProfileStore(Request $request){

        $result = ProfileHelper::ProfileStore($request, ProfileHelper::GetAuthUserData()->role);
        return $result;

    }

    public function VendorChangePassword(){
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request){
        
        $result = ProfileHelper::UpdatePassword($request);
        return $result;

    }

    public function BecomeVendor()
    {
        return view('auth.become_vendor');
    }

    public function VendorRegister(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

          $notification = array(
            'message' => 'Shop Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index.login')->with($notification);

    }
}
