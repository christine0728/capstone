<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
class ManageAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('usertype', 'mdrrmo')->get();
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $user = User::where('id', $currentUserId)->get();
       // $unreadNotificationCount = auth()->user()->unreadNotifications->count();
        // $notifications = auth()->user()->unreadNotifications;
        return view('pdrrmo.manage_user', [ 'accounts' =>$users,  'users' =>$user, 'persons' => $persons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function details(string $id){
        try {
           $record = User::findOrFail($id);
           return response()->json($record);
       } catch (ModelNotFoundException $e) {
           return response()->json(['error' => 'They have not yet inserted Information'], 404);
       }

       return response()->json($record);
   }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function download($filename) {
        $filePath = 'uploads/logo/' . $filename;
    return response()->download($filePath, $filename);
}
    public function filter(Request $request)
    {
        //

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $user = User::where('id', $currentUserId)->get();
        $end_date = Carbon::parse($end_date)->endOfDay();
        $users = User::where('usertype', 'mdrrmo')
        ->where('created_at', '<=', $end_date)
        ->get();
   
       // $unreadNotificationCount = auth()->user()->unreadNotifications->count();
        // $notifications = auth()->user()->unreadNotifications;
        return view('pdrrmo.manage_user', ['start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date'), 'accounts' =>$users,  'users' =>$user, 'persons' => $persons]);
   
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
 
         $request = User::find($id);
 
        $request->delete();
        return redirect()->back();
    }
}
