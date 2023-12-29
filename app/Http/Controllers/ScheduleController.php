<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\report;
use App\Models\event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AttendanceNotification;
use Illuminate\Http\Request;
use App\Models\AssistanceRequest;
use DB;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
       public function calendar(){
       
                $currentUserId = Auth::id();
                $usertype=Auth()->user()->usertype;
                if ($usertype === 'pdrrmo') {
                    //$unreadNotificationCount = auth()->user()->unreadNotifications->count();
                     $currentUserId = Auth::id();
                    $user = User::where('id', $currentUserId)->get();
                    $events = DB::table('events')
                    ->join('users', 'events.userid', '=', 'users.id')
                    ->select('events.*', 'users.name as user_name') // Ensure 'user_name' is selected
                    ->get();
                    $recepient = User::where('id', '<>', $currentUserId)
                        ->orderBy('name', 'asc')
                        ->get();

                
                    $currentUserId = Auth::id(); 
                    return view('pdrrmo.Scheduling', ['recepient'=> $recepient,'currentUserId' => $currentUserId, 'events'=>$events, 'users' =>$user]);
               } elseif ($usertype === 'mdrrmo') {
                    $currentUserId = Auth::id();
                    $user = User::where('id', $currentUserId)->get();
                    $recepient = User::where('id', '<>', $currentUserId)
                        ->orderBy('name', 'asc')
                        ->get();

                    $events = DB::table('events')
                    ->join('users', 'events.userid', '=', 'users.id')
                    ->select('events.*', 'users.name as user_name', 'users.usertype as type')
                    ->get();
            
                    $currentUserId = Auth::id(); 
                    return view('mdrrmo.Scheduling', ['recepient'=> $recepient,'currentUserId' => $currentUserId, 'events'=>$events, 'users' =>$user]);
                }       
    }


