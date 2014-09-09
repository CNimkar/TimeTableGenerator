<?php
include_once '../config.inc.php';
    include_once     '../common_db.php';
    include_once '../login_check.php';
    
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $faculty_id = $_POST['faculty'];
    $subject = $_POST['subject'];
    $classroom = $_POST['classroom'];
    
    //var_dump($classroom);
    //die();
    
    for($i=0;$i<count($_POST['faculty']);$i++)
    {
        $query = 'INSERT INTO '.$my_table_prefix.'lecture set lecture_start_time="'.$start[$i].'", lecture_end_time="'.$end[$i].'", faculty_id='.$faculty_id[$i].
                ', subject_id='.$subject[$i].', classroom_id='.$classroom[$i];
        echo $query;
        mysql_query($query);
    }
    

