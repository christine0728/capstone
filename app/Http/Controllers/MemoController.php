<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use Carbon\Carbon;
use App\Models\memo_municipality;
use App\Models\User;
use App\Notifications\MemoNotification;
use Illuminate\Support\Facades\Notification;
use DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::id()){
            $usertype=Auth()->user()->usertype;
            if($usertype=='pdrrmo'){
        $currentUserId = Auth::id();
            $recepients = User::where('id', '<>', $currentUserId)
            ->orderBy('name', 'asc') // Order by the 'name' field in ascending order
            ->get();      
            
                $memos = Memo::all();
    
       return view('pdrrmo.memo' , ['memos' => $memos, 'recepient'=> $recepients]);
    }
    else if($usertype=='mdrrmo'){
        $user = Auth::user();
        $currentUserId = Auth::id();

    
        $memos = memo_municipality::with(['memo' => function ($query) {
            $query->select('id', 'subject', 'notes', 'attachments'); // Select the columns you need
        }])
        ->where('municipality_id', $currentUserId)
        ->get();
    return view('mdrrmo.memo', ['memos' => $memos, 'notificationId' => '']);
    }}

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function RecipientContent($id)
    {
        $memo = Memo::with('memoMunicipalities.municipality')->findOrFail($id);
        try {
            $recipients = $memo->memoMunicipalities->map(function ($memoMunicipality) {
                return $memoMunicipality->municipality->name ?? 'All municipalities';
            })->toArray();
            
            // Return the recipients in the response
            return response()->json(['recipients' => $recipients]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        }

    
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    
        $rules = [
            'attachments' => 'required|mimes:pdf,doc,docx,xls,xlsx',
            'subject' => 'required'
        ];
        $customError = [
            'mimes' => 'This file is not allowed.',
            'required' => 'Fill in the textbox',
        ];

        $selectedRecipients=$request->input('recipients');
        $currentDate = Carbon::now();
        $currentDate->setTimezone('Asia/Manila');
    
        $currentUserId = Auth::id();
        $currentUserName = Auth::user()->name;
        $notes = $request->input('notes');
        $attachments = $request->file('attachments');
        $subject = $request->input('subject');
        
        $this->validate($request, $rules, $customError);
        $userstosend = $request->input('userid');
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        // Attach recipients if specified
     
       
            // Step 1: Insert into the 'memos' table
            $file = $request->file('attachments');
            $originalFilename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // Create filename without the extension
            $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
            // Get current date and time
            $currentDateTime = now()->format('Ymd_His');
            // Append date and time to the filename
            $filename = $filenameWithoutExtension . '_' . $currentDateTime . '.' . $extension;
            $file->move('uploads/memo/', $filename);
         
    
            $memo = Memo::create([
                'subject' => $request->input('subject'),
                'notes' => $request->input('notes'),
                'attachments'=> $filename ,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

       
            // Step 2: Insert into the 'memo_municipalities' table
            if ($request->has('send_to_all') && $request->input('send_to_all')) {
                $mdrrmoUsers = User::where('usertype', 'mdrrmo')->get();
                foreach ($mdrrmoUsers as $mdrrmoUser) {
                    DB::table('memo_municipalities')->insert([
                        'memo_id' => $memo->id,
                        'municipality_id' => $mdrrmoUser->id, // Assuming 'user_id' is the correct column
                        'created_at' => $now,
                        'updated_at' =>$now,
                    ]);
                    Notification::send($mdrrmoUser, new MemoNotification($memo->id, auth()->user()->name, $filename, 'has sent a file'));
                 
                }
                return redirect()->back()->with('success', 'Memo created successfully!');
            } else {

                // Send notifications to selected recipients
                    foreach ($selectedRecipients as $recipientId) {
                        DB::table('memo_municipalities')->insert([
                            'memo_id' => $memo->id,
                            'municipality_id' => $recipientId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $notifiableUser = User::find($recipientId); // Replace with your actual User model
                        Notification::send($notifiableUser, new MemoNotification($memo->id, auth()->user()->name, $filename, 'has sent a file'));
                    }

                    return redirect()->back()->with('success', 'Memo created successfully!');
            }

        
            // Handle the exception
            return redirect()->back()->with('error', 'Error creating memo: ' . $e->getMessage());
    

    }

    public function download($filename) {
        dd('f');
        $filePath = 'uploads/memo/' . $filename;
        $file = Storage::get($filePath);
        $type = Storage::mimeType($filePath);
    
        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function filter(Request $request)
    {
        //
       
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $role = Auth()->user()->usertype;
        if ($role === 'pdrrmo') {
       
                        $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $end_date = Carbon::parse($end_date)->endOfDay();    
            $memos = Memo::whereBetween('created_at', [$start_date, $end_date])->get();

                $recipients = User::where('id', '<>', $currentUserId)
                ->orderBy('name', 'asc') // Order by the 'name' field in ascending order
                ->get();            
              return view('pdrrmo.memo', [  'notificationId'=>'','memos' => $memos, 'recepient'=> $recipients, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'), 'persons' => $persons]);
     
        } elseif ($role === 'mdrrmo') {
    
            $memos = memo_municipality::with(['memo' => function ($query) {
                $query->select('id', 'subject', 'notes', 'attachments'); // Select the columns you need
            }])
            ->where('municipality_id', $currentUserId)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        
        $recepient = User::where('id', '<>', $currentUserId)->get();
          return view('mdrrmo.memo', [ 'notificationId'=>'','memos' => $memos, 'recepient'=> $recepient, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'), 'persons' => $persons]);
   }
    }
    public function getRead(string $id){
        // dd($id);
            $usersAndMemoReads = DB::table('users')
                ->leftJoin('memo_reads', 'users.id', '=', 'memo_reads.userid')
                ->where('memo_reads.memoid', '=', $id)
                ->select('users.name as municipality_name', 'memo_reads.read_at')
                ->get();

            $municipalityNames = [];

            foreach ($usersAndMemoReads as $record) {
                $municipalityNames[] = $record->municipality_name;
            }

            return response()->json($municipalityNames);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        try {
            $record = Memo::findOrFail($id);
        
            // Access subject and notes
            $subject = $record->subject;
            $notes = $record->notes;
        
            // You can return or use the values as needed
            return response()->json(['subject' => $subject, 'notes' => $notes]);
        
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
        $id= $request->input('memoId');
        $subjects = $request->input('subjects');
        $note= $request->input('note');
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        DB::table('memos')
        ->where('id', $id)
        ->update([
            'subject' => $subjects,
            'notes' => $note,
            'updated_at' => $now,
        ]);

        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function memoNotifs($notificationId)
    {
      
        $username=Auth()->user()->name;
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        $memo = memo_municipality::with(['memo' => function ($query) {
            $query->select('id', 'subject', 'notes', 'attachments'); // Select the columns you need
        }])
        ->where('municipality_id', $currentUserId)
        ->get();
        // Assuming the 'id' key exists in the 'data' array of the notification
        $notificationDataId = $notification->data['newid'];
  
       $currentUserId = Auth::id();
       $user = User::where('id', $currentUserId)->get();
       return view('mdrrmo.memo' , ['notificationId'=>$notificationDataId, 'memos' => $memo]);

    }
    public function destroy(string $id)
    {
        //
         $request = Memo::find($id);
 
        $request->delete();
        return redirect()->back();
    }
    public function markAsRead(string $id)
    {
        $currentUserId = Auth::id();
      
      
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
       
        // Find the corresponding memoMunicipality for the current user
        $memoMunicipality = memo_municipality::where('id', $id)
            ->where('municipality_id', $currentUserId)
            ->first();
    
        if ($memoMunicipality) {
            // Update the memoMunicipality to mark as read
            $memoMunicipality->update(['read_at' => $now]);
    
            return redirect()->back()->with('success', 'Memo marked as read successfully.');
        }
    
        // If $memoMunicipality is null, redirect with success message
        return redirect()->back()->with('success', 'Memo marked as read successfully.');
    }
    
    public function  markall(){
        $currentUser = Auth::id();
        $now = now()->setTimezone('Asia/Manila');
        $currentUserId = Auth::id();
        // Get all memo IDs from the Memo table
        memo_municipality::where('municipality_id', $currentUserId)
        ->update(['read_at' => $now]);
    
    return redirect()->back()->with('success', 'All memos marked as read successfully.');
        
    }
public function view($filename){
    
    $currentUserId = Auth::id();
    $persons = User::where('id', '!=', $currentUserId)->get();
    $path = public_path('uploads/memo/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }

    $mimeType = mime_content_type($path);

    return response()->file($path, [
        'Content-Type' => $mimeType,
    ]);
}


}
