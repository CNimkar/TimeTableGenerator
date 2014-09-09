<?php
include 'config.inc.php';
$conn = mysql_connect($my_host,$my_user,$my_password);
$check = mysql_select_db($my_database);
if(!$conn || !$check)
{
    echo 'Database Connectivity Failed!';
    exit();
}
