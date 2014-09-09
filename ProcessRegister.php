<?php
include 'config.inc.php';

$user_first_name =$_POST["user_first_name"];
$user_last_name =$_POST["user_last_name"];
$user_email = $_POST["user_email"];
$first_password = $_POST["first_password"];
$second_password = $_POST["second_password"];

$conn = mysql_connect("localhost",$my_user,$my_password);
mysql_select_db($my_database);
if($first_password != $second_password)
{
    echo "Passwords don't match !";
    exit();
}
else
{
    
    if(preg_match('/[a-zA-Z]+@[a-zA-Z]+\.[a-zA-Z]+\.?[a-zA-Z]*/', $user_email)== 0)
    {
         echo "Please enter correct email address !";
         exit();
    }
    else
    {
        $query = "insert into ".$my_table_prefix."user(user_first_name,user_last_name,user_password,user_email) values('".$user_first_name."', '".$user_last_name."', md5('".$first_password."'), '".$user_email."')";
        //var_dump($query);
       if(mysql_query($query))
       {
           echo "Successfully Registered with TTGen !";
           echo '<a href="login.php">Login now !</a>';
       }
       else
       {
           echo mysql_error();
           echo "Something went wrong. Please try again";
       }
        
//echo $query;
        //var_dump($check);
    }
    
}
?>
