<?php
    include '../config.inc.php';
    include '../common_db.php';
    include '../login_check.php';
    $errors = "";
    if(!(isset($_REQUEST['fname'])&& isset($_REQUEST['lname']) && isset($_REQUEST['subjects'])))
    {
       global $errors;
       $errors = "Please Fill in all the required fields";
       include 'create_faculty.php';
       exit();
    }
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $subjects = $_POST['subjects'];
    
    
    $query = 'INSERT INTO '.$my_table_prefix.'faculty set faculty_first_name="'.$fname.'", faculty_last_name="'.$lname.'"';
    //var_dump($query);
    $check = mysql_query($query);
    mysql_error();
    $id = -1;
    if($check)
    {
        global $id;
        $r = mysql_fetch_array(mysql_query("SELECT last_insert_id() as id"));
        $id = $r['id'];
    }
    foreach($subjects as $sub)
    {
        $query2 = 'INSERT INTO '.$my_table_prefix.'subject_faculty set faculty_id='.$id.', subject_id='.$sub;
        mysql_query($query2);
    }
    
    echo "Faculty Added succesfully";

