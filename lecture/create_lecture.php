<?php
    include '../config.inc.php';
    include '../common_db.php';
    include '../login_check.php';
    
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
    


?>

<html>
    <head>
        
    </head>
    <body>
        <form action="lecture_validate.php" method="POST">
            <table>
                <tr>
                    <td>
                        <?php if(isset($GLOBALS['errors']))echo $GLOBALS['errors']; ?>
                    </td>
                </tr>
                 <tr>
                    <td>Class Room *: </td><td><select name="classroom" required >
                            <?php
                                foreach($classRows as $row)
                                {
                                    echo '<option value="'.$row['classroom_id'].'">'.$row['classroom_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
                
                <tr>
                    <td>Faculty *: </td><td><select id="faculty_id" name="faculty" required >
                            <?php
                                foreach($facRows as $row)
                                {
                                    echo '<option value="'.$row['faculty_id'].'">'.$row['faculty_first_name'].' '. $row['faculty_last_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Subject *: </td>
                    <td>
                        <div id="subject_id">
                            
                        </div>
                        
                    </td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Create Lecture"/></td>
                </tr>
            </table>
            <script src="../jquery-1.11.1.min.js">
            
            </script>
            <script>
                $(document).ready(function(){
                    $("#faculty_id").change(function(){
                        fid = $("#faculty_id option:selected").val();
                        $.get('/MyPhp/TTGen/subject/getSubjects.php',{subjects:"getSubjects",id:fid},function(data){
                            $("#subject_id").html(data);
                            
                        })
                    })
                    
                    
                })
                
            </script>
        </form>
    </body>
    
    
</html>

