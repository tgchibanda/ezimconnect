<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\ProfileHelper;

class MainController extends Controller
{

    public function Login()
    {
        return view('index.login');
    }

    public function Dashboard()
    {
        return view('index.index');
    }

    public function Destroy(Request $request)
    {
        $result = ProfileHelper::Destroy($request, ProfileHelper::GetAuthUserData()->role);
        return $result;
    }

    public function Profile()
    {
        $userData = ProfileHelper::GetAuthUserData();

        return view('index.profile_view', compact('userData'));
    }

    public function ProfileStore(Request $request){

        $result = ProfileHelper::ProfileStore($request, ProfileHelper::GetAuthUserData()->role);
        return $result;

    }

    public function ChangePassword(){
        $userData = ProfileHelper::GetAuthUserData();
        return view('index.change_password', compact('userData'));
    }

    public function UpdatePassword(Request $request){
        
        $result = ProfileHelper::UpdatePassword($request);
        return $result;

    }

    public function ActiveVendors(){
        $vendorDetails = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.vendor.active_vendors',compact('vendorDetails'));
    }

    public function InactiveVendors(){
        $vendorsDetails = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactive_vendors',compact('vendorsDetails'));
    }

    public function VendorDetails(Request $request){

        $vendorDetails = User::findOrFail($request->id);
        return view('backend.vendor.vendor_details',compact('vendorDetails'));

    }

    public function ChangeStatus(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id);
    
        // Toggle status
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
    
        $notification = array(
            'message' => 'Vendor status updated successfully!',
            'alert-type' => 'success'
        );
    
        return redirect()->route('inactive.vendors')->with($notification);
    }
    
}
