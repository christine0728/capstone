<!-- Access properties directly since $sitrep is a single instance, not a collection -->
<button onclick="Export2Word('exportContent', 'word-content');">Export as .doc</button>

<div id="exportContent" class="exportContent" style="padding: 70px;">
  

MEMORANDUM FOR RDDMC
<p><strong>ATTN:</strong>  <br>{{ $sitrep->attn }}</p>
    <p><strong>Subject:</strong>  <br>{{ $sitrep->subject }}</p>
    <p><strong>From:</strong>  <br>{{ $sitrep->from }}</p>
    I. SITUATIONAL SUMMARY
<BR>
A. <strong>GENERAL WEATHER CONDITION</strong>




<!-- ... other fields ... -->
<strong>B. DAM SITUATION</strong>
<!-- Access related models -->
<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Spilling Level</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Date and Time</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Current Level</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Opening of Gate</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->spilling_level }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->date_and_time }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->current_level }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->opening_of_gate ? 'Yes' : 'No' }}</td>
        </tr>
    </tbody>
</table>

<br>
II. EFFECTS <BR>
<p><strong>A.Related Incident:</strong> <br>A total {{ $sitrep->related_incident }} incident</p>
<p><strong>B.Affected Population:</strong>  <br>A total of {{ $sitrep->affected_population }} families have been reported</p>
<p><strong>C.Casualties:</strong> <br> A total of {{ $sitrep->casualties }} reported</p>
<p><strong>D. Status of Lifelines</strong></p>
<strong>A.Roads and birdges</strong>
<p><strong>Road Not Passable (All Type):</strong> <br>{{ $sitrep->road_bridges->road_not_passable_all_type ?: 'None reported' }}</p>
<p><strong>Road Passable (All Light):</strong> <br> {{ $sitrep->road_bridges->road_passable_all_light ?: 'None reported' }}</p>
<p><strong>Road Passable (All Type):</strong> <br> {{ $sitrep->road_bridges->road_passable_all_type ?: 'None reported' }}</p>
<p><strong>Bridge Not Passable (All Type):</strong> <br> {{ $sitrep->road_bridges->bridge_not_passable_all_type ?: 'None reported' }}</p>
<p><strong>Bridge Passable (All Light):</strong> <br> {{ $sitrep->road_bridges->bridge_passable_all_light ?: 'None reported' }}</p>
<p><strong>Power:</strong>A total of  {{ $sitrep->power ?? 'None reported' }} power interupption reported </p>
<p><strong>Water:</strong> A total of {{ $sitrep->water ?? 'None reported' }} water interrupted  reported</p>
<p><strong>Communication Lines:</strong><br> A total of {{ $sitrep->communication_lines ?? 'None reported' }} communication line interruption</p>
<p><strong>Damage to Agriculture:</strong> <br>{{ $sitrep->damage_to_agriculture ?? 'None reported' }}</p>
<p><strong>Damage to Infrastructure:</strong><br> {{ $sitrep->damage_to_infrastructure ?? 'None reported' }}</p>
<p><strong>Class Suspension:</strong> <br>{{ $sitrep->class_suspension ? 'Yes' : 'None reported' }}</p>
<p><strong>Work Suspension:</strong> <br>{{ $sitrep->work_suspension ? 'Yes' : 'None reported' }}</p>
<p><strong>State of Calamity:</strong><br> {{ $sitrep->state_of_calamity ? 'Yes' : 'None reported' }}</p>
<p><strong>Preemptive Evacuation:</strong><br> {{ $sitrep->preemptive_evacuation ? 'Yes' : 'None reported' }}</p>
<p><strong>Preemptive Evacuation (Animals):</strong><br> {{ $sitrep->preemptive_evacuation_animals ? 'Yes' : 'None reported' }}</p>
<p><strong>Assistance Provided:</strong><br> {{ $sitrep->assistance_provided ? 'Yes' : 'None reported' }}</p>
<p><strong>Disaster Preparedness:</strong><br> {{ $sitrep->disaster_preparedness ?? 'None reported' }}</p>
<!-- ... other fields ... -->
<p><strong>Food and Non-Food:</strong><br> {{ $sitrep->food_and_non_food ?? 'None reported' }}</p>
<p><strong>PCCM:</strong><br> {{ $sitrep->pccm ?? 'None reported' }}</p>
<p><strong>Health:</strong><br> {{ $sitrep->health ?? 'None reported' }}</p>
<p><strong>Search, Rescue, Retrieval:</strong><br> {{ $sitrep->search_rescue_retrieval ?? 'None reported' }}</p>
<p><strong>Logistics:</strong><br> {{ $sitrep->logistics ?? 'None reported' }}</p>
<p><strong>Emergency Telecommunications:</strong><br> {{ $sitrep->emergency_telecommunications ?? 'None reported' }}</p>
<p><strong>Education:</strong><br> {{ $sitrep->education ?? 'None reported' }}</p>
<p><strong>Clearing Operations:</strong><br> {{ $sitrep->clearing_operations ?? 'None reported' }}</p>
<p><strong>Damage Assessment Needs Analysis:</strong><br> {{ $sitrep->damage_assessment_needs_analysis ?? 'None reported' }}</p>
<p><strong>Law and Order:</strong><br> {{ $sitrep->law_order ?? 'None reported' }}</p>
<!-- ... other fields ... -->

