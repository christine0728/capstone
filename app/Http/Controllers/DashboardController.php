<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\assistance_request;
use App\Models\User;
use App\Models\event;
use App\Models\Personnel;
use App\Models\incidents;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
            $incidentData = DB::table('incidents')
            ->leftJoin('assistance_requests', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->select('incidents.name', DB::raw('COUNT(assistance_requests.id) as count'))
            ->where('assistance_requests.userId', $currentUserId)
            ->groupBy('incidents.name')
            ->get();
            $incidentNames = $incidentData->pluck('name')->toArray();
            $incidentCounts = $incidentData->pluck('count')->toArray();

            $incidentDatapdrrmo = DB::table('incidents')
            ->leftJoin('assistance_requests', 'incidents.id', '=', 'assistance_requests.incidentId')
            ->select('incidents.name', DB::raw('COUNT(assistance_requests.id) as count'))
            ->where('assistance_requests.ownerId', $currentUserId)
            ->groupBy('incidents.name')
            ->get();
            $incidentNamespdrrmo = $incidentDatapdrrmo->pluck('name')->toArray();
            $incidentCountspdrrmo = $incidentDatapdrrmo->pluck('count')->toArray();
            $totalPopulation = User::where('id', '=', $currentUserId)
            ->value('population');

            $totalPopulationpdrrmo = User::sum('population');


            $locationData = DB::table('assistance_requests')
                ->select('location', DB::raw('COUNT(*) as count'))
                ->where('userId', $currentUserId)
                ->groupBy('location')
                ->orderBy('count', 'desc')
                ->limit(10) // You can adjust the number of results to display
                ->get();

            $locationNames = $locationData->pluck('location')->toArray();
            $locationCounts = $locationData->pluck('count')->toArray();

            $userDatapdrrmo = DB::table('users')
                ->leftJoin('assistance_requests', 'users.id', '=', 'assistance_requests.userId')
                ->select('users.name', DB::raw('COUNT(assistance_requests.userId) as count'))
                ->where('userId', '!=', $currentUserId)
                ->where('assistance_requests.ownerId', $currentUserId)
                ->groupBy('users.name')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get();

            $userNamespdrrmo = $userDatapdrrmo->pluck('name')->toArray();
            $userCountspdrrmo = $userDatapdrrmo->pluck('count')->toArray();


            $totalPersonnel = Personnel::where('userid', '=', $currentUserId)->count();
            $allusers = User::where('id', '!=', $currentUserId)->count();

               if($usertype=='mdrrmo'){
                $accepted_recieved =assistance_request::where('ownerId', $currentUserId)
                ->where('req_status', 'Accepted')->count();
                $pending_recieved = assistance_request::where('req_status', 'Pending')
                                ->where('ownerId', $currentUserId)
                                ->count();
                $declined_recieved = assistance_request::where('ownerId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
                $allrecieved = assistance_request::where('ownerId', $currentUserId)->count();
                $pending_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Pending')
                                ->count();
                $accepted_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Accepted')->count();
                $declined_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
                $pending_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Pending')
                                ->count();
                $accepted_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Accepted')->count();
                $declined_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
               
                $allcount = assistance_request::where('userId', $currentUserId)->count();
                               
                return view('mdrrmo.dashboard', [ 'allcount'=>$allcount, 'accepted_count'=>$accepted_count, 'declined_count'=>$declined_count, 'pending_count' => $pending_count,'totalRecieved'=> $allrecieved,'pending_recieved'=>$pending_recieved, 'accepted_recieved'=>$accepted_recieved, 'declined_recieved'=>$declined_recieved, 'persons' => $persons, 'totalPopulation' => $totalPopulation,
            'totalPersonnel' => $totalPersonnel, 'incidents.index','incidentNames' => $incidentNames,
            'incidentCounts' => $incidentCounts, 'locationNames' => $locationNames,
    'locationCounts' => $locationCounts, 'allusers' => $allusers] );
            }
            else if($usertype=='pdrrmo'){
                $accepted_recieved =assistance_request::where('ownerId', $currentUserId)
                ->where('req_status', 'Accepted')->count();
                $pending_recieved = assistance_request::where('req_status', 'Pending')
                                ->where('ownerId', $currentUserId)
                                ->count();
                $declined_recieved = assistance_request::where('ownerId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
              
                $allrecieved = assistance_request::where('ownerId', $currentUserId)->count();
                $pending_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Pending')
                                ->count();
                $accepted_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Accepted')->count();
                $declined_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
                $pending_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Pending')
                                ->count();
                $accepted_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Accepted')->count();
                $declined_count = assistance_request::where('userId', $currentUserId)
                                ->where('req_status', 'Declined')->count();
               
                $allcount = assistance_request::where('userId', $currentUserId)->count();
                $currentTime = now(); // replace with the current time

                $futureEventsCount = event::where('userid', $currentUserId)
                    ->where('start', '>', $currentTime)
                    ->count();
                return view('pdrrmo.dashboard', [ 'allcount'=>$allcount, 'accepted_count'=>$accepted_count, 'declined_count'=>$declined_count, 'pending_count' => $pending_count,'totalRecieved'=> $allrecieved,'pending_recieved'=>$pending_recieved, 'accepted_recieved'=>$accepted_recieved, 'declined_recieved'=>$declined_recieved, 'persons' => $persons, 'totalPopulation' => $totalPopulationpdrrmo,
            'totalPersonnel' => $totalPersonnel, 'incidents.index','incidentNames' => $incidentNamespdrrmo,
            'incidentCounts' => $incidentCountspdrrmo, 'locationNames' => $userNamespdrrmo,
    'locationCounts' => $userCountspdrrmo, 'allusers' => $allusers, 'sched'=>$futureEventsCount] );
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
    }

}
