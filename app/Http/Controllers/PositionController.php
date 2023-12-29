<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon; 
use App\Models\position;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
class PositionController extends Controller
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
            $usertype=Auth()->user()->usertype;
            if($usertype=='mdrrmo'){
                $currentUserId = Auth::id();
                $position= position::where('userid', $currentUserId)->get();
               
                return view('mdrrmo.personnel.position', [ 'positions' => $position, 'persons' => $persons]);
            }
            else if($usertype=='pdrrmo'){
                $position= position::where('userid', $currentUserId)->get();
                $notifications = auth()->user()->unreadNotifications;
                $currentUserId = Auth::id();

         return view('pdrrmo.personnel.position', [

                'positions' => $position, 'persons' => $persons// You need a comma here
            ]);
            
            }
        }
        else {
            return redirect()->back();
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
        $rules = [
            'position' => 'required|max:255',
            'description' => 'max:400'
        ];

        $customeError = [
            'required' => 'Fill in the textbox',
            'max' => 'The :attribute field cannot be longer than :max characters.',
        ];
        $currentDateTime = Carbon::now(); 
        $currentDateTime->setTimezone('Asia/Manila');
        $this->validate($request, $rules, $customeError);
        $userID = Auth::id();
        $position= $request->input('position');
        $description = $request->input('description');
        if ($description === null) {
        $desc = 'None'; 
        }
        DB::insert('insert into positions(userid, Position, description,created_at, updated_at) values (?, ?, ?, ?, ?)', [$userID, $position, $description, $currentDateTime, $currentDateTime]);

        return redirect()->back()->with('success', 'Personnel Position added successfully.');
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
            $record = position::findOrFail($id);
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

        $rules = [
            'position-name' => 'required|max:255',
            'update-desc' => 'max:400'
        ];

        $customeError = [
            'required' => 'Fill in the textbox',
            'max' => 'The :attribute field cannot be longer than :max characters.',
        ];
        $this->validate($request, $rules, $customeError);
        $id= $request->input('position-id');
        $position= $request->input('position-name');
        $desc = $request->input('update-desc');
        $currentDateTime = Carbon::now();
        $currentDateTime->setTimezone('Asia/Manila');
         DB::table('positions')
        ->where('id', $id)
        ->update([
            'Position' => $position,
            'description' => $desc,
            'updated_at' =>$currentDateTime,   
        ]);

        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $request = position::find($id);
        $request->delete();
        return redirect()->back();
    }
}
