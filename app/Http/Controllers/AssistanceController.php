<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\assistance_request;
use App\Notifications\UpdateAssistanceNotification;
use Carbon\Carbon;
use App\Models\severity;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AssistanceNotification;
use App\Models\incidents;
use App\Models\User;
use App\Models\Referral;
class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //
        if(Auth::check())
        {
            $usertype=Auth()->user()->usertype;
            $username=Auth()->user()->name;
            $currentUserId = Auth::id();
            $persons = User::where('id', '!=', $currentUserId)->get();
            if($usertype=='mdrrmo'){
                

                 $severity = severity::where('userId', $currentUserId)->get();
                $incident = incidents::all();
                $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
                ->join('users', 'users.id', '=', 'assistance_requests.ownerId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.userId',  $currentUserId)
                ->orderBy('assistance_requests.created_at', 'desc')
                ->get();
          

                $owners = User::where('id', '<>', $currentUserId)
                ->orderBy('name') // Change 'name' to the actual column you want to use
                ->get();
            
            
                return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
             }
            else if($usertype=='pdrrmo'){

                $incident = incidents::all();
                $owners = User::where('id', '<>', $currentUserId)
                ->orderBy('name') // Change 'name' to the actual column you want to use
                ->get();
                $assistances = assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.ownerId', $currentUserId)
                ->orderBy('assistance_requests.created_at', 'desc') // Order by created_at in descending order
                ->get();
                return view('pdrrmo.assistance', ['assistance' => $assistances, 'incidents' => $incident, 'persons' => $persons, 'owners' => $owners]);        
            }
        }
    }
  
    public function  received()
    {
        //
        if(Auth::check())
        {
            $role = Auth()->user()->usertype;
            $usertype=Auth()->user()->usertype;
            $username=Auth()->user()->name;
            $currentUserId = Auth::id();
            $persons = User::where('id', '!=', $currentUserId)->get();
            $owners = User::where('id', '<>', $currentUserId)->get();
            if($usertype=='mdrrmo'){
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where(function ($query) use ($currentUserId) {
                    $query->where('assistance_requests.ownerId', $currentUserId)
                          ->orWhere('assistance_requests.referred_id', $currentUserId);
                })
                ->orderBy('assistance_requests.id', 'desc')
                ->get();
            
                return view('mdrrmo.receive_assistance', ['notificationId'=>'','reports' => $assistances, 'incidents' => $incident,'persons' => $persons,'owners' => $owners]);        
             }
            else if($usertype=='pdrrmo'){
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where(function ($query) use ($currentUserId) {
                    $query->where('assistance_requests.ownerId', $currentUserId)
                          ->orWhere('assistance_requests.referred_id', $currentUserId);
                })
                ->orderBy('assistance_requests.id', 'desc')
                ->get();
            
            
                return view('pdrrmo.receive_assistance', ['notificationId'=>'','reports' => $assistances, 'incidents' => $incident, 'persons' => $persons, 'owners' => $owners]);        
            }
        }
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
    public function store(Request $request)
    {
        //
 
        $request->validate([
       
            'location' => 'nullable',
          
            'incident_desc' => 'nullable',
        
            // Add validation rules for other fields
        ]);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $ownerId = $request->owner; 

        $currentUserId = Auth::id();
        $incident = new assistance_request();
        $incident->userId =$currentUserId;
        $incident->ownerId= $request->owner;
        $incident->action_taken= $request->action_taken;
        $incident->severityId = $request->severity;
        $incident->incidentId = $request->incident;
        $incident->location = $request->location;
        $incident->date_needed = $request->date_needed;
        $incident->date_happened = $request->date_happened;
        $incident->incident_desc = $request->incident_desc;
        $incident->created_at =$now;
        $incident->referred_id = $request->owner;
        $incidentId = $request->incident;
        $incidentType = incidents::find($incidentId);
        $incident->save();
        // $referral = new Referral();
        //     $referral->original_request_id =$incident->id;
        //     $referral->new_receiver_id  =$currentUserId;
        //     $referral->created_at =$now;
        //     $referral->updated_at =$now;
        //     $referral->save();
            $currentUserName = Auth::user()->name;
            $image = Auth::user()->image;
            $incidentName = $incidentType->name;
            $notifiableUser = User::find($ownerId);
            $newlyInsertedId = $incident->id;
           
            Notification::send($notifiableUser, new AssistanceNotification($newlyInsertedId, $incidentName, $currentUserName, 'is requesting assistance', $image));
         
            return redirect()->back()->with('success', 'Succesfully Added!');
            // Now, $incidentName contains the name of the incident with the given ID.
        
         
            // Handle the case where the incident with the specified ID was not found.
      
     

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function updateStatus(Request $request)
    {

        $now = Carbon::now();
        $currentUserId = Auth::id();
        $now->setTimezone('Asia/Manila');
        $id = $request->input('id-req');
        $userid = $request->input('userid');
        $referto = $request->input('owner');
    
        $status = $request->input('status-req');
        
        $comment = $request->input('comment') ?? 'None'; // Set 'None' as the default value if $comment is null
    
        // Retrieve the incident by its ID
        $incident = assistance_request::find($id);
        if ($status === 'Accepted') {
            $referral = Referral::where('request_id', $id)
            ->orderByDesc('created_at')
            ->first();
            if($referral){
                $referral->update([
                    'status' => $status,
                    'updated_at' => $now
                ]);
            }
            $incident->update([
                'req_status' => $status,
                'comment' => $comment,
                'updated_at' => $now
            ]);
            $currentUserName = Auth::user()->name;
            $notifiableUser = User::find($userid);

            Notification::send($notifiableUser, new UpdateAssistanceNotification($id, $status, $currentUserName, 'has responded to your request'));
        }
        // if ($incident->req_status === 'Declined') {
        //     $incident->update([
             
        //         'comment' => $comment,
               
        //     ]);
        //     return redirect()->back()->with('success', 'This request is already Declined.');
        // }
        if($status === "Pending"){
            $referral = new Referral();
            $referral->request_id =$id;
            $referral->referred_to  =$referto;
            $referral->referred_by  =$currentUserId;
            $referral->status = 'Waiting to response';
            $referral->created_at =$now;
            $referral->updated_at =$now;
            $referral->save();
            $incident->update([
                'referral_status' => "Referred",
                'referred_id' => $referto,
                'req_status' => $status,
                'comment' => $comment,
                'update_req_status' => $now
            ]);
        }
    
        // $currentUserName = Auth::user()->name;
        // $notifiableUser = User::find($userid);

        // Notification::send($notifiableUser, new UpdateAssistanceNotification($id, $status, $currentUserName, 'has responded to your request'));

        return redirect()->back()->with('success', 'Status successfully updated!');
    }

    public function getReferralHistory($id)
    {
        // Retrieve referral history based on $id from the database
        $referralHistory = Referral::join('users as referred_users', 'referrals.referred_to', '=', 'referred_users.id')
        ->join('users as referring_users', 'referrals.referred_by', '=', 'referring_users.id')
        ->join('assistance_requests', 'referrals.request_id', '=', 'assistance_requests.id')
        ->select(
            'referrals.*',
            'referrals.created_at as createddate',
            'referring_users.name as referred_by_name',
            'referred_users.name as referred_to_name',
            'referrals.status as status',
            'assistance_requests.*'
        )
        ->where('referrals.request_id', $id)
        ->orderByDesc('referrals.created_at')
        ->get();

        return response()->json($referralHistory);
    }
    
    public function ReceivedNotifs($notificationId){

        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        $incident = incidents::all();
        $owners = User::where('id', '<>', $currentUserId)->get();
        $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
        ->join('users', 'users.id', '=', 'assistance_requests.userId')
        ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
        ->where('assistance_requests.ownerId', $currentUserId)
        ->orderBy('assistance_requests.created_at', 'desc')
        ->get();
    
        
        // Assuming the 'id' key exists in the 'data' array of the notification
        $notificationDataId = $notification->data['newid'];
     
        return view('mdrrmo.receive_assistance',  [ 'notificationId'=> $notification->data['newid'],'reports' => $assistances, ]);

       // return redirect('/mdrrmo/receive-assistance/')->with('notificationId',$notificationDataId);
        // return view('pdrrmo.receive_assistance', ['notificationId'=>$notificationDataId,'reports' => $assistances, 'incidents' => $incident]);        
        
           
}
public function ReceivedNotifspd($notificationId){

    $username=Auth()->user()->name;
    $currentUserId = Auth::id();
    $notification = Auth::user()->notifications()->findOrFail($notificationId);
    $notification->markAsRead();
    $owners = User::where('id', '<>', $currentUserId)
    ->orderBy('name') // Change 'name' to the actual column you want to use
    ->get();
    
    // Assuming the 'id' key exists in the 'data' array of the notification
    $notificationDataId = $notification->data['newid'];
    $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
    ->join('users', 'users.id', '=', 'assistance_requests.userId')
    ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
    ->where('assistance_requests.ownerId', $currentUserId)
    ->orderBy('assistance_requests.created_at', 'desc')
    ->get();
  
    return view('pdrrmo.receive_assistance', ['owners'=> $owners,'reports' => $assistances,'notificationId'=>$notificationDataId, 'reports' => $assistances]);        

  // return view('pdrrmo.receive_assistance', ['notificationId'=>$notificationDataId,'reports' => $assistances, 'incidents' => $incident]);        
    
       
}
    /**
     * Show the form for editing the specified resource.
     */
    public function StatusNotifs($notificationId){
       
     
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        // Mark the notification as read
        $notification->markAsRead();
        $notificationDataId = $notification->data['newid'];

        return redirect('/mdrrmo/request-assistance')->with('notificationId',$notificationDataId);
    }
    public function edit(string $id)
    {
        //
        try {
            $record = assistance_request::join('users', 'assistance_requests.userid', '=', 'users.id')
            ->join('incidents', 'assistance_requests.incidentId', '=', 'incidents.id')
            ->join('severities', 'assistance_requests.severityId', '=', 'severities.id') // Add this line
            ->select('assistance_requests.*', 'users.name as name', 'incidents.name as incident_name', 'severities.name as severity_name') // Include the severity name
            ->findOrFail($id);        
        
    
            return response()->json($record);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        }


        return response()->json($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id= $request->id;
        $incident = assistance_request::find($id); // Retrieve the incident by its ID

if ($incident) {
   
    $now = Carbon::now();
    $now->setTimezone('Asia/Manila');
    $incident->update([
        'severityId' => $request->severity,
        'action_taken' => $request->actionTaken,
        'location' => $request->location,
        'date_needed' => $request->dateNeeded,
        'date_happened' => $request->dateHappened,
        'incident_desc' => $request->incidentDesc,
        'updated_at' => $request->$now
    ]);
    return redirect()->back()->with('success', 'Succesfully Updated!');
    } else {
    
        
    }
    }
    
        public function accepted(){
                    if(Auth::id()){
            $usertype=Auth()->user()->usertype;
            $username=Auth()->user()->name;
            $currentUserId = Auth::id();
            $severity = severity::where('userId', $currentUserId)->get();
         
            $persons = User::where('id', '!=', $currentUserId)->get();
            $owners = User::where('id', '<>', $currentUserId)->get();
            if($usertype=='mdrrmo'){
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.ownerId', $currentUserId)
                ->where('req_status', 'Accepted')
                ->get();
                return view('mdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident]);        
             }
            else if($usertype=='pdrrmo'){
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.ownerId', $currentUserId)
                ->where('req_status', 'Accepted')
                ->get();
                return view('pdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident, 'persons' => $persons]);        
            }
            }
            else {
            return redirect()->back();
    }


    }
    public function declined(){
            if(Auth::id()){
                $usertype=Auth()->user()->usertype;
                $username=Auth()->user()->name;
                $currentUserId = Auth::id();
                
                $severity = severity::where('userId', $currentUserId)->get();
            $usertype=Auth()->user()->usertype;
            if($usertype=='mdrrmo'){
                
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.ownerId', $currentUserId)
                ->where('req_status', 'Declined')
                ->get();
                return view('mdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident]);        
            }
            else if($usertype=='pdrrmo'){
                $incident = incidents::all();
                $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                ->join('users', 'users.id', '=', 'assistance_requests.userId')
                ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                ->where('assistance_requests.ownerId', $currentUserId)
                ->where('req_status', 'Declined')
                ->get();
                return view('pdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident]);        
            }
            }
            else {
            return redirect()->back();
            }

    }
    public function Pending(){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
                if(Auth::id()){
                $usertype=Auth()->user()->usertype;
                if($usertype=='mdrrmo'){
                    $incident = incidents::all();
                    $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                    ->join('users', 'users.id', '=', 'assistance_requests.userId')
                    ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                    ->where('assistance_requests.ownerId', $currentUserId)
                    ->where('req_status', 'Pending')
                    ->get();
                    
                 $severity = severity::where('userId', $currentUserId)->get();
                    return view('mdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident]);        
             }
                else if($usertype=='pdrrmo'){
                    
                 $severity = severity::where('userId', $currentUserId)->get();
                    $incident = incidents::all();
                    $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                    ->join('users', 'users.id', '=', 'assistance_requests.userId')
                    ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                    ->where('assistance_requests.ownerId', $currentUserId)
                    ->where('req_status', 'Pending')
                    ->get();
                    return view('pdrrmo.receive_assistance', ['severities'=> $severity, 'notificationId'=>'','reports' => $assistances, 'incidents' => $incident]);        
                }
                }
                else {
                return redirect()->back();
                }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $request = assistance_request::find($id);
        $request->delete();
       return redirect()->back();
    }
    public function filterassistance(Request $request)
    {
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        
        $owners = User::where('id', '<>', $currentUserId)
        ->orderBy('name') // Change 'name' to the actual column you want to use
        ->get();
    
        $persons = User::where('id', '!=', $currentUserId)->get();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $end_date = Carbon::parse($end_date)->endOfDay();
            $incident = incidents::all();
            $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
            ->join('users', 'users.id', '=', 'assistance_requests.userId')
            ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->where('assistance_requests.userId',  $currentUserId)
            ->orderBy('assistance_requests.created_at', 'desc')
            ->whereBetween('assistance_requests.created_at', [$start_date, $end_date])
            ->get();
      

            $severity = severity::where('userId', $currentUserId)->get();
            $owners = User::where('id', '<>', $currentUserId)->get();
        
            return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
         
    }
    
    public function filter(Request $request){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $incident = incidents::all();
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date = date('Y-m-d', strtotime($start_date));
        
        $owners = User::where('id', '<>', $currentUserId)
        ->orderBy('name') // Change 'name' to the actual column you want to use
        ->get();
    
        $end_date = date('Y-m-d', strtotime($end_date));
        $end_date = Carbon::parse($end_date)->endOfDay();
                if(Auth::id()){
                $usertype=Auth()->user()->usertype;
                if($usertype=='mdrrmo'){

                    $incident = incidents::all();
                    $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                    ->join('users', 'users.id', '=', 'assistance_requests.userId')
                    ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                    ->where('assistance_requests.ownerId', $currentUserId)
                    ->orderBy('assistance_requests.created_at', 'desc')
                    ->whereBetween('assistance_requests.created_at', [$start_date, $end_date])
                    ->get();
                
                    $severity = severity::where('userId', $currentUserId)->get();
                    return view('mdrrmo.receive_assistance', ['owners'=> $owners,'severities'=> $severity, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'),'reports' => $assistances, 'incidents' => $incident,'persons' => $persons]);        
                  }
                else if($usertype=='pdrrmo'){
                    $assistances = assistance_request::select('users.name as user_name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as report_name')
                    ->join('users', 'users.id', '=', 'assistance_requests.userId')
                    ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
                    ->where('assistance_requests.ownerId', $currentUserId)
                    ->orderBy('assistance_requests.created_at', 'desc')
                    ->whereBetween('assistance_requests.created_at', [$start_date, $end_date])
                    ->get();

                    $severity = severity::where('userId', $currentUserId)->get();
                    return view('pdrrmo.receive_assistance', ['owners'=> $owners,'severities'=> $severity, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'),'notificationId'=>'','reports' => $assistances, 'incidents' => $incident, 'persons' => $persons]);        
                }
                }
                else {
                return redirect()->back();
                }

    }
    public function totalaccepted(){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
    
            $incident = incidents::all();
            $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
            ->join('users', 'users.id', '=', 'assistance_requests.userId')
            ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->where('assistance_requests.userId',  $currentUserId)
            ->orderBy('assistance_requests.created_at', 'desc')
            ->where('req_status', 'accepted')
            ->get();
      
            $severity = severity::where('userId', $currentUserId)->get();

            $owners = User::where('id', '<>', $currentUserId)->get();
        
            return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
        
    }
    public function totalsent(){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
    
            $incident = incidents::all();
            $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
            ->join('users', 'users.id', '=', 'assistance_requests.userId')
            ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->where('assistance_requests.userId',  $currentUserId)
            ->orderBy('assistance_requests.created_at', 'desc')
            ->get();
      

            $severity = severity::where('userId', $currentUserId)->get();
            $owners = User::where('id', '<>', $currentUserId)->get();
        
            return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
        
    }
    public function totaldeclined(){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
    
            $incident = incidents::all();
            $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
            ->join('users', 'users.id', '=', 'assistance_requests.userId')
            ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->where('assistance_requests.userId',  $currentUserId)
            ->orderBy('assistance_requests.created_at', 'desc')
            ->where('req_status', 'declined')
            ->get();
      

            $owners = User::where('id', '<>', $currentUserId)->get();
        
            $severity = severity::where('userId', $currentUserId)->get();
            return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
        
        
    }
    public function totalpending(){
        $usertype=Auth()->user()->usertype;
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
    
            $incident = incidents::all();
            $assistances =assistance_request::select('users.name', 'assistance_requests.*', 'incidents.id as incident_id', 'incidents.name as incident_name')
            ->join('users', 'users.id', '=', 'assistance_requests.userId')
            ->join('incidents', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->where('assistance_requests.userId',  $currentUserId)
            ->orderBy('assistance_requests.created_at', 'desc')
            ->where('req_status', 'Pending')
            ->get();
      

            $severity = severity::where('userId', $currentUserId)->get();
            $owners = User::where('id', '<>', $currentUserId)->get();
        
            return view('mdrrmo.assistance', ['severities'=> $severity, 'assistance' => $assistances, 'incidents' => $incident, 'owners'=> $owners,'persons' => $persons, 'notificationId'=>'']);        
       
    }
}
