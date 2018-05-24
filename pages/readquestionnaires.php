<?php
require_once("../functions/conn.php");
require_once("../functions/functions.php");
require_once("../classes/user.php");
require_once("../classes/questionnaire.php");
require_once("../classes/qresponse.php");

session_start();
$current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();
    }


$currentQ = null;
$currentResponse =null;


if (isset($_GET['id'])) {
    $conn = connect();
    $id = Input::get('id');
    $currentQ = Questionnaire::getByID($conn, $id);
    $currentQ->jsonQ = json_decode($currentQ->jsonQ, TRUE);
    $currentResponse = QResponse::getResponseByID($conn, $current_user->id, $id);
    $currentResponse->response =  json_decode($currentResponse->response, TRUE);
    $_SESSION['qid'] = $currentQ->ID;
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/editq.css"/>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <title> READ Questionnaire </title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewquestionnaires.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="fas fa-question"></i>Questionnaire</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
    </nav>
</section>
<header>
    <div class="name-field">
            <H1><?php 
            $name = ($current_user->isDoctor())?"DR ":"";
            $name .= strtoupper($current_user->firstname).", ";
            $name .= strtoupper($current_user->lastname);
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
<section class="main-container">
    <div class="stuff">
        <div class="card text-center">
            

            <div>
                <h2><?php echo htmlspecialchars($currentQ->title); ?></h2>
                <div id="questdiv">
                    <?php
                    $ind = 0;
                    foreach ($currentQ->jsonQ as $key => $value) {
                        $ind = $key;
                        echo '<div> Q'.$key.':<input class="inputext" type="text" name="' . $key . '" value="' . htmlspecialchars($value) . '"disabled>  </div>';
                        echo '<div>A'.$key.': <input class="inputext" type="text" name="ans' . $key . '" value="'.htmlspecialchars($currentResponse->response[$key]) .'" disabled >  </div>';
                    }
                    ?>
                </div>
                <div class="lobot">
                    <input class="nav-btn" type="hidden" name="id" value="<?php echo $currentQ->ID; ?>">
                    <input class="nav-btn" type="hidden" name="count" value="<?php echo $key; ?>" id="count">
                    
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>