<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\sitrep;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SubjectNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $usertype=Auth()->user()->usertype;
            $username=Auth()->user()->name;
            $currentUserId = Auth::id();
            $users = User::where('id', '!=', $currentUserId)->get();
        if(Auth::check())
        {
            if($usertype=='mdrrmo'){
                
                $subjects = Subject::orderBy('created_at', 'desc')->get();

        $user = User::find($currentUserId); // Assuming there is only one user

        foreach ($subjects as $subject) {
            $sitrepExists = Sitrep::where('subjectId', $subject->id)
                ->where('userId', $user->id)
                ->exists();
        
            $subject->sitrepExists = $sitrepExists;
        }
        
        
            return view('mdrrmo.subject', ['subjects' => $subjects, 'notificationId'=>'']);
        }
        else if($usertype=='pdrrmo'){
          
            $subject = subject::all();
            $currentUserId = Auth::id();
            $persons = User::where('id', '!=', $currentUserId)->get();
            $user = User::where('id', $currentUserId)->get();
            $subject = Subject::all();
                return view('pdrrmo.subject', ['subjects' => $subject, 'persons' => $persons]);
        }}
    }
    public function notifs($notificationId)
    {
   
           
        $subjects = Subject::orderBy('created_at', 'desc')->get();
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        $user = User::find($currentUserId);
        $users = User::where('id', '!=', $currentUserId)->get();
        foreach ($subjects as $subject) {
            $sitrepExists = Sitrep::where('subjectId', $subject->id)
                ->where('userId', $user->id)
                ->exists();
        
            $subject->sitrepExists = $sitrepExists;
        }
        $notificationDataId = $notification->data['newid'];
        
            return view('mdrrmo.subject', ['subjects' => $subjects, 'notificationId'=>$notificationDataId]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function finalize($id){
        try {
    $now = Carbon::now()->setTimezone('Asia/Manila');
    $subject = Subject::findOrFail($id);

    $subject->finalized_at = $now;
    $subject->save();

    // Additional logic or response if needed

    return redirect()->back()->with('success', 'Situational Report finalized successfully.');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Failed to finalize subject. ' . $e->getMessage());
}
    }
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            
            
        ]);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
     
        $subject = new Subject([
            'subject' => $validatedData['subject'],
            'description' =>$request->input('description'),
            'attn' => $request->input('attn'),
            'from' =>$request->input('from'),
            'disaster_preparedness' =>$request->input('disaster_preparedness'),
            'prepared_by' =>$request->input('prepared'),
            'created_at' =>$now,
            'updated_at' => $now
            // Add more fields as needed
        ]);

        // Save the incident to the database
        $subject->save();
        $subid=$subject->id;
        $currentUserName = Auth::user()->name;
        $currentUserId = Auth::id();    
        $notifiableUser = User::where('usertype', 'mdrrmo')->get();
        Notification::send($notifiableUser, new SubjectNotification($subid, 'has sent a situational report subject.',$currentUserName,));

        // Optionally, you can redirect the user to a different page after successful insertion
        return redirect('pdrrmo/sitrepsub')->with('success', 'Subject created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
