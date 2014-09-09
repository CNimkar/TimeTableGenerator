<?php

$user=$_GET['username'];
$password=$_GET['password'];
$database=$_GET['database'];
$table_prefix = $_GET["table_prefix"]."_";
$host = $_GET["host"];

$conn = mysql_connect("localhost",$user,$password) or die("check connection");
mysql_select_db($database);

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."faculty(faculty_id int(10) NOT NULL AUTO_INCREMENT,faculty_first_name varchar(30),faculty_last_name varchar(30),PRIMARY KEY (faculty_id));")
or
die(mysql_error());


mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."subject(subject_id int(10) NOT NULL AUTO_INCREMENT,subject_name varchar(30),PRIMARY KEY (subject_id));")
or
die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."classroom(classroom_id int(10) NOT NULL AUTO_INCREMENT,classroom_name varchar(30),PRIMARY KEY (classroom_id));")
or
die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."subject_faculty(subject_faculty_id int(10) NOT NULL AUTO_INCREMENT,faculty_id int(10),subject_id int(10),FOREIGN KEY(faculty_id) REFERENCES ".$table_prefix."faculty(faculty_id),FOREIGN KEY(subject_id) REFERENCES ".$table_prefix."subject(subject_id) ON DELETE CASCADE,PRIMARY KEY(subject_faculty_id));")
or
die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."lecture(lecture_id int(10) NOT NULL AUTO_INCREMENT,lecture_start_time TIME, lecture_end_time TIME,faculty_id int(10),subject_id int(10),classroom_id int(10),FOREIGN KEY(faculty_id) REFERENCES ".$table_prefix."faculty(faculty_id) ON DELETE CASCADE,FOREIGN KEY(subject_id) REFERENCES ".$table_prefix."subject(subject_id) ON DELETE CASCADE,FOREIGN KEY(classroom_id) REFERENCES ".$table_prefix."classroom(classroom_id) ON DELETE SET NULL,PRIMARY KEY(lecture_id));")
or
die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."user(user_id int(10) NOT NULL AUTO_INCREMENT,user_first_name varchar(30),user_last_name varchar(30),user_email varchar(30),user_password varchar(50),PRIMARY KEY (user_id));")
or
die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS ".$table_prefix."meta_info(meta_info_id int(10) NOT NULL AUTO_INCREMENT, active_days int(10), lectures_a_day int(10),timetable_title varchar(30), lunch_break_after varchar(30), start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,lecture_time int(6),break_time int(6),lunch_time int(6),break_flag BOOLEAN,user int(10), PRIMARY KEY(meta_info_id), FOREIGN KEY(user) REFERENCES ".$table_prefix."user(user_id) ON DELETE SET NULL);")
or
die(mysql_error());

mysql_query("INSERT INTO ".$table_prefix."user set user_first_name='admin', user_last_name='admin', user_email='amdin@gmail.com', user_password=md5('12345') ")
or
die(mysql_error());

$fp = fopen('config.inc.php', 'w');
fwrite($fp,'
<?php
$my_user =  '.'"'.$user.'" ;
$my_password = '.'"'.$password.'" ;
$my_database = '.'"'.$database.'" ;
$my_table_prefix = '.'"'.$table_prefix.'";
$my_host = '.'"'.$host.'";
?>'
);
fclose($fp);


?>
