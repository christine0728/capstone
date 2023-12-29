<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

use Illuminate\View\View;
class CustomRegisterController extends Controller
{
    //
    public function register(Request $request): RedirectResponse
    {
           $request->validate([
            'uid' => ['required', 'string', 'max:255','unique:'.User::class],
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class]
        ]);
        
    
        function generateVerificationCode($length = 40)
        {
            return Str::random($length);
        }
        $recipientEmail = $request->email;
        $randomPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
        
     // You need to implement this function
        $userId =  Auth::id(); // Replace with the actual user ID
        $verificationToken = Str::random(40);
        $request['name'] = ucfirst($request->input('name'));
        $user = User::create([
            'uid' => $request->uid,
            'name' => $request['name'],
            'email' => $request->email,
            'password' => Hash::make($randomPassword),
            'verification_token' => $verificationToken,
        ]);
        $registeredId = $user->id;
         Mail::to($recipientEmail)->send(new VerificationEmail($registeredId, $randomPassword, $verificationToken, $userId));

     
        event(new Registered($user));

     
        return redirect()->back()->with('success', "A system-generated password has been sent to $recipientEmail. Please check the email.");

    }
}
