<?php
require_once '../config.inc.php';
require_once '../common_db.php';
require_once '../login_check.php';
$query = "SELECT * FROM ".$my_table_prefix."meta_info WHERE user=".$_SESSION['userdata']['user_id'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$prefix="";
$offset=""; 
$lectures_a_day = $row['lectures_a_day'];
$active_days = $row['active_days'];
$time_table_title = $row['timetable_title'];
$start_time = $row['start_time'];
$lecture_time = $row['lecture_time'];
$break_time = $row['break_time'];
$lunch_time = $row['lunch_time'];
$break_flag = $row['break_flag'];
if($break_flag == 1)
{
    $total_rows = $row['lectures_a_day'] + 1;
    $break_time = 0;
}
else
{
    $total_rows = $row['lectures_a_day'] * 2 - 1;
}

$lunch_break_after = $row['lunch_break_after'];

$cumulative = DateTime::createFromFormat('H:i:s',$start_time);
$lecture_time = DateInterval::createFromDateString($lecture_time." seconds");
$break_time = DateInterval::createFromDateString($break_time." seconds");
$lunch_time = DateInterval::createFromDateString($lunch_time." seconds");

$prefix_arr = array();
$postfix_arr = array();

for ($i=1;$i<=$total_rows;$i++)
{
    if($i%2 != 0)
    {   global $prefix;
        global $offset;
        global $cumulative;
        global $prefix_arr;
        global $postfix_arr;
        global $start_time;
        global $lecture_time;
        global $break_time;
        
        $prefix = date_format($cumulative,'H:i:s');
         $prefix  = date("H:i:s", strtotime($prefix));
               
        $offset = date_format(date_add($cumulative,$lecture_time),'H:i:s');
                $offset  = date("H:i:s", strtotime($offset));
        
        $prefix_arr[]=$prefix;
        $postfix_arr[]=$offset;
     //   $cumulative = date_add($cumulative,$lecture_time);
        
    }
    else
    {
            if($i == ($lunch_break_after*2))
            {
                global $prefix;
                  global $offset;
                  global $cumulative;
                  global $prefix_arr;
                    global $postfix_arr;
                  global $start_time;
                  global $lecture_time;
                  global $lunch_time;
        
      
                
                $prefix = date_format($cumulative,'H:i:s');
                $prefix  = date("H:i:s", strtotime($prefix));
                $offset = date_format(date_add($cumulative,$lunch_time),'H:i:s');
                $offset  = date("H:i:s", strtotime($offset));
                
            
                
             }
            else
            {
                
                
                  global $prefix;
                  global $offset;
                  global $cumulative;
                  global $prefix_arr;
                  global $postfix_arr;
                  global $start_time;
                  global $lecture_time;
                  global $break_time;
        
      
                
                $prefix = date_format($cumulative,'H:i:s');
                $prefix  = date("H:i:s", strtotime($prefix));
               
                $offset = date_format(date_add($cumulative,$break_time),'H:i:s');
                $offset  = date("H:i:s", strtotime($offset));
        
                
                
            }
        }
        
}
//var_dump($prefix_arr);
//echo '--------------------------------';
//var_dump($postfix_arr);