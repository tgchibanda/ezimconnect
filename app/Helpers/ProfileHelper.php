<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileHelper
{

    public static function GetAuthUserData()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return $userData;
    }

    public static function Destroy(Request $request, $role)
    {

        $alert_title =self::GetAuthUserData()->getUserTitle();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $notification = array(
            'message' => $alert_title . ' Logout Successfull',
            'alert-type' => 'success'
        );

        if ($role == 'user') {
            return redirect()->route('login')->with($notification);
        }
        return redirect()->route('index.login')->with($notification);
    }

    public static function ProfileStore(Request $request, $role)
    {

        $data = self::GetAuthUserData();
        $directory = 'admin_images';
        $alert_title = 'Admin';
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->website = $request->website;
        $data->instagram = $request->instagram;
        $data->facebook = $request->facebook;

        if ($role == 'vendor') {
            $data->vendor_join = $request->vendor_join;
            $data->vendor_short_info = $request->vendor_short_info;
            $directory = 'vendor_images';
            $alert_title = 'Shop';
        } else if ($role == 'user') {
            $directory = 'user_images';
            $alert_title = 'User';
        }



        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/' . $directory . '/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/' . $directory), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => $alert_title . ' Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public static function UpdatePassword(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        return back()->with("status", " Password Changed Successfully");
    }
}
