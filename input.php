<?php
include 'login_check.php';
?>

<html>
<head><title>Input Values</title></head>
<body>
<h1>Input Values</h1>
<form action="Intermediate.php" method="GET">
Number of active days in week : <input type="text" name="number_of_days_in_week"/> </br></br></br>
Number of lectures a day : <input type="text" name="number_of_lectures" /> </br></br></br> 
Title of TimeTable : <input type="text" name="title_of_table"/> </br></br></br>
Check if you don't want breaks : <input type="checkbox" name="no_breaks" value="dont_want_breaks"/> </br></br></br>
Lunch break after number of lecture : <input type="text" name="lunch" /> </br></br></br>
<hr /><hr />
Start time : <br/> <br/>
<hr />
Hour : <input type="text" name="start_time_hours"/> <br/> <br/>
Minutes : <input type="text" name="start_time_minutes"/> <br/> <br/>
Seconds : <input type="text" name="start_time_seconds"/> <br/> <br/>
<hr /><hr />
Lecture Time : 
<hr />
Hour : <input type="text" name="lecture_time_hours"/> <br/> <br/>
Minutes : <input type="text" name="lecture_time_minutes"/> <br/> <br/>
Seconds : <input type="text" name="lecture_time_seconds"/> <br/> <br/>
<hr /><hr />
Break Time :
<hr />
Hour : <input type="text" name="break_time_hours"/> <br/> <br/>
Minutes : <input type="text" name="break_time_minutes"/> <br/> <br/>
Seconds : <input type="text" name="break_time_seconds"/> <br/> <br/>
<hr /><hr />
Lunch Time :
<hr />
Hour : <input type="text" name="lunch_time_hours"/> <br/> <br/>
Minutes : <input type="text" name="lunch_time_minutes"/> <br/> <br/>
Seconds : <input type="text" name="lunch_time_seconds"/> <br/> <br/>
<hr /><hr />
<!-- Break between two lectures : <input type="text" name="break_between_lectures" /> </br></br></br> -->
<input type="submit" value="Submit !" />
</form>

<table ></table>
</body>
</html>