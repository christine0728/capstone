<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\incidents;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $user = User::where('id', $currentUserId)->get();
        $incidents = incidents::all();
            return view('pdrrmo.incidents', ['incidents' => $incidents, 'persons' => $persons]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $user = User::where('id', $currentUserId)->get();
        $end_date = Carbon::parse($end_date)->endOfDay();

        $incidents = incidents::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->get();
        
return view('pdrrmo.incidents', ['start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'),'incidents' => $incidents, 'persons' => $persons]);

      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required',
            'desc' => 'nullable|string|max:255',
        ];

        $customeError = [
            'required' => 'Fill in the textbox',
             'max' => 'The :attribute field must not exceed 255 characters.',
        ];
        $userID = Auth::id();
        $name = $request->input('name');
        $desc = $request->input('desc') ?? 'none';

         $now = Carbon::now();
         $now->setTimezone('Asia/Manila');
        $this->validate($request, $rules, $customeError);
        DB::insert('insert into incidents(name, description, created_at, updated_at) values ( ?, ?, ?, ?)', [$name, $desc,$now, $now]);
        return redirect()->back()->with('message', 'Incidents Added!');
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
            $record = incidents::findOrFail($id);
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
            $name = $request->input('update-name');
            $desc = $request->input('update-desc');
            $id= $request->input('inc-id');
           
            DB::table('incidents')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'description' => $desc,
                ]);
        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        //
        $request = incidents::find($id);
        $request->delete();
        return redirect()->back();
    }
}
