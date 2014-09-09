<?php
    include '../config.inc.php';
    include '../common_db.php';
    include '../login_check.php';
    $errors = "";
    if(!(isset($_REQUEST['name'])))
    {
       global $errors;
       $errors = "Please Fill in all the required fields";
       include 'create_subject.php';
       exit();
    }
    $name = $_POST['name'];
    
    
    
    $query = 'INSERT INTO '.$my_table_prefix.'subject set subject_name="'.$name.'"';
    //var_dump($query);
    //var_dump($query);
    $check = mysql_query($query);
    //var_dump($check);
    mysql_error();
    
    echo "Subject Added succesfully";

