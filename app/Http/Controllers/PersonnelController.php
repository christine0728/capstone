<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Position;
use App\Models\Department;
use DB;
use Illuminate\Support\Facades\Auth;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        if(Auth::id()){
            $currentUserId = Auth::id();
            $user = User::where('id', $currentUserId)->get();
            $usertype=Auth()->user()->usertype;
            if($usertype=='mdrrmo'){
                $department = Department::where('userid', $currentUserId)->get();
                $position = Position::where('userid', $currentUserId)->get();
                         $personnels = Personnel::where('userid', $currentUserId)
                    ->select(
                        'id',
                        'userid',
                        DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name, suffix) as full_name"),
                        'contact_number',
                        'email',
                        'address',
                        'emergency_contact_name',
                        'emergency_contact_number',
                        'created_at',
                        'updated_at'
                    )
                    ->get();
                    return view('mdrrmo.personnel.personnel', ['personnels' => $personnels, 'departments'=> $department, 'positions' => $position, 'users' =>$user,'persons' => $persons]);
              
            }
            else if($usertype=='pdrrmo'){
                $unreadNotificationCount = auth()->user()->unreadNotifications->count();
                $currentUserId = Auth::id();
                $department = Department::where('userid', $currentUserId)->get();
                $position = Position::where('userid', $currentUserId)->get();
                $user = User::where('id', $currentUserId)->get();
                $notifications = auth()->user()->unreadNotifications;
                $personnels = Personnel::where('userid', $currentUserId)
                    ->select(
                        'id',
                        'userid',
                        DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name, suffix) as full_name"),
                        'contact_number',
                        'email',
                        'address',
                        'emergency_contact_name',
                        'emergency_contact_number',
                        'created_at',
                        'updated_at'
                    )
                    ->get();
                    return view('pdrrmo.personnel.personnel', ['departments'=> $department, 'positions' => $position,'personnels' => $personnels, 'notifications' => $notifications, 'unread'=>$unreadNotificationCount, 'persons' => $persons]);
                    
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
           // Validate the incoming data
        $rules=[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number'=> 'numeric',
            'emergency_contact_number' => 'numeric'
        
        ];
          $userID = Auth::id();
          $customeError = [
            'required' => 'Fill in the textbox',
            'numeric' => 'The input must be numeric'
        ];
         $this->validate($request, $rules, $customeError);
          $currentDate = now();


        $fname= $request->input('first_name');
        $mname =$request->input('middle_name');
        $lname= $request->input('last_name');
        $suffix= $request->input('suffix');
        $position =$request->input('position');
        $number=$request->input('contact_number');
        $email=$request->input('email');
        $address = $request->input('address');
        $department =$request->input('department');
        $date_of_birth = $request->input('date_of_birth');
        $date_of_hire = $request->input('date_of_hire');
        $emergency_contact_name = $request->input('emergency_contact_name');
        $emergency_contact_number = $request->input('emergency_contact_number');
        DB::insert('insert into personnels(userid, first_name, middle_name, last_name, suffix, contact_number, email, address,  date_of_birth, date_of_hire, emergency_contact_name, emergency_contact_number, created_at, updated_at, positionId, departmentId) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$userID, $fname, $mname, $lname, $suffix, $number, $email, $address, $date_of_birth, $date_of_hire, $emergency_contact_name, $emergency_contact_number, $currentDate, $currentDate, $position, $department]);


     return redirect()->back()->with('success', 'Personnel Inserted successfully!');
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
         try {
            $record = Personnel::join('positions', 'personnels.positionId', '=', 'positions.id')
            ->join('departments', 'personnels.departmentId', '=', 'departments.id')
            ->select('personnels.*', 'departments.department as department_name', 'positions.position as position_name')
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
        $id=$request->input('id');
        $fname= $request->input('first_name');
        $mname =$request->input('middle_name');
        $lname= $request->input('last_name');
        $suffix= $request->input('suffix');
        $position =$request->input('position');
        $number=$request->input('contact_number');
        $email=$request->input('email');
        $address = $request->input('address');
        $department =$request->input('department');
        $date_of_birth = $request->input('date_of_birth');
        $date_of_hire = $request->input('date_of_hire');
        $emergency_contact_name = $request->input('emergency_contact_name');
        $emergency_contact_number = $request->input('emergency_contact_number');
        $updated = Personnel::where('id', $id)
    ->update([
        'first_name' => $fname,
        'middle_name' => $mname,
        'last_name' => $lname,
        'suffix' => $suffix,
        'positionId' => $position,
        'departmentId' => $department,
        'contact_number' => $number,
        'email' => $email,
        'address' => $address,
        'date_of_birth' => $date_of_birth,
        'date_of_hire' => $date_of_hire,
        'emergency_contact_name' => $emergency_contact_name,
        'emergency_contact_number' => $emergency_contact_number,
    ]);
     return redirect()->back()->with('success', 'Personnel updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
          //
        $request = Personnel::find($id);
        $request->delete();
        return redirect()->back();
    }
    public function filter(Request $request)
    {
        //
          //
          $currentUserId = Auth::id();
          $department = Department::where('userid', $currentUserId)->get();
          $position = Position::where('userid', $currentUserId)->get();
         
          $persons = User::where('id', '!=', $currentUserId)->get();
          $start_date = $request->input('start_date');
          $end_date = $request->input('end_date');
          $start_date = date('Y-m-d', strtotime($start_date));
          $end_date = date('Y-m-d', strtotime($end_date));
          $currentUserId = Auth::id();
          $end_date = Carbon::parse($end_date)->endOfDay();
          $persons = User::where('id', '!=', $currentUserId)->get();
          $user = User::where('id', $currentUserId)->get();
          $personnels = Personnel::where('userid', $currentUserId)
          ->select(
              'id',
              'userid',
              DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name, suffix) as full_name"),
              'contact_number',
              'email',
              'address',
              'emergency_contact_name',
              'emergency_contact_number',
              'created_at',
              'updated_at'
          )
          ->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)
            ->get();
            return view('pdrrmo.personnel.personnel', ['start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'),'departments'=> $department, 'positions' => $position,'personnels' => $personnels, 'persons' => $persons]);
   
    }
    
}
