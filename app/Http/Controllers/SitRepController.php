<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sitrep;
use App\Models\dam;
use App\Models\Subject;
use App\Models\personnel;
use Carbon\Carbon;
use App\Models\road_bridges;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SitrepNotification;
use App\Models\User;
class SitRepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check())
        {
            $currentUserId = Auth::id();
            $usertype=Auth()->user()->usertype;
            $username=Auth()->user()->name;
            $persons = User::where('id', '!=', $currentUserId)->get();
            $personnel = Personnel::where('userid', $currentUserId)
            ->select('*', DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name, suffix) as fullname"))
            ->orderBy('fullname', 'asc')
            ->get();
        
            $currentUserId = Auth::id();

            $subject = Subject::whereNotExists(function ($query) use ($currentUserId) {
                $query->select(DB::raw(1))
                      ->from('sitreps')
                      ->whereRaw('sitreps.subjectId = subjects.id')
                      ->where('sitreps.userId', $currentUserId);
            })
            ->get();
            
            if ($usertype == 'mdrrmo') {
              
            $usedSubjectIds = sitrep::where('userId', $currentUserId)->pluck('subjectId')->toArray();
            
            // Load subjects excluding those that have been used
            $sitreps = DB::table('sitreps')
            ->join('users', 'sitreps.userId', '=', 'users.id')
            ->join('subjects', 'sitreps.subjectId', '=', 'subjects.id')
            ->leftJoin('personnels', 'sitreps.sitrepDeveloperId', '=', 'personnels.id')
            ->where('sitreps.userId', '=', $currentUserId)
            ->select(
                'sitreps.*',
                'users.name as municipality',
                'subjects.subject as subject_name',
                'subjects.finalized_at',
                'personnels.first_name as sitrepDeveloperFirstName',
              
            )
            ->get();


    
                    return view('mdrrmo.sitrep', ['personnels'=>$personnel,'username' => $username,'sitreps' => $sitreps, 'subjects'=>$subject, 'persons' => $persons]);
      
            } else if($usertype=='pdrrmo'){
                $sitreps = DB::table('sitreps')
                ->join('users', 'sitreps.userId', '=', 'users.id')
                ->join('subjects', 'sitreps.subjectId', '=', 'subjects.id')
                ->select(
                    'sitreps.*', // Select all columns from the inventories table
                    'users.name as municipality',
                    'subjects.subject as subject_name'
                )->get();

                return view('pdrrmo.sitrep',  ['notificationId'=> null,'sitreps' => $sitreps, 'persons' => $persons]);        
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
    public function update(Request $request)
    {
        $id= $request->input('id');
        $report = sitrep::find($id);
 

        $report->attn = $request->input('editattn');
        $report->from = $request->input('editfrom');
        $report->province = $request->input('editprovince');
        $report->subject = $request->input('editsubject');
        $report->general_weather_condition = $request->input('editgeneral_weather_condition');
        $report->tcws = $request->input('edittcws');
        $report->dam_situation = $request->input('editdam_situation');
        $report->related_incident = $request->input('editrelated_incident');
        $report->affected_population = $request->input('editaffected_population');
        $report->casualties = $request->input('editcasualties');
        $report->roads_and_bridges = $request->input('editroads_and_bridges');
        $report->power = $request->input('editpower');
        $report->water = $request->input('editwater');
        $report->communication_lines = $request->input('editcommunication_lines');
        $report->status_of_airports = $request->input('editstatus_of_airports');
        $report->status_of_flights = $request->input('editstatus_of_flights');
        $report->status_of_seaports = $request->input('editstatus_of_seaports');
        $report->stranded_passengers = $request->input('editstranded_passengers');
        $report->damaged_house = $request->input('editdamaged_house');
        $report->damage_to_agriculture = $request->input('editdamage_to_agriculture');
        $report->damage_to_infrastructure = $request->input('editdamage_to_infrastructure');
        $report->class_suspension = $request->input('editclass_suspension');
        $report->work_suspension = $request->input('editwork_suspension');
        $report->state_of_calamity = $request->input('editstate_of_calamity');
        $report->preemptive_evacuation = $request->input('editpreemptive_evacuation');
        $report->preemptive_evacuation_animals = $request->input('editpreemptive_evacuation_animals');
        $report->assistance_provided = $request->input('editassistance_provided');
        $report->disaster_preparedness = $request->input('editdisaster_preparedness');
        $report->food_and_non_food = $request->input('editfood_and_non_food');
        $report->pccm = $request->input('editpccm');
        $report->health = $request->input('edithealth');
        $report->search_rescue_retrieval = $request->input('editsearch_rescue_retrieval');
        $report->logistics = $request->input('editlogistics');
        $report->emergency_telecommunications = $request->input('editemergency_telecommunications');
        $report->education = $request->input('editeducation');
        $report->clearing_operations = $request->input('editclearing_operations');
        $report->damage_assessment_needs_analysis = $request->input('editdamage_assessment_needs_analysis');
        $report->law_order = $request->input('editlaw_order');

    
           
        $report->update();
        return redirect()->back()->with('updatemessage', 'Report updated successfully!');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
 
        $userId=Auth()->user()->id;
        $report = new sitrep; // Replace YourModel with your actual model name
        $file = $request->file('image-prepared');
        $original = $file->getClientOriginalName();
        $extenstions = $file->getClientOriginalExtension();
        $uniq = \Ramsey\Uuid\Uuid::uuid4();
        $filenamepre = time() . '_' . $uniq . '_' . pathinfo( $original, PATHINFO_FILENAME) . '_' . date('Ymd') . '.' . $extenstions;
  
        $file->move('uploads/signature/', $filenamepre);

        $fileldrrmo = $request->file('image-ldrrmo');
        $originalName = $fileldrrmo->getClientOriginalName();
        $extension = $fileldrrmo->getClientOriginalExtension();
        $uuid = \Ramsey\Uuid\Uuid::uuid4();
        $filenameldrrmo = time() . '_' . $uuid . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '_' . date('Ymd') . '.' . $extension;
        $fileldrrmo->move('uploads/signature/', $filenameldrrmo);

        $attn=$request->attn;
        $subject= $request->subject;
        $from=$request->from;
        $province=$request->province;
        $general_weather_condition= $request->general_weather_condition;
        $tcws = $request->tcws ?? 'none';
        $power= $request->power;
        $water =$request->water;
        $communication_lines=$request->communication_lines;

        $status_of_airports = $request->input('status_of_airports');
        $status_of_flights = $request->input('status_of_flights');
        $status_of_seaports = $request->input('status_of_seaports');
        $stranded_passengers = $request->input('stranded_passengers');
        $partial_damaged_house = $request->input('partial_damaged_house');
        $total_damaged_house = $request->input('total_damaged_house');
        $damage_to_agriculture = $request->input('damage_to_agriculture');
        $damage_to_infrastructure = $request->input('damage_to_infrastructure');
        $class_suspension = $request->input('class_suspension');
        $work_suspension = $request->input('work_suspension');
        $state_of_calamity = $request->input('state_of_calamity');
        $preemptive_evacuation = $request->input('preemptive_evacuation');
        $preemptive_evacuation_animals = $request->input('preemptive_evacuation_animals');
        $assistance_provided = $request->input('assistance_provided');
        $disaster_preparedness = $request->input('disaster_preparedness');
        $food_and_non_food = $request->input('food_and_non_food');
        $pccm = $request->input('pccm');
        $health = $request->input('health');
        $search_rescue_retrieval = $request->input('search_rescue_retrieval');
        $logistics = $request->input('logistics');
        $emergency_telecommunications = $request->input('emergency_telecommunications');
        $education = $request->input('education');
        $clearing_operations = $request->input('clearing_operations');
        $damage_assessment_needs_analysis = $request->input('damage_assessment_needs_analysis');
        $law_order = $request->input('law_order');
        
// Save data to the "dam" table
$dam = new Dam;
$dam->dam = $request->dam;
$dam->spilling_level = $request->spilling_level;
$dam->date_and_time = $request->date_and_time;
$dam->current_level = $request->current_level;
$dam->opening_of_gate= $request->opening_of_gate;
$dam->save();

// Retrieve the ID of the newly inserted dam
$damId = $dam->id;

// Save data to the "road_bridges" table
$roadBridge = new road_bridges;
$roadBridge->road_not_passable_all_type = $request->road_not_passable_all_type;
$roadBridge->road_passable_all_light = $request->road_passable_all_light;
$roadBridge->road_passable_all_type = $request->road_passable_all_type;
$roadBridge->bridge_not_passable_all_type = $request->bridge_not_passable_all_type;
$roadBridge->bridge_passable_all_light = $request->bridge_passable_all_light;
$roadBridge->save();

// Retrieve the ID of the newly inserted road bridge
$roadBridgeId = $roadBridge->id;

// Save data to the "sitreps" table
$sitrep = new Sitrep;
$sitrep->userId = $userId; // Replace $userId with the actual user ID
$sitrep->attn = $request->attn;
$sitrep->subjectId = $request->subject;
$sitrep->from = $request->from;
$sitrep->province = $request->province;
$sitrep->general_weather_condition = $request->general_weather_condition;
$sitrep->tcws = $request->tcws ?? 'none';
$sitrep->damId = $damId; // Assign the dam ID as a foreign key
$sitrep->related_incident = $request->related_incident;
$sitrep->affected_population = $request->affected_population;
$sitrep->casualties = $request->casualties;
$sitrep->roads_and_bridgesId = $roadBridgeId; // Assign the road bridge ID as a foreign key
$sitrep->power = $request->power;
$sitrep->water = $request->water;
$sitrep->communication_lines = $request->communication_lines;
// ... (previous code)

$sitrep->status_of_airports = $request->status_of_airports;
$sitrep->status_of_flights = $request->status_of_flights;
$sitrep->status_of_seaports = $request->status_of_seaports;
$sitrep->stranded_passengers = $request->stranded_passengers;
$sitrep->partial_damaged_house = $request->partial_damaged_house;
$sitrep->total_damaged_house = $request->total_damaged_house;
$sitrep->damage_to_agriculture = $request->damage_to_agriculture;
$sitrep->damage_to_livestock = $request->damage_to_livestock;
$sitrep->damage_to_infrastructure = $request->damage_to_infrastructure;
$sitrep->class_suspension = $request->class_suspension;
$sitrep->work_suspension = $request->work_suspension;
$sitrep->state_of_calamity = $request->state_of_calamity;
$sitrep->preemptive_evacuation = $request->preemptive_evacuation;
$sitrep->preemptive_evacuation_animals = $request->preemptive_evacuation_animals;
$sitrep->assistance_provided = $request->assistance_provided;
$sitrep->disaster_preparedness = $request->disaster_preparedness;
$sitrep->food_and_non_food = $request->food_and_non_food;
$sitrep->pccm = $request->pccm;
$sitrep->health = $request->health;
$sitrep->search_rescue_retrieval = $request->search_rescue_retrieval;
$sitrep->logistics = $request->logistics;
$sitrep->emergency_telecommunications = $request->emergency_telecommunications;
$sitrep->education = $request->education;
$sitrep->clearing_operations = $request->clearing_operations;
$sitrep->damage_assessment_needs_analysis = $request->damage_assessment_needs_analysis;
$sitrep->law_order = $request->law_order;

$sitrep->sitrepDeveloperId = $request->sitrepDeveloperId;
$sitrep->preview_prepared = $filenamepre;
$sitrep->ldrrmoId = $request->ldrrmoId;
$sitrep->preview_ldrrmo = $filenameldrrmo;
$now = Carbon::now();
$now->setTimezone('Asia/Manila');
$sitrep->created_at = $now;
$sitrep->updated_at = $now;
// Save the changes to the sitrep
$sitrep->save();
$currentUserName = Auth::user()->name;

        $pdrrmoUser = User::where('usertype', 'pdrrmo')->first();

       $newlyInsertedId = $report->id;
        Notification::send( $pdrrmoUser, new SitrepNotification($newlyInsertedId,'has sent a Situational Report', $currentUserName));
      
        // Redirect to a success page or return a response
        return redirect()->back()->with('addmessage', 'The report has been saved and sent.');
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
        $end_date = Carbon::parse($end_date)->endOfDay();
        $persons = User::where('id', '!=', $currentUserId)->get();
        $username=Auth()->user()->name;
        $role = Auth()->user()->usertype;
        if ($role === 'pdrrmo') {

            $sitreps = DB::table('sitreps')
            ->join('users', 'sitreps.userId', '=', 'users.id')
            ->join('subjects', 'sitreps.subjectId', '=', 'subjects.id')
            ->whereBetween('sitreps.created_at', [$start_date, $end_date])
            ->select(
                'sitreps.*',
                'users.name as municipality',
                'subjects.subject as subject_name'
            )
            ->get();

              return view('pdrrmo.sitrep', [ 'notificationId'=>'','username' => $username,'sitreps' => $sitreps, 'persons' => $persons , 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date')]);
     
        } elseif ($role === 'mdrrmo') {
            $sitreps = DB::table('sitreps')
            ->join('users', 'sitreps.userId', '=', 'users.id')
            ->select(
                'sitreps.*', // Select all columns from the inventories table
                'users.name as municipality',
                )->whereBetween('sitreps.created_at', [$start_date, $end_date])
            ->get();
         
              return view('mdrrmo.sitrep', ['notificationId'=>'','username' => $username,'sitreps' => $sitreps, 'persons' => $persons, 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date')]); }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sitrepRecords = Sitrep::select(
            'sitreps.*',
            'users.name as userName',
            'subjects.subject',
            'pd.first_name as sitrepDeveloperFirstName',
            'pd.middle_name as sitrepDeveloperMiddleName',
            'pd.last_name as sitrepDeveloperLastName',
            'ld.first_name as ldrrmoFirstName',
            'ld.last_name as ldrrmoLastName',
            'ld.middle_name as ldrrmoMiddleName'
        )
        ->join('users', 'sitreps.userId', '=', 'users.id')
        ->leftJoin('subjects', 'sitreps.subjectId', '=', 'subjects.id')
        ->leftJoin('personnels as pd', 'sitreps.sitrepDeveloperId', '=', 'pd.id')
        ->leftJoin('personnels as ld', 'sitreps.ldrrmoId', '=', 'ld.id')
        ->find($id);

// Get the current date and time with the format "F d, Y H00H"
$currentDateAtNoon = Carbon::now()->setTime(12, 0, 0)->format('F d, Y ');


// Pass the sitrep data and current date to the view
return view('mdrrmo.export_sitrep', ['sitrep' => $sitrepRecords, 'currentDateAtNoon' => $currentDateAtNoon]);
    }
    public function export(string $id)
    {
     
        $sitrepRecords = Sitrep::select(
            'sitreps.*',
            'users.name as userName',
            'subjects.subject',
            'pd.first_name as sitrepDeveloperFirstName',
            'pd.middle_name as sitrepDeveloperMiddleName',
            'pd.last_name as sitrepDeveloperLastName',
            'ld.first_name as ldrrmoFirstName',
            'ld.last_name as ldrrmoLastName',
            'ld.middle_name as ldrrmoMiddleName'
        )
        ->join('users', 'sitreps.userId', '=', 'users.id')
        ->leftJoin('subjects', 'sitreps.subjectId', '=', 'subjects.id')
        ->leftJoin('personnels as pd', 'sitreps.sitrepDeveloperId', '=', 'pd.id')
        ->leftJoin('personnels as ld', 'sitreps.ldrrmoId', '=', 'ld.id')
        ->find($id);
    
        $subjects = Subject::where('id', $id)->get();

// Get the current date and time with the format "F d, Y H00H"
$currentDateAtNoon = Carbon::now()->setTime(12, 0, 0)->format('F d, Y');


// Pass the sitrep data and current date to the view
return view('pdrrmo.export_sitrep', ['sitrep' => $sitrepRecords, 'subjects'=>$subjects, 'currentDateAtNoon' => $currentDateAtNoon]);
    }
   
    public function summary(string $id)
    {
        //
        $subjects = Subject::where('id', $id)->get();
        $sitrepRecords = Sitrep::where('subjectId', $id)
        ->join('users', 'sitreps.userId', '=', 'users.id')
        ->select('sitreps.*', 'users.name as userName')
        ->get();
        $currentDateAtNoon = Carbon::now()->setTime(12, 0, 0)->format('F d, Y');

        // Pass the sitrep data to the view
        return view('pdrrmo.sitrepsummary', ['currentDateAtNoon' => $currentDateAtNoon,'subjects'=>$subjects,'sitrepRecords' => $sitrepRecords]);
        
    }
    public function notifs($notificationId)
    {
        //

    
        $currentUserId = Auth::id();
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        // Mark the notification as read
        $notification->markAsRead();
        $subject = Subject::whereNotExists(function ($query) use ($currentUserId) {
            $query->select(DB::raw(1))
                  ->from('sitreps')
                  ->whereRaw('sitreps.subjectId = subjects.id')
                  ->where('sitreps.userId', $currentUserId);
        })
        ->get();
        
        
        $notificationDataId = $notification->data['newid'];
        $sitreps = DB::table('sitreps')
        ->join('users', 'sitreps.userId', '=', 'users.id')
        ->join('subjects', 'sitreps.subjectId', '=', 'subjects.id')
        ->leftJoin('personnels', 'sitreps.sitrepDeveloperId', '=', 'personnels.id')
        ->select(
            'sitreps.*',
            'users.name as municipality',
            'subjects.subject as subject_name',
            'subjects.finalized_at',
            'personnels.first_name as sitrepDeveloperFirstName',
          
        )
        ->get();

        return view('pdrrmo.sitrep',  ['notificationId'=> $notificationDataId,'sitreps' => $sitreps]);

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
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $request = sitrep::find($id);
        $request->delete();
       return redirect()->back();
    }
    public function convertBladeToWord(Request $request)
    {
        // Render the Blade view to get the HTML content
        $htmlContent = View::make('mdrrmo.export_sitrep')->render();

        // The rest of the code remains the same...

        // Create a DOMDocument
        $dom = new \DOMDocument();

        // Load the HTML content
        $dom->loadHTML($htmlContent);

        // ... (the rest of the code remains the same)

        // Save the Word document to storage path
        $filename = storage_path('converted_document.docx');
        $wordDom->save($filename);

        // Force download the Word document
        return response()->download($filename)->deleteFileAfterSend();
    }
}
