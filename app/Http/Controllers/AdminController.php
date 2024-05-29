<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\ProfileHelper;


class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminDestroy(Request $request)
    {
        $result = ProfileHelper::Destroy($request, ProfileHelper::GetAuthUserData()->role);
        return $result;

    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $result = ProfileHelper::ProfileStore($request, ProfileHelper::GetAuthUserData()->role);
        return $result;

    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        $result = ProfileHelper::UpdatePassword($request);
        return $result;
    }

}
