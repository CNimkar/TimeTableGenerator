<?php
    include '../config.inc.php';
    include '../common_db.php';
    include '../login_check.php';
    $query = "SELECT * FROM ".$my_table_prefix."subject";
    $result = mysql_query($query);
    $Rows = array();
    while($row = mysql_fetch_array($result))
    {
        $Rows[]=$row;
        
    }


?>

<html>
    <head>
        
    </head>
    <body>
        <form action="faculty_validate.php" method="POST">
            <table>
                <tr>
                    <td>
                        <?php if(isset($GLOBALS['errors']))echo $GLOBALS['errors']; ?>
                    </td>
                </tr>
                <tr>
                    <td>First Name *: </td><td><input type="text" name="fname" required /></td>
                </tr>
                <tr>
                    <td>Last Name *: </td><td><input type="text" name="lname" required /></td>
                </tr>
                <tr>
                    <td>Subject *: </td><td><select name="subjects[]" required multiple >
                            <?php
                                foreach($Rows as $row)
                                {
                                    echo '<option value="'.$row['subject_id'].'">'.$row['subject_name'].'</option>';
                                }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Create Faculty"/></td>
                </tr>
            </table>
        </form>
    </body>
    
    
</html>

