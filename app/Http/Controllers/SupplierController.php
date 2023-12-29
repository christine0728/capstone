<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\supplier;
use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $currentUserId = Auth::id();
        $persons = User::where('id', '!=', $currentUserId)->get();
        if(Auth::id())
        {
            $usertype=Auth()->user()->usertype;
            if($usertype=='mdrrmo'){
                $currentUserId = Auth::id();
                $user = User::where('id', $currentUserId)->get();
                $suppliers = supplier::where('userid', $currentUserId)->get();
                return view('mdrrmo.Inventory.suppliers', ['suppliers'=>$suppliers, 'users' =>$user, 'persons' => $persons]);
            }
            else if($usertype=='pdrrmo'){
                $unreadNotificationCount = auth()->user()->unreadNotifications->count();
                $currentUserId = Auth::id();
                $user = User::where('id', $currentUserId)->get();
                $notifications = auth()->user()->unreadNotifications;
                $suppliers =supplier::where('userid', $currentUserId)->get();
                return view('pdrrmo.Inventory.Supplier', ['suppliers'=>$suppliers, 'notifications' => $notifications, 'users' =>$user, 'unread'=>$unreadNotificationCount, 'persons' => $persons]);        
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
           $rules = [
            'supplier-name' => 'required',
            'contact' => 'required',
            'address' =>'required',
        ];

        $customeError = [
            'required' => 'Fill in the textbox'
        ];
        $userID = Auth::id();
        $id= $request->input('supplier-id');
        $name = $request->input('supplier-name');
        $contact= $request->input('contact');
        $address = $request->input('address');
         $currentDate = now();
        $this->validate($request, $rules, $customeError);
        DB::insert('insert into suppliers(userid, name, contact, address,created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$userID, $name,$contact, $address, $currentDate, $currentDate]);
            return redirect()->back()->with('message', 'Post added!');
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
            $record = supplier::findOrFail($id);
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
        $id= $request->input('supplierId');
        $name = $request->input('supplierName');
        $contact= $request->input('supplier-contact');
        $address = $request->input('supplier-address');
        $now= date('Y-m-d H:i:s');
         DB::table('suppliers')
        ->where('id', $id)
        ->update([
            'name' => $name,
            'contact' => $contact,
            'address' => $address,
            'updated_at' => $now,
          
        ]);

        return redirect()->back()->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $request = supplier::find($id);
        $request->delete();
       return redirect()->back();
    }
}
