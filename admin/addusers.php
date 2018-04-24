<?php
    require_once("../functions/functions.php");
    session_start();
    if (!isset($_SESSION["ID"]) || !isAdmin()){
        doUnauthorized();        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="email" name="email" placeholder="email">
        <br>
        <ul>
            <h4>Roles</h4>
            <li><label>Admin <input type="checkbox" name="role" value="1"></label></li>
            <li><label>Doctor <input type="checkbox" name="role" value="2"></label></li>
            <li><label>Support <input type="checkbox" name="role" value="3"></label></li>
        </ul>
        
        
    </form>
    
</body>
</html>