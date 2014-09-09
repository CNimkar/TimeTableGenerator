<?php
include '../config.inc.php';
include '../common_db.php';

if(isset($_REQUEST['subjects']) && isset($_REQUEST['id']))
{
    $query='SELECT sf.subject_id, s.subject_name FROM '.$my_table_prefix.'subject_faculty sf, '.$my_table_prefix.'subject s WHERE sf.subject_id=s.subject_id AND sf.faculty_id='.$_REQUEST['id'];
    $result = mysql_query($query);
    $subRows = array();
    while($row = mysql_fetch_array($result))
    {
        global $subRows;
        $subRows[]=$row;
    }
    echo '<select name="subject" required>';
    foreach($subRows as $row)
    {
        echo '<option value="'.$row['subject_id'].'">'.$row['subject_name'].'</option>';
    }
    echo '</select>';
}