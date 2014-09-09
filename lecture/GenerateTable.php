<?php
include 'config.inc.php';
session_start();
$conn = mysql_connect($my_host,$my_user,$my_password);
mysql_select_db($my_database);

$query = 'SELECT * FROM '.$my_table_prefix.'meta_info WHERE user='.$_SESSION['userdata']['user_id'];

$result = mysql_query($query);
$row = mysql_fetch_array($result);

$active_days = $row['active_days'];
$lectures_a_day = $row['lectures_a_day'];
$time_table_title = $row['timetable_title'];
$lunch_break_after = $row['lunch_break_after'];
//times in CMS$start_time = $_GET['start_time_hours'].":".$_GET['start_time_minutes'].":".$_GET['start_time_seconds'];
//$start_time = $_GET['start_time_hours'].":".$_GET['start_time_minutes'].":".$_GET['start_time_seconds'];
//$lecture_time = $_GET['lecture_time_hours'].":".$_GET['lecture_time_minutes'].":".$_GET['lecture_time_seconds'];
//$break_time = $_GET['break_time_hours'].":".$_GET['break_time_minutes'].":".$_GET['break_time_seconds'];
//$lunch_time = $_GET['lunch_time_hours'].":".$_GET['lunch_time_minutes'].":".$_GET['lunch_time_seconds'];

$start_time = $row['start_time'];
$lecture_time = $row['lecture_time'];
$break_time = $row['break_time'];
$lunch_time = $row['lunch_time'];

$no_break_flag = $row['break_flag'];
//var_dump($lecture_time);
//die();

$count = 1;
echo "<center><h1>$time_table_title</h1></center><br/>";
echo "<center>To generate PDF, click on 'File' on Menu bar and click on print(as PDF) <br/> Tick the background images and color option</center><br/><br/><br/>";
echo "<body><table border=1 align=center width=1000 height=1000>";
//$days = array("Time intervals","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
//$days_index = 0;
//$active_day_color = "green";
//$holiday_color = "red";
$time_line_index = 0; 
$time_line = array();


