<?php
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isAdmin()) {
        doUnauthorized();      
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <a href="/newgate.ho/pages/dashboard.php">
                <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
            </a>
        </div>
        <div class = "profile">adsdas</div>
        <div class = "navbar">
        <nav>
            <ul>
                <li><a href="#">Manage Users</a></li>
                <li><a href="#">Manage Tests</a></li>
                <li><a href="#">Manage Questionnaires</a></li>
            </ul>
        </nav>
        </div>
        <div class = "stuff">adad</div>
    </div>
    
    
</body>
</html>