</div>
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
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
</style>
</head>
<body>
  <header>
    <div class="next-to-text">
      <img src="samplelogo.jpg" alt="mdrlogo">
    <center>
      Republic of the Phillipines<br>
      Province of Pangasinan<br>
      <h5><b>Municipality of Rosales</b></h5>
      <h6><b>DISASTER RISK REDUCTION  AND MANAGEMENT</b></h6>
    </center>
    </div>
  </header>
<hr class="solid"> 
  <br><br><br>
<div class="container weighed">
Memorandum for the PDRRMO<br>
<br>
ATTN:<br>{{ $sitrep->attn }} <br>
FFROM:<br>{{ $sitrep->subject }}<br>
SUBJECT: <br>{{ $sitrep->from }}<br>
DATE:<br>
<hr class="solid">
</div>
<div class="container">
<form action="" method="POST">
    <div style="background-color:#B8BF92;">
    <label class="form-label" ><b>I. Situational Summary</b></label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
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
    <div style="background-color:#A9B8B3;">
    <label class="form-label">B. Dam Situtation</label>
    
<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Spilling Level</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Date and Time</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Current Level</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Opening of Gate</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->spilling_level }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->date_and_time }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->current_level }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $sitrep->dam->opening_of_gate ? 'Yes' : 'No' }}</td>
        </tr>
    </tbody>
</table>
    </div>
    <li></li>
    <br>
    <div style="background-color:#B8BF92;">
    <label class="form-label" ><b>I. Effects</b></label>
    </div>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">A. Related Incident</label>
    <br>A total {{ $sitrep->related_incident }} incident</p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">B. Affected Population</label>
    <br>A total of {{ $sitrep->affected_population }} families have been reported</p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">C. Casualties</label>
    <br> A total of {{ $sitrep->casualties }} reported
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">D. Status of Lifelines</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">A. Roads and Bridges</label>
    <p><strong>Road Not Passable (All Type):</strong> <br>{{ $sitrep->road_bridges->road_not_passable_all_type ?: 'None reported' }}</p>
<p><strong>Road Passable (All Light):</strong> <br> {{ $sitrep->road_bridges->road_passable_all_light ?: 'None reported' }}</p>
<p><strong>Road Passable (All Type):</strong> <br> {{ $sitrep->road_bridges->road_passable_all_type ?: 'None reported' }}</p>
<p><strong>Bridge Not Passable (All Type):</strong> <br> {{ $sitrep->road_bridges->bridge_not_passable_all_type ?: 'None reported' }}</p>
<p><strong>Bridge Passable (All Light):</strong> <br> {{ $sitrep->road_bridges->bridge_passable_all_light ?: 'None reported' }}</p>

    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">B. Power</label>
    A total of  {{ $sitrep->power ?? 'None reported' }} power interupption reported </p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">C. Water</label>
    </strong> A total of {{ $sitrep->water ?? 'None reported' }} water interrupted  reported</p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">D. Communication Lines</label>
    <br> A total of {{ $sitrep->communication_lines ?? 'None reported' }} communication line interruption</p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">E. Status of Ports</label>
 
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">A. Status of Airports</label>
    A total of  {{ $sitrep->status_of_airports ?? 'None reported' }} power interupption reported </p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">B. Status of Flights</label>
    A total of  {{ $sitrep->status_of_flights ?? 'None reported' }} power interupption reported </p>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">C. Status of Seaports</label>
   
    A total of  {{ $sitrep->status_of_seaports ?? 'None reported' }} power interupption reported </p>

    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">D. Stranded Passengers, Rolling Cargoes, Vessels, Motorbancas</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">F. Damaged Houses</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label"> G. Cost of Damages</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">A. Damage to Agriculture </label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#BCAA9C;">
    <label class="form-label">B. Damage to infrastructure </label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">H. Class Suspension</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">I. Work Suspension</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">J. State of Calamity</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">K. Pre-emtive evacuation</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">L. Pre-emtive evacuation animals</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">M. Assistance Provided</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#B8BF92;">
    <label class="form-label">III. Disaster Preparedness</label>
    </div>
    <br>
    <b>MDRRMO</b>
    <ul>
        <li></li>
    </ul>
    <div style="background-color:#A9B8B3;">
    <label class="form-label">IV. Disaster Reponse</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">A. Food and Non-food items(F/NFis)</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">B. Protection camp Coordination and Management(PCCM)</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">C. Health(Wash, Medical, Nutritioan, and Medical Health Psychosocial)</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">D. Searh and Rescue Retrieval</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">E. Logistics</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#D8D9D4">
        <b>Response Assets Deployed</b>
    </div>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">F. Emergency Telecommunication</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">G. Education</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">H. Clearing Operations</label>
    </div>
    <li></li>>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">I. Damage Assesment Analysis</label>
    </div>
    <li></li>
    <br>
    <div style="background-color:#CFB6B4;">
    <label class="form-label">J. Law and Order</label>
    </div>
    <li></li>
</form>
</div>
<div class="container weighed">
<hr class="solid">
Prepared by:<br>
<br>

<br>





<br>

For and by Authority of the Municipal Mayor/MDRRMC Chairperson
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