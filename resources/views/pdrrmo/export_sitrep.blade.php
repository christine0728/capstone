<!-- Access properties directly since $sitrep is a single instance, not a collection -->
<button  style="text-decoration: none; padding: 10px 15px; font-size: 16px; background-color: #3498db; color: #fff; border-radius: 4px; display: inline-block; margin-top: 20px;" onclick="Export2Word('exportContent', 'word-content.docx');">Export as .docx</button>

</center><center>
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


</center>

<div id="exportContent" class="exportContent" style="padding: 120px; margin: 50px">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    li, .ldrrmo{
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
  

    <center>
      Republic of the Phillipines<br>
      Province of Pangasinan<br>
      <h5><b>Municipality of {{$sitrep->userName}}</b></h5>
      <h6><b>DISASTER RISK REDUCTION  AND MANAGEMENT</b></h6>
    </center>
  
  </header>
<hr class="solid"> 

<div class="container weighed">
Memorandum for the PDRRMO<br>
<br>

    <div class="label">ATTN:
    {{ $sitrep->attn }} <br>



  SUBJECT:
    {{ $sitrep->subject }} <br>
FROM:
    {{ $sitrep->from }} <br>
DATE:
    {{$currentDateAtNoon}}


<hr class="solid">
</div>
<div class="container">
<form action="" method="POST">
    <div style="background-color:#83f28f">
    <label class="form-label" ><b>I. Situational Summary</b></label>
    </div>
 
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label"><b>A. General Weather Condition<b></label>
    </div>
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

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">B. Dam Situtation</label>
    </div>
    @if ($sitrep->dam->dam && !in_array(strtolower($sitrep->dam->dam), ['none', 'no']))
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
@else
   <li>None reported</li>
@endif


    <br>
    <div style="background-color:#83f28f">
    <label class="form-label" ><b>I. Effects</b></label>
    </div>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">A. Related Incident</label>
    </div>
    <li>{{ $sitrep->related_incident ?? 'None reported' }}</li>


    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">B. Affected Population</label>
    <br>
    </div>
    <li>A total of {{ $sitrep->affected_population }} families affected have been reported</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">C. Casualties</label>
    <br> 
    </div>
    <li>{{ $sitrep->casualties ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">D. Status of Lifelines</label>
    </div>

    <div style="background-color:#f2c894;">
    <label class="form-label">A. Roads and Bridges</label>
    </div>
    <li> A total of {{ $sitrep->road_bridges->road_not_passable_all_type ?: '0' }} baranggay road not passable to all type of vehicles.</li>
    <li>A total of  {{ $sitrep->road_bridges->road_passable_all_light ?: '0' }} baranggay road passable to all light vehicles.</li>
    <li>A total of {{ $sitrep->road_bridges->road_passable_all_type ?: '0' }} baranggay road passable to all type of vehicles.</li>
    <li>A total of {{ $sitrep->road_bridges->bridge_not_passable_all_type ?: '0' }} Bridge Not Passable to all type of vehicles.</li>
    <li> A total of {{ $sitrep->road_bridges->bridge_passable_all_light ?: '0' }} Bridge Passable to all light vehicles.</li>

    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">B. Power</label>
  
    </div>
    <li>{{ $sitrep->power ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">C. Water</label>
    </strong> </p>
    </div>
    <li>{{ $sitrep->water ? 'A total of ' . $sitrep->water . ' water interrupted reported' : 'None reported' }}</li>

    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">D. Communication Lines</label>
       </div>
       <li>{{ $sitrep->communication_lines ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">E. Status of Ports</label>
 
    </div>
    <div style="background-color:#f2c894;">
    <label class="form-label">A. Status of Airports</label>
     </div>
     <li>{{ $sitrep->status_of_airports ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">B. Status of Flights</label>
       </div>
       <li>{{ $sitrep->status_of_flights ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">C. Status of Seaports</label>
    </div>
    <li>{{ $sitrep->status_of_seaports ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">D. Stranded Passengers, Rolling Cargoes, Vessels, Motorbancas</label>
    </div>
    <li>{{ $sitrep->stranded_passengers ?? 'None reported' }}</li>   <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">F. Damaged Houses</label>
    </div>
    <li>A total of {{$sitrep->partial_damaged_house ?? 0}} houses was partially damaged.</li>

    </li>
    <li>A total of {{$sitrep->total_damaged_house ?? 0}} houses was totally damaged.</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label"> G. Cost of Damages</label>
    </div>
    <div style="background-color:#f2c894;">
    <label class="form-label">A. Damage to Agriculture </label>
    </div>
    <li>A total of {{ $sitrep->damage_to_agriculture ?? 0}} worth of damage to agriculture was incurred.</li>
    <li>A total of {{ $sitrep->damage_to_agriculture?? 0}}  worth of damage to livestock was incurred.</li>

     <br>
    <div style="background-color:#f2c894;">
    <label class="form-label">B. Damage to infrastructure </label>
    </div>
    <li>{{ $sitrep->damage_to_infrastructure ? 'A total of '.$sitrep->damage_to_infrastructure. ' worth damage to infrastructure was incurred.' : 'None reported' }}</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">H. Class Suspension</label>
    </div>
    <li>{{ $sitrep->class_suspension ? 'Declared class suspension' : 'None reported' }}
</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">I. Work Suspension</label>
    </div>
    <li>{{ $sitrep->work_suspension ? 'Declared work suspension.' : 'None reported' }}
</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">J. State of Calamity</label>
    </div>
    <li>{{ $sitrep->state_of_calamity ? 'Declared state of calamity.' : 'None reported' }}
</li>
    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">K. Pre-emtive evacuation</label>
    </div>
    <li>{{ $sitrep->preemptive_evacuation ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">L. Pre-emtive evacuation animals</label>
    </div>
    <li>{{ $sitrep->preemptive_evacuation_animals ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#9dd9f3;">
    <label class="form-label">M. Assistance Provided</label>
    </div>
    <li>{{ $sitrep->assistance_provided ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#83f28f">
    <label class="form-label">III. Disaster Preparedness</label>
    </div>
    <br>
    <b>MDRRMO</b>
        @if ($sitrep->disaster_preparedness)
            <ul id="preparednessList">
                @foreach (explode("\n", $sitrep->disaster_preparedness) as $line)
                    <li>{!! $line !!}</li>
                @endforeach
            </ul>
        @else
            None reported
        @endif

    <div style="background-color:#83f28f;">
    <label class="form-label">IV. Disaster Reponse</label>
    </div>

    <div style="background-color:#ffa8b5;">
    <label class="form-label">A. Food and Non-food items(F/NFis)</label>
    </div>
    <li>{{ $sitrep->food_and_non_foods ?? 'None reported'}}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">B. Protection camp Coordination and Management(PCCM)</label>
    </div>
    <li>{{ $sitrep->pccm ?? 'None reported'}}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">C. Health(Wash, Medical, Nutritioan, and Medical Health Psychosocial)</label>
    </div>
    <li>{{ $sitrep->health ?? 'None reported' }}</li>

    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">D. Searh and Rescue Retrieval</label>
    </div>
    <li>{{ $sitrep->search_rescue_retrieval ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">E. Logistics</label>
    </div>
    <li>{{ $sitrep->logistics ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#D8D9D4">
        <b>Response Assets Deployed</b>
    </div>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">F. Emergency Telecommunication</label>
    </div>
    <li>{{ $sitrep->emergency_telecommunications ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">G. Education</label>
    </div>
    <li>{{ $sitrep->education ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">H. Clearing Operations</label>
    </div>
    <li>{{ $sitrep->clearing_operations ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">I. Damage Assesment Analysis</label>
    </div>
    <li>{{ $sitrep->damage_assessment_needs_analysis ?? 'None reported' }}</li>
    <br>
    <div style="background-color:#ffa8b5;">
    <label class="form-label">J. Law and Order</label>
    </div>
    <li>{{ $sitrep->law_order ?? 'None reported' }}</li>
</form>
</div>
<div class="container weighed">
<hr class="solid">
<a href="{{ route('download-pic', ['filename' => $sitrep->preview_prepared]) }}" target="_blank"> 
    <img src="{{ asset('uploads/signature/' . $sitrep->preview_prepared) }}" width="60px" height="56px" style="margin-left: 130px">
</a><br>
Prepared by: {{ $sitrep->sitrepDeveloperFirstName}} &nbsp;{{ $sitrep->sitrepDeveloperMiddleName}}&nbsp;{{$sitrep->sitrepDeveloperLastName}} <br>
<br><br>


For and by Authority of the Municipal Mayor/MDRRMC Chairperson
<br>
<a href="{{ route('download-pic', ['filename' => $sitrep->preview_ldrrmo]) }}" target="_blank"> 
    <img src="{{ asset('uploads/signature/' . $sitrep->preview_ldrrmo) }}" width="60px" height="56px" style="margin-left: 30px">
</a><br>
<span class="ldrrmo">{{$sitrep->ldrrmoFirstName}}&nbsp; {{$sitrep->ldrrmoMiddleName}}&nbsp;{{$sitrep->ldrrmoLastName}}</span>

<br><span>LDRRMO Officer</span>
<br>


<br>
<br>





<br>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
</div><script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the preparednessList element
        var preparednessList = document.getElementById('preparednessList');

        // Clear existing content
        preparednessList.innerHTML = '';

        // Split the content by newline and add bullets
        var contentArray = {!! json_encode(explode("\n", $sitrep->disaster_preparedness)) !!};
        contentArray.forEach(function (line) {
            var listItem = document.createElement('li');
            listItem.innerHTML = line;
            preparednessList.appendChild(listItem);
        });
    });
</script>