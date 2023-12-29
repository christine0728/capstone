<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\severity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SeverityController extends Controller
{
    //
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $user = User::where('id', $currentUserId)->get();
        $currentUserId = auth()->id();

        $severity = severity::where('userId', $currentUserId)->get();
            return view('mdrrmo.severity', ['severities' => $severity, ]);

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
        
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            // Add other validation rules as needed
        ]);
        $now = Carbon::now();
        $now->setTimezone('Asia/Manila');
        $currentUserId = auth()->id();
        // Create a new Severity model instance
        $severity = new severity();

        // Set the attributes
        $severity->userId = $currentUserId;
        $severity->name = $request->input('name');
        $severity->description = $request->input('desc');
        $severity->created_at = $now;
        // Set other attributes as needed

        // Save the record to the database
        $severity->save();

        // Redirect or do other actions after insertion
         return redirect()->back()->with('message', 'Successfully Added!');
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
            $record = severity::findOrFail($id);
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
        $request->validate([
            'update-name' => 'required|string|max:255',
            'update-desc' => 'required|string',
            'inc-id' => 'required|numeric', // Assuming 'inc-id' is a numeric field
            // Add other validation rules as needed
        ]);

        // Retrieve the incident model by ID
        $severity = severity::find($request->input('inc-id'));

        if ($severity) {
            // Update the attributes
            $severity->name = $request->input('update-name');
            $severity->description = $request->input('update-desc');

            // Save the changes to the database
            $severity->save();

            return redirect()->back()->with('success', 'Record updated successfully!');
        }

        return redirect()->back()->with('error', 'Severity not found.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        //
        $request = severity::find($id);
        $request->delete();
        return redirect()->back();
    }
}
