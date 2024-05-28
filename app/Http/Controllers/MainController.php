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
}
