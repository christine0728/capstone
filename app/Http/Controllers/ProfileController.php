<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function logo(Request $request){
        if(Auth::id()){
       $usertype=Auth()->user()->usertype;
       if($usertype=='mdrrmo'){
           $currentUserId = Auth::id();
           $persons = User::where('id', '!=', $currentUserId)->get();
           $id= Auth::id();
            $user = User::where('id',$currentUserId)->get();
         
           $information= User::where('id', $currentUserId)->get();
         
           return view('mdrrmo.my_account', ['users' =>$user,'informations' => $information, 'persons' => $persons]);
       }
       else if($usertype=='pdrrmo'){
                  
          $currentUserId = Auth::id();
          $persons = User::where('id', '!=', $currentUserId)->get();
            $information= User::where('id', $currentUserId)->get();
           $user = User::where('id',$currentUserId)->get();
        //    $unreadNotificationCount = auth()->user()->unreadNotifications->count();
           return view('pdrrmo.my_account', ['users' =>$user, 'informations' => $information, 'persons' => $persons]);
               
       }
   }
   else {
       return redirect()->back();
   }

}
public function updatelogo(Request $request){
   $id= Auth::id();
      $users = User::find($id);
  $request->validate([
   'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
]);

if($request->hasfile('image'))
       {
           $file = $request->file('image');
           $extenstion = $file->getClientOriginalExtension();
           $filename = time().'.'.$extenstion;
           $file->move('uploads/logo/', $filename);
           $users->image = $filename;
            $users->update();
       }
  

return back()->with('error', 'Failed to update profile image');
}
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function store(Request $request)
    {
        //

        $currentUserId = Auth::id();
       $data = [
            'officer' =>  $request->input('officer'),
            'location' => $request->input('location'),
            'population' => $request->input('population'),
            'contact_number' => $request->input('enumber'),
            'emergency_number' => $request->input('cnumber'),
        ];
        $validator = Validator::make($request->all(), [
        'officer' => 'required',
        'location' => 'required',
        'cnumber' => 'required',
        'population' => 'required',
        'enumber'=> 'required'
         ]);

            if ($validator->fails()) {
                 return redirect()->back()->withErrors(['error' => 'Fill in the textbox.']);
            }
        User::where('id',  $currentUserId)->update($data);
        return redirect()->back()->with('success', 'Successfully updated!');

        
    }
}
