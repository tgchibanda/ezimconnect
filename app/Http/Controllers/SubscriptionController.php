<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller
{
    public function Subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Custom validation logic
        $existingSubscription = Subscription::where('email', $request->email)
            ->where('subscription', 'active')
            ->first();

        // Check if an active subscription already exists
        if ($existingSubscription) {
            // Throw validation error if email with active status already exists
            throw ValidationException::withMessages([
                'email' => 'This email is already subscribed.',
            ]);
        }

        // If validation passes, create the new record

        DB::beginTransaction();
        try {
            Subscription::create([
                'email' => $request->email,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method not working.' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['email' => 'Unable to subscribe right now.']);
        }
        DB::commit();

        $successNotification = [
            'message' => 'You have successfully subscribed!',
            'alert-type' => 'success'
        ];

        // Redirect back to the login page with error message
        return redirect()->route('home')->with($successNotification);
    }
}
