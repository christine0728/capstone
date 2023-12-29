&nbsp;<a href="/pdrrmo/sitrepsub" style="text-decoration: none; padding: 10px 15px; font-size: 16px; background-color: #3498db; color: #fff; border-radius: 4px; display: inline-block; margin-top: 20px;">Back</a>
 <button onclick="Export2Word('exportContent', 'word-content.docx');" style="padding: 10px 15px; font-size: 16px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px;">Export as .docx</button>
<br>   

<div id="exportContent" class="exportContent" style="padding: 70px;">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
     li{
        font-weight: normal;
    }
    
    .pad{
        padding: 100px;
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
}
hr.solid {
  border-top: 3px solid black;
}
.weighed {
  font-weight: bold;
}
li {
  text-indent: 50px;
}
.next-to-text {
 display: grid;
 align-items: center; 
 grid-template-columns: 1fr 1fr 1fr;
 column-gap: 5px;
}
.report-line {
        display: flex;
        align-items: baseline;
         /* Adjust the margin value as needed */
    }

    .label {
        min-width: 80px; /* Adjust the min-width value as needed */
    }
</style>
</head>
<body>
  <header>
  </header>
<hr class="solid"> 
<center>Republic of the Philippines
<strong><br> PROVINCE OF PANGASINAN</strong>
<strong><br> PROVINCIAL DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</strong></center>


  <br><br><br>
<div class="container weighed">
Memorandum for the RPDRRMO<br>
<br>

    @foreach ($subjects as $subject)
    
 ATTN:
   &nbsp; &nbsp; {{ $subject->attn }}<br>

   FROM: &nbsp; &nbsp;
    {{ $subject->from }}<br>


SUBJECT: &nbsp; &nbsp;
    {{$subject->subject }}<br>

DATE:  &nbsp; &nbsp;
    {{$currentDateAtNoon}}

@endforeach
<hr class="solid">
</div>
<div class="container">
<form action="" method="POST">
    <div style="background-color:#83f28f;">
    <label class="form-label" ><b>I. Situational Summary</b></label>
    </div>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label"><b>A. General Weather Condition<b></label>
    </div>
 
@foreach ($sitrepRecords as $sitrep)
{{$sitrep->userName}}
<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Province</th>
            <th style="border: 1px solid #ddd; padding: 8px;">General Weather Condition</th>
            <th style="border: 1px solid #ddd; padding: 8px;">TCWS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->province }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->general_weather_condition }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->tcws }}</td>
        </tr>
    </tbody>
</table>


@endforeach
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">B. Dam Situtation</label>
    </div>
    @php
    $foundValidRecord = 0;
@endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->dam->dam && !in_array(strtolower($sitrep->dam->dam), ['none', 'no', 'none reported']))
        @php
            $foundValidRecord++;
        @endphp

        <br>
        {{ $sitrep->userName }}
        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px;">Dam</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Spilling Level</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Date and Time</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Current Level</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Opening of Gate</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->dam }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->spilling_level }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->date_and_time }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->current_level }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->opening_of_gate ? 'Yes' : 'No' }}</td>
                </tr>
            </tbody>
        </table>
    @endif
@endforeach

@if ($foundValidRecord === 0)
    <br>
   <li> None reported</li>
@endif


    <br>
    <div style="background-color:#83f28f;">
    <label class="form-label" ><b>II. Effects</b></label>
    </div>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">A. Related Incident</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->related_incident)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->related_incident }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">B. Affected Population</label>
    </div>
    <li>@php
    $totalAffectedPopulation = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalAffectedPopulation += $sitrep->affected_population; // Increment the variable within the loop
    @endphp
@endforeach
A total of {{ $totalAffectedPopulation }} families have been reported to be affected.</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">C. Casualties</label>
    </div>

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">D. Status of Lifelines</label>
    </div>
    <div style="background-color:#f2c894;">
    <label class="form-label">A. Roads and Bridges</label>
    </div>
    <li>@php
    $totalRoadNotPassableAllType = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalRoadNotPassableAllType += $sitrep->road_bridges->road_not_passable_all_type;
    @endphp
@endforeach

A Total of{{ $totalRoadNotPassableAllType ?: '0' }} baranggay Road Not Passable to all types of vehicles. </li>
<li>@php
    $totalRoadPassableAllLight = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalRoadPassableAllLight += $sitrep->road_bridges->road_passable_all_light;
    @endphp
