<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProfileHelper;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $userData = ProfileHelper::GetAuthUserData();
        return view('index', compact('userData'));
    }
}
