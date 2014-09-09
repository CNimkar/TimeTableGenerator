<?php
session_start();
if(!isset($_SESSION['userdata']))
{ 
    require_once 'login.php';
    exit();
}