@endforeach
A Total of {{ $totalRoadPassableAllLight ?: '0' }} Baranggay Road is passable to all Light vehicles.
</li>
<li>@php
    $totalRoadPassableAllType = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalRoadPassableAllType += $sitrep->road_bridges->road_passable_all_type;
    @endphp
@endforeach

A total of  {{ $totalRoadPassableAllType ?: '0' }} Baranggay Road is Passable to all type of vehicles. </li>
    <li>@php
    $totalBridgeNotPassableAllType = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalBridgeNotPassableAllType += $sitrep->road_bridges->bridge_not_passable_all_type;
    @endphp
@endforeach
A total of {{ $totalBridgeNotPassableAllType ?: '0' }} Bridge not passable to all type of vehicles.
</li>
<li>@php
    $totalBridgePassableAllLight = 0; // Initialize the variable outside the loop
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalBridgePassableAllLight += $sitrep->road_bridges->bridge_passable_all_light;
    @endphp
@endforeach
A total of {{ $totalBridgePassableAllLight ?: '0' }} Bridge is passable to all light vehicles. 
</li>
<br>

    <div style="background-color:#f2c894;">
    <label class="form-label">B. Power</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->power)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->power }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">C. Water</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->water)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->water }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">D. Communication Lines</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->communication_lines)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->communication_lines}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">E. Status of Ports</label>
    </div>

    <div style="background-color:#f2c894;">
    <label class="form-label">A. Status of Airports</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->status_of_airports)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->status_of_airports}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">B. Status of Flights</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->status_of_flights)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->status_of_flights}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">C. Status of Seaports</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->status_of_seaports)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->status_of_seaports}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">D. Stranded Passengers, Rolling Cargoes, Vessels, Motorbancas</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->stranded_passengers)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->stranded_passengers}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    @php
    $totalPartialDamagedHouse = 0;
    $totalTotalDamagedHouse = 0;
    $totalDamageToAgriculture = 0;
    $totalDamageToLivestock = 0;
    $totalDamageToInfrastructure = 0;
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalPartialDamagedHouse += $sitrep->partial_damaged_house ?? 0;
        $totalTotalDamagedHouse+= $sitrep->total_damaged_house ?? 0;
        $totalDamageToAgriculture += $sitrep->damage_to_agriculture ?? 0;
        $totalDamageToLivestock += $sitrep->damage_to_livestock ?? 0;
        $totalDamageToInfrastructure += $sitrep->damage_to_infrastructure ?? 0;
    @endphp
@endforeach

    <div style="background-color:#9dd9f3;">
    <label class="form-label">F. Damaged Houses</label>
    </div>
    <li>A total of {{ $totalPartialDamagedHouse ?? 0 }} houses was partially damaged</li>
    <li>A total of {{$totalTotalDamagedHouse ?? 0}} houses was totally damaged</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label"> G. Cost of Damages</label>
    </div>

    <div style="background-color:#f2c894;">
    <label class="form-label">A. Damage to Agriculture </label>
    </div>
    <li>A total of {{$totalTotalDamagedHouse ?? 0}} worth damage to agriculture was incurred in the Province of Pangasinan

</li>
<li>A total of {{$totalDamageToLivestock ?? 0}} worth damage to livestock was incurred in the Province of Pangasinan
    
    </li>
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">B. Damage to infrastructure </label>
    </div>
    <li>A total of {{ $totalDamageToInfrastructure ?? 0}} worth damage to infrastructure was incurred in the Province of Pangasinan
    
    </li>
    <br>
    @php
    $totalClassSuspension = $totalWorkSuspension = $totalcalamity = $totalPreemptiveEvacuation = $totalPreemptiveEvacuationAnimals = $totalAssistanceProvided = 0;
@endphp

@foreach ($sitrepRecords as $sitrep)
    @php
        $totalClassSuspension += $sitrep->class_suspension ? 1 : 0;
        $totalWorkSuspension += $sitrep->work_suspension ? 1 : 0;
        $totalcalamity += $sitrep->state_of_calamity ?1:0;
      
    @endphp
