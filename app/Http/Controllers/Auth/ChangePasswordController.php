<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('mdrrmo.password-change');
    }

    public function changePassword(Request $request)
    {
   
        $request->validate([
            'new_password' => 'required',
            'new_password_confirmation' => 'required|string|min:8',
        ]);
       

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->new_password),
            'password_change_required' => false,
        ]);
       

        return redirect('/dashboard')->with('success', 'Password changed successfully.');
    }
}
