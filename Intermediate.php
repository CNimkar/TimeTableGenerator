<?php
include 'config.inc.php';
session_start();
$conn = mysql_connect($my_host,$my_user,$my_password);
mysql_select_db($my_database);

function convertToSeconds($hours,$minutes,$seconds)
{
    
    $temp =  ($hours*3600)+($minutes*60)+$seconds;
    return $temp;
}


$active_days = $_GET['number_of_days_in_week'];
$lectures_a_day = $_GET['number_of_lectures'];
$time_table_title = $_GET['title_of_table'];
$lunch_break_after = $_GET['lunch'];

$start_time = $_GET['start_time_hours'].":".$_GET['start_time_minutes'].":".$_GET['start_time_seconds'];
//$lecture_time = $_GET['lecture_time_hours'].":".$_GET['lecture_time_minutes'].":".$_GET['lecture_time_seconds'];
//$break_time = $_GET['break_time_hours'].":".$_GET['break_time_minutes'].":".$_GET['break_time_seconds'];
//$lunch_time = $_GET['lunch_time_hours'].":".$_GET['lunch_time_minutes'].":".$_GET['lunch_time_seconds'];


$lecture_time = convertToSeconds($_GET['lecture_time_hours'],$_GET['lecture_time_minutes'],$_GET['lecture_time_seconds']);
$break_time = convertToSeconds($_GET['break_time_hours'],$_GET['break_time_minutes'],$_GET['break_time_seconds']);
$lunch_time = convertToSeconds($_GET['lunch_time_hours'],$_GET['lunch_time_minutes'],$_GET['lunch_time_seconds']);


if(isset($_GET['no_breaks']))
    $flag_no_breaks = 1;
else
     $flag_no_breaks = 0;

$lectures_scheduled = array();

echo "<form action='GenerateTable.php' method='GET'>";
for($i=1;$i<=$active_days;$i++)
{

    for($j=1;$j<=$lectures_a_day;$j++)
    {
//        echo "Lecture no $j on day $i : <input type=text name=text$i:$j /> <br /><br />";
        echo "Lecture no $j on day $i : <input type=text name=lectures[$i][$j] /> <br /><br />";
    
    }
    
   echo "<br /><br /><br /><br />";
}
$stime  = date("Y-m-d H:i:s",strtotime($start_time));
//var_dump($stime);
//die();
$query = 'INSERT INTO '.$my_table_prefix.'meta_info(user,active_days,lectures_a_day, timetable_title, lunch_break_after, start_time, lecture_time, break_time, lunch_time, break_flag) values('.$_SESSION['userdata']['user_id'].', '.$active_days.', '.$lectures_a_day.', "'.$time_table_title.'", '.$lunch_break_after.', "'.$stime.'", "'.$lecture_time.'", "'.$break_time.'", "'.$lunch_time.'", '.$flag_no_breaks.')';
//$query = 'INSERT INTO '.$my_table_prefix.'meta_info values(2,'.$active_days.', '.$lectures_a_day.', "'.$time_table_title.'", '.$lunch_break_after.', "3600", "2014-05-14 08:00:00", "2014-05-14 08:00:00", "2014-05-14 08:00:00", '.$flag_no_breaks.')';
$check = mysql_query($query);
//var_dump($query);
//echo mysql_error();
if(!$check)
{
    echo 'Database Error has occured!!';
}
//echo "<input type='hidden' value='$active_days' name='number_of_days_in_week'>";
//echo "<input type='hidden' value='$lectures_a_day' name='number_of_lectures'>";
//echo "<input type='hidden' value='$time_table_title' name='title_of_table'>";
//echo "<input type='hidden' value='$lunch_break_after' name='lunch'>";
//echo "<input type='hidden' value='$start_time' name='start_time'>";
//echo "<input type='hidden' value='$lecture_time' name='lecture_time'>";
//echo "<input type='hidden' value='$break_time' name='break_time'>";
//echo "<input type='hidden' value='$lunch_time' name='lunch_time'>";
//echo "<input type='hidden' value='$flag_no_breaks' name='break_flag'>";

echo "<input type='submit' value='Generate'>";
echo "</form>";
?>