@endforeach

    <div style="background-color:#9dd9f3;">
    <label class="form-label">H. Class Suspension</label>
    </div>
    <li>A Total of {{ $totalClassSuspension ?? 0 }} municipality declared Class Suspension.</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">I. Work Suspension</label>
    </div>
    <li>A Total of  {{ $totalWorkSuspension ?? 0 }} municipalities who declared a work suspension.</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">J. State of Calamity</label>
    </div>
    <li>There is a total of {{$totalcalamity ?? 0}} municipalities who declared state of calamity. </li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">K. Pre-emtive evacuation</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->preemptive_evacuation)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->preemptive_evacuation}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">L. Pre-emtive evacuation animals</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->preemptive_evacuation_animals)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->preemptive_evacuation_animals}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">M. Assistance Provided</label>
    </div>
    @php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->assistance_provided)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{$sitrep->assistance_provided}}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif
    <br>
    <div style="background-color:#83f28f;">
    <label class="form-label">III. Disaster Preparedness</label>
    </div>
    <br>
    @foreach ($subjects as $subject)
    @if ($subject->disaster_preparedness !== null)
        <b>PDRRMO</b> <li>{{ $subject->disaster_preparedness }}</li><br>
    @endif
@endforeach

    <b>MDRRMO</b>
    <ul>
    @php
    $foundValidRecord = false;
@endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->disaster_preparedness && !in_array(strtolower($sitrep->disaster_preparedness), ['none', 'no', 'none reported']))
        {{ $sitrep->userName }}
        <li>{{ $sitrep->disaster_preparedness }}</li>
        @php
            $foundValidRecord = true;
        @endphp
    @endif
@endforeach

@if (!$foundValidRecord)
    <li> None reported</li>
@endif


    </ul>
    <div style="background-color:#83f28f;">
    <label class="form-label">IV. Disaster Reponse</label>
    </div>
    @if (!$sitrepRecords->isEmpty())
    <div style="background-color:#ffa8b5">
        <label class="form-label">A. Food and Non-food items(F/NFis)</label>
    </div>

    @foreach ($sitrepRecords as $sitrep)
        @if ($sitrep->food_and_non_food)
            {{ $sitrep->userName }}
            <li>{{ $sitrep->food_and_non_food }}</li>
        @endif
    @endforeach

    <br>
@else
<li>None reported</li>
@endif

<div style="background-color:#ffa8b5">
    <label class="form-label">B. Protection camp Coordination and Management(PCCM)</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->pccm)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->pccm }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif


    <br>
    <div style="background-color:#ffa8b5">
    <label class="form-label">C. Health(Wash, Medical, Nutrition, and Medical Health Psychosocial)</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->health)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li> {{ $sitrep->health }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif

<div style="background-color:#ffa8b5">
    <label class="form-label">D. Search and Rescue Retrieval</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->search_rescue_retrieval)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li> {{ $sitrep->search_rescue_retrieval }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif

<div style="background-color:#ffa8b5">
    <label class="form-label">E. Logistics</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->logistics)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li> {{ $sitrep->logistics }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif

<div style="background-color:#D8D9D4">
    <b>Response Assets Deployed</b>
</div>

<div style="background-color:#ffa8b5">
    <label class="form-label">F. Emergency Telecommunication</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->emergency_telecommunications)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }} 
        <li>{{ $sitrep->emergency_telecommunications }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif


    <br>
    <div style="background-color:#ffa8b5">
    <label class="form-label">G. Education</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->education)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->education }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif
<div style="background-color:#ffa8b5">
    <label class="form-label">H. Clearing Operations</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->clearing_operations)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }} 
        <li> {{ $sitrep->clearing_operations }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif


<div style="background-color:#ffa8b5">
    <label class="form-label">I. Damage Assessment Analysis</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->damage_assessment_needs_analysis)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li> {{ $sitrep->damage_assessment_needs_analysis }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
<li>None reported</li>
@endif

<div style="background-color:#ffa8b5">
    <label class="form-label">J. Law and Order</label>
</div>

@php $nonNullFound = false; @endphp

@foreach ($sitrepRecords as $sitrep)
    @if ($sitrep->law_order)
        @php $nonNullFound = true; @endphp
        {{ $sitrep->userName }}
        <li>{{ $sitrep->law_order }}</li>
    @endif
@endforeach

@if (!$nonNullFound)
    <li>None reported</li>
@endif


</form>
</div>
<div class="container weighed">
<hr class="solid">
Prepared by:<br>
@foreach ($subjects as $subject)
 {{ $subject->prepared_by }}<br>

    @endforeach

<br>





<br>

For and by Authority of the Municipal Mayor/MDRRMC Chairperson
@foreach ($subjects as $subject)

<div class="report-line">

    {{ $subject->from }} <br>
    PDRRMO Officer


@endforeach
<br>
<br>
<br>


</div>


<br>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<script>
 function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>

