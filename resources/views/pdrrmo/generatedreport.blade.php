<td>{{ $sitrep->attn }}</td>
                <td>{{ $sitrep->from }}</td>
                <td>{{ $sitrep->subject }}</td>
                <td>{{ $sitrep->province }}</td>
                <td>{{ $sitrep->general_weather_condition }}</td>
                <td>{{ $sitrep->tcws }}</td>
                <td>{{ $sitrep->dam_situation }}</td>
                <td>{{ $sitrep->related_incident }}</td>
                <td>{{ $sitrep->affected_population }}</td>
                <td>{{ $sitrep->casualties }}</td>
                <td>{{ $sitrep->roads_and_bridges }}</td>
                <td>{{ $sitrep->power }}</td>
                <td>{{ $sitrep->water }}</td>
                <td>{{ $sitrep->communication_lines }}</td>
                <td>{{ $sitrep->status_of_airports }}</td>
                <td>{{ $sitrep->status_of_flights }}</td>
                <td>{{ $sitrep->status_of_seaports }}</td>
                <td>{{ $sitrep->stranded_passengers }}</td>
                <td>{{ $sitrep->damaged_house }}</td>
                <td>{{ $sitrep->damage_to_agriculture }}</td>
                <td>{{ $sitrep->damage_to_infrastructure }}</td>
                <td>{{ $sitrep->class_suspension }}</td>
                <td>{{ $sitrep->work_suspension }}</td>
                <td>{{ $sitrep->state_of_calamity }}</td>
                <td>{{ $sitrep->preemptive_evacuation }}</td>
                <td>{{ $sitrep->preemptive_evacuation_animals }}</td>
                <td>{{ $sitrep->assistance_provided }}</td>
                <td>{{ $sitrep->disaster_preparedness }}</td>
                <td>{{ $sitrep->food_and_non_food }}</td>
                <td>{{ $sitrep->pccm }}</td>
                <td>{{ $sitrep->health }}</td>
                <td>{{ $sitrep->search_rescue_retrieval }}</td>
                <td>{{ $sitrep->logistics }}</td>
                <td>{{ $sitrep->emergency_telecommunications }}</td>
                <td>{{ $sitrep->education }}</td>
                <td>{{ $sitrep->clearing_operations }}</td>
                <td>{{ $sitrep->damage_assessment_needs_analysis }}</td>
                <td>{{ $sitrep->law_order }}</td>

               <td>{{ date('F d, Y g:ia', strtotime($sitrep->created_at )) }}</td>
               <td>{{ date('F d, Y g:ia', strtotime($sitrep->updated_at)) }}</td>