//var_dump(isset($_GET['break_flag']));
//die();
if($no_break_flag == FALSE)
{
 $breaks = $lectures_a_day-1; 
 $total_rows = $lectures_a_day + $breaks + 1;

$days = array("Time intervals","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$days_index = 0;

$active_day_color = "green";
$holiday_color = "red";
$break_color = "blue";




//START OF LECTURE ARRAY
$lectures_formatted = array();
//$element = "";
//$temp = "";
$lectures_scheduled=$_GET['lectures'];
//var_dump($lectures_scheduled);
//die();

    
    for($j=1;$j<=$lectures_a_day;$j++)
    {

        for($i=1;$i<=$active_days;$i++)
        {
//        global $lectures_scheduled;
//        $element = "text$i:$j";
//        $temp = $_GET[$element];
////        array_push($lectures_scheduled, $temp); 
//        $lectures_scheduled[] = $temp;
//    
        array_push($lectures_formatted, $lectures_scheduled[$i][$j]);
        
    }
}
//var_dump($lectures_formatted);
//die();
$lectures_formatted_index = 0;

//END OF LECTURE ARRAY 




$prefix="";
$offset=""; 
$cumulative_str ="";

$cumulative = DateTime::createFromFormat('Y-m-d H:i:s',$start_time);
$lecture_time = DateInterval::createFromDateString($lecture_time." seconds");
$break_time = DateInterval::createFromDateString($break_time." seconds");
$lunch_time = DateInterval::createFromDateString($lunch_time." seconds");

for ($i=1;$i<=$total_rows;$i++)
{
    if($i%2 != 0)
    {   global $prefix;
        global $offset;
        global $cumulative;
        global $cumulative_str;
        global $start_time;
        global $lecture_time;
        global $break_time;
        
        $prefix = date_format($cumulative,'H:i:s');
         $prefix  = date("g:i:s a", strtotime($prefix));
               
        $offset = date_format(date_add($cumulative,$lecture_time),'H:i:s');
                $offset  = date("g:i:s a", strtotime($offset));
        
        $cumulative_str = $prefix."-".$offset;
     //   $cumulative = date_add($cumulative,$lecture_time);
        array_push($time_line, $cumulative_str);
    }
    else
    {
            if($i == ($lunch_break_after*2))
            {
                global $prefix;
                  global $offset;
                  global $cumulative;
                  global $cumulative_str;
                  global $start_time;
                  global $lecture_time;
                  global $lunch_time;
        
      
                
                $prefix = date_format($cumulative,'H:i:s');
                $prefix  = date("g:i:s a", strtotime($prefix));
                $offset = date_format(date_add($cumulative,$lunch_time),'H:i:s');
                $offset  = date("g:i:s a", strtotime($offset));
                $cumulative_str = $prefix."-".$offset;
       //         $cumulative = date_add($cumulative,$lunch_time);
                array_push($time_line, $cumulative_str);
            
                
             }
            else
            {
                
                
                global $prefix;
                  global $offset;
                  global $cumulative;
                  global $cumulative_str;
                  global $start_time;
                  global $lecture_time;
                  global $break_time;
        
      
                
                $prefix = date_format($cumulative,'H:i:s');
                $prefix  = date("g:i:s a", strtotime($prefix));
               
                $offset = date_format(date_add($cumulative,$break_time),'H:i:s');
                $offset  = date("g:i:s a", strtotime($offset));
        
                $cumulative_str = $prefix."-".$offset;
                //$cumulative = date_add($cumulative,$break_time);
                array_push($time_line, $cumulative_str);

            }
        }
        
}

 
 for ($i = 1; $i <=$total_rows; $i++)
    {
            echo "<tr>";
            $row_height = 10;
            
            
            //lunch break row height
            if($i == ($lunch_break_after*2)+1)
                $row_height = 50;
                
            for ($j = 1; $j <= 8; $j++)
            {
                
                                    
                if($i==1)
                {   
                    echo "<td bgcolor=grey>$days[$days_index]</td>";
                    $days_index++;
                
                }
                else
                {
                       
                         if($j == 1)
                         {
                             
                                echo "<td bgcolor=grey>$time_line[$time_line_index]</td>";
                                $time_line_index++;
                
                             
                         }
                         else
                          {
                             
                             
                             
                             
                             
                             
                                 if($j > $active_days+1)
                                 {
                                    if($i%2 != 0)
                                    { echo "<td bgcolor=$break_color height=$row_height>  </td>";}
                                    else
                                    {   echo "<td bgcolor=$holiday_color>  </td>";}
                                 }
                                 else
                                 {
                                               if($lectures_formatted[$lectures_formatted_index] == "")
                                                {
                                                        $active_day_color = "yellow";
                                                }
                                                else
                                                {    
                                                        $active_day_color = "green";
                                                }
              
                                     
                                     
                                     if($i%2 != 0)
                                      {    echo "<td bgcolor=$break_color height=$row_height>   </td>";}
                                      else
                                      {   
                                           //echo "<td bgcolor=$active_day_color>$lectures_scheduled[$lectures_scheduled_index]</td>";$lectures_scheduled_index++;}
                                    echo "<td bgcolor=$active_day_color>".$lectures_formatted[$lectures_formatted_index++]."</td>";
                                          }
                                  }
                         }
        
                  }
            }
            echo "</tr>";
       }

 }

 elseif ($no_break_flag == TRUE)
     {
 $breaks = 0; 
 $total_rows = $lectures_a_day + $breaks +1;
 
$days = array("Time intervals","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$days_index = 0;

$active_day_color = "green";
$holiday_color = "red";
$break_color = "blue";

//START OF LECTURE ARRAY
$lectures_formatted = array();
//$element = "";
//$temp = "";
$lectures_scheduled=$_GET['lectures'];
//var_dump($lectures_scheduled);
//die();

    
    for($j=1;$j<=$lectures_a_day;$j++)
    {

        for($i=1;$i<=$active_days;$i++)
        {
//        global $lectures_scheduled;
//        $element = "text$i:$j";
//        $temp = $_GET[$element];
////        array_push($lectures_scheduled, $temp); 
//        $lectures_scheduled[] = $temp;
//    
        array_push($lectures_formatted, $lectures_scheduled[$i][$j]);
        
    }
}
//var_dump($lectures_formatted);
//die();
$lectures_formatted_index = 0;

//END OF LECTURE ARRAY 



 
$prefix="";
$offset=""; 
$cumulative_str ="";
$cumulative = DateTime::createFromFormat('H:i:s',$start_time);
$lecture_time = DateInterval::createFromDateString($lecture_time." seconds");
$break_time = DateInterval::createFromDateString($break_time." seconds");
$lunch_time = DateInterval::createFromDateString($lunch_time." seconds");

for ($i=1;$i<=$total_rows;$i++)
{
            if($i == ($lunch_break_after + 1))
            {
                global $prefix;
                  global $offset;
                  global $cumulative;
                  global $cumulative_str;
                  global $start_time;
                  global $lecture_time;
                  global $lunch_time;
        
      
                
                $prefix = date_format($cumulative,'H:i:s');
                $prefix  = date("g:i:s a", strtotime($prefix));
                $offset = date_format(date_add($cumulative,$lunch_time),'H:i:s');
                $offset  = date("g:i:s a", strtotime($offset));
                $cumulative_str = $prefix."-".$offset;
       //         $cumulative = date_add($cumulative,$lunch_time);
                array_push($time_line, $cumulative_str);
            
                
             }
else
    
    {   global $prefix;
        global $offset;
        global $cumulative;
        global $cumulative_str;
        global $start_time;
        global $lecture_time;
        global $break_time;
        
        $prefix = date_format($cumulative,'H:i:s');
         $prefix  = date("g:i:s a", strtotime($prefix));
               
        $offset = date_format(date_add($cumulative,$lecture_time),'H:i:s');
                $offset  = date("g:i:s a", strtotime($offset));
        
        $cumulative_str = $prefix."-".$offset;
     //   $cumulative = date_add($cumulative,$lecture_time);
        array_push($time_line, $cumulative_str);
    }
    
    
        
}
  


 for ($i = 1; $i <=$total_rows; $i++)
    {
             if($i == ($lunch_break_after)+2)
             {
                 $row_height = 30;
             }
             else
             {
                 $row_height = 70;
             
             }
            
     
     echo "<tr height=$row_height >";

            for ($j = 1; $j <= 8; $j++)
            {
                if($i==1)
                {   
                    echo "<td bgcolor=grey>$days[$days_index]</td>";
                    $days_index++;
                
                }
                else
                {
         
                          
                         if($j == 1)
                         {
                             
                                echo "<td bgcolor=grey>$time_line[$time_line_index]</td>";
                                $time_line_index++;
                
                             
                         }
                          else
                          {
                                                
                                                
                              if($j > $active_days+1)
                              {
                                echo "<td bgcolor=$holiday_color ></td>";
                              }
                              else
                              {
                                  if($i == ($lunch_break_after)+2)
                                  {
                                      echo "<td bgcolor=$break_color>   </td>";
                                  }
                                  else
                                  {
                                        if($lectures_formatted[$lectures_formatted_index] == "")
                                        {
                                              $active_day_color = "yellow";
                                        }
                                        else
                                        {    
                                              $active_day_color = "green";
                                        }
              
                                            echo "<td bgcolor=$active_day_color >".$lectures_formatted[$lectures_formatted_index++]."</td>";
                                   }
                                }
                          }
        
                  }
            }
            echo "</tr>";
       }

 }

 
echo "</table>";

?>