public function getEvents(Request $request)
{
    $searchQuery = $request->input('searchQuery');

    // Query the events based on the searchQuery
    $filteredEvents = event::where('title', 'like', '%' . $searchQuery . '%')
        ->orWhere('description', 'like', '%' . $searchQuery . '%')
        ->get();

    // Return the filtered events as JSON
    return response()->json($filteredEvents);
}

    public function events(){
           $usertype=Auth()->user()->usertype;
            if($usertype=='mdrrmo'){
                  $events= event::select('events.*', 'users.name as municipality_name')
            ->join('users', 'events.userid', '=', 'users.id')->get();
                return view('mdrrmo.ScheduleTable', ['events'=>$events]);
            }
            else if($usertype=='pdrrmo'){
                $events = event::all();
                return view('pdrrmo.ScheduleTable', ['events'=>$events]);
            }
           else {
            return redirect()->back();
            }
         
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $sched = event::where('title', 'like', '%' . $searchTerm . '%')->get();
               $currentUserId = Auth::id();
                    $user = User::where('id', $currentUserId)->get();
                    $events = event::all();
                    $currentUserId = Auth::id(); 
           return view('mdrrmo.Scheduling', ['currentUserId' => $currentUserId, 'events'=>$events, 'scheds'=>$sched, 'users' =>$user]);
    }
    public function modify(Request $request){

         $id=$request->input('event-id');
         $event= $request->input('event-Title');
     
           $event = event::findOrFail($id);

        $event->title = $request->input('event-Title');
        $event->description = $request->input('event-Description');
        $event->involved = $request->input('involveds');
        $event->start_time = $request->input('event-Start');
        $event->end_time = $request->input('event-End');
        $event->location = $request->input('locations');
        $event->involved= 'pdrrmo';
        $event->save();
        return redirect()->back()->with('success', 'Record updated successfully!');
    }
    /**
     * Show the form for creating a new resource.
     */
     public function update(Request $request)
        {     

            $id=$request->input('eventId');
            $title =$request->input('event-Title');
            $desc =$request->input('event-Description');
            $timestart =$request->input('event-Start');
            $timeend =$request->input('event-End');
            $locations =$request->input('locations');
     
            $event = event::findOrFail($id);
            //Decode the JSON string to an array, or initialize an empty array if it's null
            $participantsArray = json_decode($event->participants, true) ?? []; 
            // Check if the current user's name is already a participant
            $username = Auth()->user()->name;
            if (array_key_exists($username, $participantsArray)) {
                // Update the attendance for the existing participant
                $participantsArray[$username] = $request->input('event-attendance');
            } else {
                // Add a new participant
                $participantsArray[$username] = $request->input('event-attendance');
            }
            // Encode the updated or new participants array back to JSON
            $participantsJson = json_encode($participantsArray);
            // Update the event's participants field
            $event->participants = $participantsJson;
            $event->title = $title;
             $event->description = $desc;
             $event->start_time = $timestart;
             $event->end_time = $timeend;
             $event->location = $locations;
            // $event->involved= 'Mdrrmo';
            $event->save();

            // Optionally, you can return a response or redirect
            // For example, you can return a JSON response:
        return redirect()->back()->with('success', 'Successfully submitted!');
        }
        public function tableupdate(Request $request)
        {     
            
            $eventId = $request->input('eventId');

            $request->validate([
                'eventId' => 'required|integer',
                'event-title' => 'required|string',
                'event-Description' => 'required|string',
                'event-Start' =>'required',
                'event-End' => 'required',
                'locations' => 'required|string',
            ]);
                
            // Get the event ID from the request
           
            // Find the event by ID
            $event = Event::find($eventId);
    
            // Update the event with the new data
            $event->title = $request->input('event-title');
            $event->description = $request->input('event-Description');
            $event->start_time = $request->input('event-Start');
            $event->end_time = $request->input('event-End');
            $event->location = $request->input('locations');
    
            // Save the updated event
            $event->save();
    
            // Redirect back or return a response
            return redirect()->back()->with('success', 'Event updated successfully');
       
        }
     public function details($id)
        {
        
            $usernameToFind = Auth()->user()->name;
  
            $partnerValue = '';
        
            // Ensure 'participants' field is not empty
            if (!empty($event->participants) && isset($event->participants[$usernameToFind])) {
                $partnerValue = $event->participants[$usernameToFind];
            }
            $events = event::findOrFail($id);
            $event= event::select('events.*', 'users.name as municipality_name', 'users.usertype as type')
            ->join('users', 'events.userid', '=', 'users.id')
            ->where('events.id', '=', $id)
            ->first();
            $currentUserId = Auth::id();
            $responseData = [
                'username'=> $usernameToFind,
                'event' => $event,
                'currentUserId' => $currentUserId,
                'partnerValue' => $partnerValue,
            ];

return response()->json($responseData);

        }

    public function index(Request $request)
    {
  
        if($request->ajax()) {
            $currentUserId = Auth::id();

            $data = Event::where(function ($query) use ($currentUserId) {
                $query->where('userid', $currentUserId)
                      ->orWhere('recipientId', $currentUserId)
                      ->orWhere('recipientId', '-0');
            })
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['id', 'title', 'start', 'end' ]);
        
            
  
             return response()->json($data);
        }
  
        return view('welcome');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
        $currentDate = Carbon::now();
        $currentDate->setTimezone('Asia/Manila');
         $currentUserId = Auth::id();
        switch ($request->type) {
           case 'add':
            if (Auth::id()) {
                $usertype = Auth()->user()->usertype;
            
                if ($usertype == 'pdrrmo') {
                    if ($request->recipient == 'all') {
                        $randomNumber = strval(mt_rand(100000, 999999));
                        $currentUserName = Auth::user()->name;
            
                        $event = Event::create([
                            'recipientId' => '-0',
                            'randomId' => $randomNumber,
                            'title' => $request->title,
                            'userid' => $currentUserId,
                            'location' => $request->location,
                            'start' => $request->start,
                            'end' => $request->end,
                            'start_time' => $request->timeStart,
                            'end_time' => $request->timeEnd,
                            'description' => $request->description,
                        ]);
            
                        $newlyInsertedId = $event->id;
            
                        $mdrrmoUsers = User::where('usertype', 'mdrrmo')->get();
            
                        foreach ($mdrrmoUsers as $mdrrmoUser) {
                            Notification::send($mdrrmoUser, new AttendanceNotification($newlyInsertedId, $currentUserName, 'has sent a schedule'));
                        }
                        return response()->json($event);
                    } else {
                        $recipientIds = explode(',', $request->recipient);
                        $randomNumber = strval(mt_rand(100000, 999999));
            
                        foreach ($recipientIds as $recipientId) {
                            $notifiableUser = User::where('id', '!=', $currentUserId)->get();
                            $user = User::find($recipientId);
                            $currentUserName = Auth::user()->name;
            
                            $event = Event::create([
                                'recipientId' => $recipientId,
                                'randomId' => $randomNumber,
                                'title' => $request->title,
                                'userid' => $currentUserId,
                                'location' => $request->location,
                                'start' => $request->start,
                                'end' => $request->end,
                                'start_time' => $request->timeStart,
                                'end_time' => $request->timeEnd,
                                'description' => $request->description,
                            ]);
            
                            $newlyInsertedId = $event->id;
            
                            $mdrrmoUsers = User::where('usertype', 'mdrrmo')->get();
            
                            Notification::send($user, new AttendanceNotification($newlyInsertedId, $currentUserName, 'has sent a schedule'));
                            return response()->json($event);
                        }
                    }
                }    else if($usertype=='mdrrmo'){
                    // Code to handle the case when $usertype is not 'pdrrmo'
                    $currentUserName = Auth::user()->name;
                    $currentUserId = Auth::id();
                    $event = Event::create([
                        'recipientId' => $currentUserId,
                        'title' => $request->title,
                        'userid' => $currentUserId,
                        'location' => $request->location,
                        'start' => $request->start,
                        'end' => $request->end,
                        'start_time' => $request->timeStart,
                        'end_time' => $request->timeEnd,
                        'description' => $request->description,
                    ]);
                    return response()->json($event);
                }
            } else {
                return redirect()->back();
            }
            
            
             
             break;
  
           case 'update':
              $event = event::find($request->id)->update([
                  'title' => $request->title,
                  'description' => $request->description,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
    public function table(){
        $usertype=Auth()->user()->usertype;
        $currentUserId = Auth::id();
        if($usertype=='mdrrmo'){
            $events = Event::select('events.*', 'users.name as recipient_name')
            ->leftJoin('users', 'events.userid', '=', 'users.id')
            ->where(function ($query) use ($currentUserId) {
                $query->where('events.userid', $currentUserId)
                    ->orWhere('events.recipientId', $currentUserId)
                    ->orWhere('events.recipientId', '-0');
            })
            ->get();
        
            return view('mdrrmo.ScheduleTable', ['events'=>$events]);
        }
        else if($usertype=='pdrrmo'){
        
            $events = Event::where('userid', $currentUserId)->get();

            return view('pdrrmo.ScheduleTable', ['events'=>$events]);
        }
    else {
        return redirect()->back();
        }
    }

    public function read($notificationId){
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        
        // Assuming the 'id' key exists in the 'data' array of the notification
        $notificationDataId = $notification->data['newid'];

        return redirect('/mdrrmo/Schedule')->with('notificationId',$notificationDataId);
    }
    public function sched($id){
        try {
            $record = Event::findOrFail($id);
        
            // Get the current user ID, replace this with the actual logic to get the user ID
            $currentUserId = auth()->user()->id; // Adjust this based on your authentication logic
        
            // Add the current user ID to the record data
            $responseData = [
                'record' => $record,
                'currentUserId' => $currentUserId,
            ];
        
            return response()->json($responseData);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        
    }
    public function storeevent(){
        dd('dd');
    }
    public function filtereventmdrrmo(Request $request){
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $end_date = Carbon::parse($end_date)->endOfDay();
        $events = Event::select('events.*', 'users.name as recipient_name')
        ->leftJoin('users', 'events.userid', '=', 'users.id')
        ->where(function ($query) use ($currentUserId) {
            $query->where('events.userid', $currentUserId)
                ->orWhere('events.recipientId', $currentUserId)
                ->orWhere('events.recipientId', '-0');
        })->whereBetween('events.created_at', [$start_date, $end_date])
        ->get();
      
        return view('mdrrmo.ScheduleTable', [ 'events'=>$events, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'), 'persons' => $persons]);
 
    }
    public function filtereventpdrrmo(Request $request){
        $persons = User::where('id', '!=', $currentUserId)->get();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $end_date = Carbon::parse($end_date)->endOfDay();
        $events = Event::where('userid', $currentUserId)->whereBetween('events.created_at', [$start_date, $end_date])->get();
        return view('mdrrmo.ScheduleTable', ['events'=>$events, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'), 'persons' => $persons]);
 
    }
}
