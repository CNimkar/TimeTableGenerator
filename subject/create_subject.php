<?php
    include '../config.inc.php';
    include '../login_check.php';
    

?>

<html>
    <head>
        
    </head>
    <body>
        <form action="subject_validate.php" method="POST">
            <table>
                <tr>
                    <td>
                        <?php if(isset($GLOBALS['errors']))echo $GLOBALS['errors']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Name *: </td><td><input type="text" name="name" required /></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Create Subject"/></td>
                </tr>
            </table>
        </form>
    </body>
    
    
</html>

