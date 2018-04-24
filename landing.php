<?php
    require_once("functions/functions.php");
    session_start();
    if (!isset($_SESSION["ID"])){ header("Location: login.php");}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing</title>
</head>
<body>
    <nav>
        <ul>
            <?php echo  (isAdmin()) ?  '<li><a href="#">ADMIN</a></li>': ''; ?>
            <?php echo  (isDoctor()) ?  '<li><a href="#">Doc Only</a></li>': '';  ?>
            <?php echo  (isDoctorOrSupport()) ? '<li><a href="#">Manage Patients</a></li>': '';  ?>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    
</body>
</html>