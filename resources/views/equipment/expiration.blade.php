{{--todo--}}

<br>
Maintenance Reminder: <br>
<hr>
Property: {{$property->title}} <br>
Next maintenance day: {{$equipment->nextMaintenanceDate->toDayDateTimeString()}} <br>
ExpiredDate : {{$equipment->expireDate->toDayDateTimeString()}} <br>
Name: {{$equipment->name}} <br>
Description: {{$equipment->description}} <br>
Model No.: {{$equipment->modelNumber}} <br>
Required Service: {{$equipment->requiredService}} <br>

<hr>
