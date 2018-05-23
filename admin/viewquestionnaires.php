<?php
require_once("../functions/conn.php");
require_once("../functions/functions.php");
require_once("../classes/user.php");
require_once("../classes/questionnaire.php");

session_start();
$current_user = getCurrentUserOrDie();
if (!$current_user->isAdmin()) {
    doUnauthorized();
}

$conn = connect();
$stmt = $conn->query("SELECT * FROM tbl_users");
$quests = Questionnaire::getAll($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Questionnaires</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewusers.php" class="dash_btn"><i class="fas fa-address-book"></i>User Explorer</a>
        <a href="addusers.php" class="dash_btn"><i class="fas fa-plus-circle"></i>Add User</a>
        <a href="#" class="active dash_btn"><i class="far fa-question-circle"></i>Questionnaire</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
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
<section class="main-container">
    <div class="stuff">
        <table class="genTab">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($quests as $quest) {
                echo <<<_END
            <tr>
                <td> $quest->ID</td>
                <td> $quest->title</td>
                <td> <a href="editquestionnaires.php?id=$quest->ID">MANAGE</a></td>
            </tr>
_END;
            }
            ?>


            </tbody>
        </table>
    </div>
</section>


</body>
</html>