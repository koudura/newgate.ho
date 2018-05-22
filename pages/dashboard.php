<?php
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    session_start();
    $current_user = getCurrentUserOrDie();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/dashboard.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
        </div>
        <div class = "profile">adsdas
            <a href="/newgate.ho/logout.php"><button class="nav-btn">Logout</button></a>
        </div>
        <div class = "navbar">      
                <div class="damn">
                <?php echo  ($current_user->isDoctor() || $current_user->isSupport()) ? '<a href="/newgate.ho/pages/viewpatients.php"><button class="nav-btn">Support</button></a>': '';  ?>
                <?php echo  ($current_user->isDoctor()) ?  '<a href="/newgate.ho/pages/dashboard.php"><button class="nav-btn">Doctor</button></a>': '';  ?>
                <?php echo  ($current_user->isAdmin()) ?  '<a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn adminbut">Administrative</button></a>': ''; ?>
                </div>  
        </div>
        <div class = "stuff"></div>
    </div>
    
    
</body>
</html>