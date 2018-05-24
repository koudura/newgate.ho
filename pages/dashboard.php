<?php
require_once("../functions/functions.php");
require_once("../classes/user.php");
session_start();
$current_user = getCurrentUserOrDie();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/dashboard.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="#" class="active dash_btn"><i class="fas fa-home"></i>Home</a>
        <?php echo ($current_user->isDoctor() || $current_user->isSupport()) ? '<a href="../pages/viewpatients.php" class="dash_btn"><i class="fas fa-user-md"></i>Staff</a>' : ''; ?>
        <?php echo ($current_user->isAdmin()) ? '<a href="../admin/viewusers.php" class="dash_btn"><i class="fas fa-toolbox"></i>Administrative</a>' : ''; ?>
        <a href="../logout.php" class="dash_btn"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </nav>
</section>
<header>
    <div class="name-field">
        <H1><?php
            $name = ($current_user->isDoctor()) ? "DR " : "";
            $name .= strtoupper($current_user->firstname[0]) .  ", ";
            $name .= ucwords($current_user->lastname);
            echo $name;
            ?></H1>
    </div>
    <div class="user-field">
        <a href="#"><i class="b far fa-question-circle"></i></a>
        <a href="#" class="notification"><i class="b fas fa-bell"></i><span class="circle">3</span></a>
        <a href="#">
            <div class="user-img"></div>
            <i class="b far fa-user"></i>
        </a>
    </div>
</header>
<section class="source-container">
    <div class="col-4">

        <div style="text-align: center border: 500px; border-radius: 500px border-color: black;">
            <br><br>
            <div class="backg-image">
                <img src="../assets/images/Reggie.png" style="width: 90%; height: auto;">
            </div>
            <img src="../assets/images/Reggie.png"
                 style="width: 90%; height: auto; border: 10px solid  rgb(182, 180, 180); border-radius: 500px; padding: 2px;">
            <br><br>
            <p style="font-size: 30px; line-height: 4px; letter-spacing: 2px;  margin-left: 20px; text-shadow: 1px 1px purple; text-align: center;">
                <b><?php
                    $name = ($current_user->isDoctor()) ? "Dr " : "";
                    $name .= ucwords($current_user->firstname) . ", ";
                    $name .= ucwords($current_user->lastname);
                    echo $name;
                    ?></b></p><br>
        </div>
    </div>

    <div class="col-5" style="color: white; text-align: center ">
        <br><br>
        <hr width="50%" style="border: 1px solid blue">
        <h2 style="text-shadow: 1px 1px purple; text-align: center; color: black;">MEDICAL PROFILE</h2>
        <hr width="50%" style="border: 1px solid blue">
        <br>
        <p><b>Status:</b> Administrator</p>
        <p><b>Date of birth:</b> june 28 1975</p>
        <p><b>Degree:</b> B.sc Medicine and Surgery</p><br>
    </div>

    <aside class="col-12" style="text-align: center; color: white;  padding: 50px">
        <hr width="100%" style="border: 1px solid blue">
    </aside>
</section>

</body>
</html>