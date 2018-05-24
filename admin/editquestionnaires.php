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
$currentQ = null;


if (isset($_GET['id'])) {
    $conn = connect();
    $id = Input::get('id');
    $currentQ = Questionnaire::getByID($conn, $id);
    $currentQ->jsonQ = json_decode($currentQ->jsonQ, TRUE);
    $_SESSION['qid'] = $currentQ->ID;
}

if (isset($_POST['submit'])) {
    $conn = connect();
    $id = Input::post('id');
    $title = Input::post('title');
    $count = intval(Input::post('count'));
    $jArray = array();
    for ($i = 1; $i <= $count; $i++) {
        $jArray[$i] = Input::post($i . "");
    }
    $jArray = json_encode($jArray);
    $quest = new Questionnaire($id, $title, $jArray);
    $quest->updateDB($conn);
    unset($_SESSION['qid']);
    redirect('viewquestionnaires.php');
    exit();
}

if (isset($_POST['delete'])) {
    $conn = connect();
    $id = $_SESSION['qid'];
    $quest = new Questionnaire($id, NULL, NULL);
    $quest->deleteDB($conn);
    unset($_SESSION['qid']);
    redirect('viewquestionnaires.php');
    exit();
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
    <title> EDIT Questionnaire </title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewquestionnaires.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="far fa-question-circle"></i>Questionnaire</a>
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input class="nav-btn" type="submit" name="delete" value="Delete Questionnaire!!!">
            </form>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input class="inputext" type="text" name="title" placeholder="Title"
                       value="<?php echo htmlspecialchars($currentQ->title); ?>" required>
                <div id="questdiv">
                    <?php
                    $ind = 0;
                    foreach ($currentQ->jsonQ as $key => $value) {
                        $ind = $key;
                        echo '<div> <input class="inputext" type="text" name="' . $key . '" value="' . htmlspecialchars($value) . '" required>  </div>';
                    }
                    ?>
                </div>
                <div class="lobot">
                    <input class="nav-btn" type="hidden" name="id" value="<?php echo $currentQ->ID; ?>">
                    <input class="nav-btn" type="hidden" name="count" value="<?php echo $key; ?>" id="count">
                    <input class="nav-btn" type="button" value="Add Question" onclick="addQuestion()">
                    <input class="nav-btn" type="button" value="Delete Last Question" onclick="deleteLastQuestion()">
                    <input class="nav-btn" type="submit" name="submit" value="Done">
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    function addQuestion() {
        let qDiv = document.getElementById('questdiv');
        let count = qDiv.childElementCount + 1;
        let nDiv = document.createElement("div");
        let inp = document.createElement("INPUT");
        inp.setAttribute("type", "text");
        inp.setAttribute("class", "inputext");
        inp.setAttribute("name", count + "");
        inp.setAttribute("required", true);
        nDiv.appendChild(inp);
        qDiv.appendChild(nDiv);
        let hid = document.getElementById('count');
        hid.value = count;
    }

    function deleteLastQuestion() {
        let qDiv = document.getElementById('questdiv');
        let count = qDiv.childElementCount;
        if (count > 1) {
            let child = qDiv.children[count - 1];
            child.parentNode.removeChild(child);
            let hid = document.getElementById('count');
            hid.value = count - 1;
        }
    }

</script>
</body>
</html>