<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class VerificationController extends Controller
{

    public function verify($id, $token)
    {
        // Retrieve the user by ID
        $user = User::find($id);
    
        if (!$user) {
            // Handle invalid user ID (e.g., show an error page)
        }
    
        // Check if the provided token matches the user's verification token
        if (!hash_equals($user->verification_token, $token)) {
            // Handle invalid token (e.g., show an error page)
        }
    
        // Check if the user is already verified
        if ($user->email_verified_at) {
            // Handle already verified user (e.g., show a message)
        }
    
        // Mark the user as verified
        $user->update(['email_verified_at' => now()]);
    
        // Additional logic (e.g., send a notification, update other information)
    
        // Redirect or display a success message
        return redirect()->route('verification.success');
    }
    
}
