<?php
    require_once("functions/functions.php");
    session_start();
    if (!isset($_SESSION["ID"])){ 
        header("Location: /newgate.ho/login.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <img class = "lago" src="assets/images/newgate.svg" alt="">
        </div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
            <div class ="navgrid">
                <div class="damn">
                <?php echo  (isAdmin()) ?  '<a href="/newgate.ho/admin/viewusers.php"><button class="bodbut">ADMIN</button></a>': ''; ?>
                <?php echo  (isDoctor()) ?  '<a href="/newgate.ho/pages/dashboard.php"><button class="bodbut">Doc Only</button></a>': '';  ?>
                <?php echo  (isDoctorOrSupport()) ? '<a href="/newgate.ho/pages/dashboard.php"><button class="bodbut">Manage Patients</button></a>': '';  ?>
                <a href="/newgate.ho/logout.php"><button class="bodbut">Logout</button></a>
                </div>
            </div>
        </div>
        <div class = "stuff"></div>
    </div>
    
    
</body>
</html>