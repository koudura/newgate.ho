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
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Manage Users</a></li>
            <li><a href="#">Manage Tests</a></li>
            <li><a href="#">Manage Questionnaires</a></li>
        </ul>
    </nav>
    
</body>
</html>