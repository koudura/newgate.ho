<?php
require_once("../functions/conn.php");
require_once("../functions/functions.php");
require_once("../classes/user.php");
session_start();
$current_user = getCurrentUserOrDie();
if (!$current_user->isAdmin()) {
    doUnauthorized();
}
if (isset($_POST["submit"])) {
    if (isset($_POST['role'])) {
        $conn = connect();
        $user = new User(null, $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['role']);
        $user->saveToDB($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/addusers.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"

          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>


    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>

        <a href="viewusers.php" class="dash_btn"><i class="fas fa-address-book"></i>User Explorer</a>
        <a href="#" class="active dash_btn"><i class="fas fa-plus-circle"></i>Add User</a>
        <a href="viewquestionnaires.php" class="dash_btn"><i class="fas fa-question"></i>Questionnaire</a>
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
        <div class="stuff ">
            <div class="middlegrid">
                <div></div>
                <div class="card">
                    <div class="content">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input class="inputext" type="email" name="email" placeholder="Email" required>
                            <br>
                            <input class="inputext" type="text" name="firstname" placeholder="Firstname" value=""
                                   required>
                            <br>
                            <input class="inputext" type="text" name="lastname" placeholder="Lastname" value=""
                                   required>
                            <br>
                            <br>
                            <div clas="container basictext">
                                <input class="checkmarc" id="rol1" type="checkbox" name="role[]" value="ADMIN">
                                <label for="rol1">Admin</label>
                                <br>
                                <input class="checkmarc" id="rol2" type="radio" name="role[]" value="DOCTOR">
                                <label for="rol2">Doctor</label>
                                <input class="checkmarc" id="rol3" type="radio" name="role[]" value="SUPPORT">
                                <label for="rol3">Support</label>
                            </div>
                            <br>
                            <input class="bodbut" type="submit" name="submit" value="Add User">
                        </form>
                    </div>
                    <p class="basictext">Default password is lastname in lower case</p>
                </div>
                <div></div>
            </div>

        </div>
    </section>

</body>
</html>
 