<?php
    include_once '../config.inc.php';
    include_once     '../common_db.php';
    include_once '../login_check.php';
    
    include 'offsetCalcuation.php';
    $query = "SELECT * FROM ".$my_table_prefix."faculty";
    $result = mysql_query($query);
    $facRows = array();
    while($row = mysql_fetch_array($result))
    {
        global $facRows;
        $facRows[]=$row;
        
    }
    $query = "SELECT * FROM ".$my_table_prefix."classroom";
    $result = mysql_query($query);
    $classRows = array();
    while($row = mysql_fetch_array($result))
    {
        global $classRows;
        $classRows[]=$row;
        
    }
    $query='SELECT * FROM '.$my_table_prefix.'subject s';
    $result = mysql_query($query);
    $subRows = array();
    while($row = mysql_fetch_array($result))
    {
        global $subRows;
        $subRows[]=$row;
    }
    ?>
<html>
    <head></head>
    <body>
    <?php
echo "<form action='saveLectures.php' method='POST'>";
echo '<table border="1">';

for($i=1;$i<=$active_days;$i++)
{
    $c = 0;
    
    for($j=1;$j<=$lectures_a_day;$j++)
    { ?>

<tr><td>Lecture no :</td><td> <?php echo "$j on day $i" ;?></td></tr>
        <tr>
                    <input type="hidden" name="start_time[]" value="<?php echo $prefix_arr[$c]; ?>"/>
                    <input type="hidden" name="end_time[]" value="<?php echo $postfix_arr[$c]; $GLOBALS['c'] = $GLOBALS['c'] +1; ?>"/>
                    <td>Class Room *: </td><td><select name="classroom[]" required >
                            <?php
                                foreach($classRows as $row)
                                {
                                    echo '<option value="'.$row['classroom_id'].'">'.$row['classroom_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
                
                <tr>
                    <td>Faculty *: </td><td><select class="faculty" name="faculty[]" required >
                            <?php
                                foreach($facRows as $row)
                                {
                                    echo '<option value="'.$row['faculty_id'].'">'.$row['faculty_first_name'].' '. $row['faculty_last_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Subject *: </td><td><select class="subject" name="subject[]" required >
                            <?php
                                foreach($subRows as $row)
                                {
                                    echo '<option value="'.$row['subject_id'].'">'.$row['subject_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
    <?php }
    
}
echo"<input name='submit' type='submit' value='submit'/></form></table>";
?>
                <script src="../jquery-1.11.1.min.js">
            
            </script>
            <script>
                $(document).ready(function(){
                    $(".faculty").change(function(){
                        fid = $(this).children("option:selected").val();
                        $.get('/MyPhp/TTGen/subject/getSubjects.php',{subjects:"getSubjects",id:fid},function(data){
                            $("#subject_id").html(data);
                            
                        })
                    })
                    
                    
                })
                
            </script>
    <?php 
   echo "</body></html>";

