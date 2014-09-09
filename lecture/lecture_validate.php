<?php
    include '../config.inc.php';
    include '../common_db.php';
    include '../login_check.php';
    $errors = "";
    if(!(isset($_REQUEST['classroom'])&& isset($_REQUEST['faculty']) && isset($_REQUEST['subject'])))
    {
       global $errors;
       $errors = "Please Fill in all the required fields";
       include 'create_faculty.php';
       exit();
    }
    $classroom = $_POST['classroom'];
    $faculty = $_POST['faculty'];
    $subject = $_POST['subject'];
    
    
    $query = 'INSERT INTO '.$my_table_prefix.'lecture set faculty_id='.$faculty.', classroom_id='.$classroom.', subject_id='.$subject;
    //var_dump($query);
    $check = mysql_query($query);
    mysql_error();
    $id = -1;
    
    
    echo "Lecture Added succesfully";

