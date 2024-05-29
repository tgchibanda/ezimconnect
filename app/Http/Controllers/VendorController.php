<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\ProfileHelper;

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
}
