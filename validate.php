<?php
include("config.inc.php");
include 'common_db.php';

$conn = mysql_connect($my_host,$my_user,$my_password) or die("check connection");
mysql_select_db($my_database);

$tt_user = $_POST['user'];
$tt_password = $_POST['pass'];

$query = 'select * from '.$my_table_prefix.'user where user_first_name="'.$tt_user.'" and user_password=md5("'.$tt_password.'")';


$result= mysql_query($query);
$row = mysql_fetch_array($result);
mysql_error();

if($row)
{
    session_start();
    $_SESSION['userdata'] = $row;
    echo "Login successful.";
    include 'input.php';
    exit();
    
}
else
{

	echo "Invalid Username/Password";
}



//echo $query;
//$result= mysql_query("select user_name from timetablegen_user where uid=1") or die(mysql_error());
//while($row = mysql_fetch_assoc($result)) {
//    $tt_user_match = $row['user_name'];
//}

//$result = mysql_query("select password from timetablegen_user where uid=1") or die(mysql_error());
//while($row = mysql_fetch_assoc($result)) {
//    $tt_password_match = $row['password'];
//}

    //$tt_actual_user = $row['user_name'];
    //$tt_actual_password = $row['passwrod'];

//if (($tt_user == $tt_user_match) && ($tt_password == $tt_password_match))
//{
//	echo "Hello  ".$tt_user."  !";//
//}
//else
//{
//	echo "Please enter correct password ! <br/>";
	
//	}

?>