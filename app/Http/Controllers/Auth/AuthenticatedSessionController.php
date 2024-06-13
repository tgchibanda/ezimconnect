<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Helpers\Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    try {
        // Attempt to authenticate the user
        $request->authenticate();

        // Regenerate the session to protect against session fixation attacks
        $request->session()->regenerate();

        // Determine the redirect URL based on the user's role
        $url = match($request->user()->role) {
            'admin', 'vendor' => 'index.dashboard',
            'user' => 'dashboard',
            default => 'home' // Provide a default route in case of unexpected roles
        };

        // Prepare success notification
        $notification = [
            'message' => 'Login Successful',
            'alert-type' => 'success'
        ];

        // Move cart items to the database
        Cart::moveCartItemsIntoDb();

        // Redirect to the intended URL with a success notification
        return redirect()->intended(route($url, absolute: false))->with($notification);

    } catch (\Throwable $e) {
        // Handle authentication failures and other errors

        // Log the error message for debugging purposes (optional)
        // Log::error('Login Error: ' . $e->getMessage());

        // Prepare error notification
        $errorNotification = [
            'message' => 'Login failed: ' . $e->getMessage(),
            'alert-type' => 'error'
        ];

        // Redirect back to the login page with error message
        return redirect()->back()->withInput()->with($errorNotification);
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
