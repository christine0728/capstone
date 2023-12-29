<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\assistance;
use App\Models\User;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        if(Auth::check())
        {
           
                $assistance= assistance::all();
                return view('pdrrmo.request', ['assistances' => $assistance, 'persons' => $persons]);        
            
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
      
        $validatedData = $request->validate([
            'request' => 'required',
            'description' => 'nullable',
        ]);
       
        $assistance = new  assistance();
        $assistance->request = $validatedData['request'];
        $assistance->description = $validatedData['description'];
   
        $assistance->save();
        return redirect()->back()->with('success', 'Success!');
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
             $record = assistance::findOrFail($id);
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
             $name = $request->input('cat-name');
             $id= $request->input('catid');
            
             DB::table('assistances')
                 ->where('id', $id)
                 ->update([
                     'name' => $name,
                 ]);
         return redirect()->back()->with('success', 'Record updated successfully!');
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy(string $id)
     {
         //
            $request = assistance::find($id);
         $request->delete();
        return redirect()->back();
     }
}
