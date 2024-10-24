<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

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

    private function storeBase64($directory, $imageBase64)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName = time() . '.png';
        $path = public_path() . 'upload/' . $directory .'/'. $imageName;

        file_put_contents($path, $imageBase64);

        return 'upload/' . $directory .'/'. $imageName;
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

        $imageBase64 = $request->image_base64;

        if ($imageBase64) {

            list($type, $imageBase64) = explode(';', $imageBase64);
            list(, $imageBase64)      = explode(',', $imageBase64);
            $imageBase64 = base64_decode($imageBase64);
            $imageName = time() . '.png';
            $path = public_path() . '/upload/' . $directory .'/'. $imageName;

            file_put_contents($path, $imageBase64);
            $data['photo'] = 'upload/' . $directory .'/'. $imageName;
            unlink(ltrim($request->old_image, '/'));
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
