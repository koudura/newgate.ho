<?php
require_once("../functions/functions.php");
require_once("../classes/user.php");
session_start();
$current_user = getCurrentUserOrDie();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
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
    <div class="search-field">
        <i class="fas fa-search"></i>
        <input type="text" name="" value="">
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
<div class="stuff"></div>

</body>
</html>