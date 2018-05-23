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


    if(isset($_GET['id'])){
        $conn = connect();
        $id = Input::get('id');
        $currentQ = Questionnaire::getByID($conn,$id);
        $currentQ->jsonQ = json_decode($currentQ->jsonQ, TRUE);
        $_SESSION['qid'] =  $currentQ->ID;
    }

    if(isset($_POST['submit'])){
        $conn = connect();
        $id = Input::post('id');
        $title = Input::post('title');
        $count = intval(Input::post('count'));
        $jArray = array();
        for($i = 1; $i <= $count; $i++){
            $jArray[$i] = Input::post($i."");
        }
        $jArray = json_encode($jArray);
        $quest = new Questionnaire($id, $title, $jArray);
        $quest->updateDB($conn);
        unset($_SESSION['qid']);
        redirect('viewquestionnaires.php');
        exit();
    }

    if(isset($_POST['delete'])){
        $conn = connect();
        $id=$_SESSION['qid'];
        $quest = new Questionnaire($id,NULL,NULL);
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
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <title> EDIT Questionnaire </title>
</head>
<body>
    <div class = "grid">
        <div class = "logo">
            <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
        </div>
        <div class = "profile"></div>
        <div class = "navbar"></div>
        <div class = "stuff"></div>
    </div>

    <div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="submit" name="delete" value="Delete Questionnaire!!!" >
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($currentQ->title);?>" required>
            <div id="questdiv">
                <?php 
                $ind = 0;
                foreach ($currentQ->jsonQ as $key => $value) {
                    $ind = $key;
                    echo '<div> <input type="text" name="'.$key.'" value="'.htmlspecialchars($value).'" required>  </div>';
                }
             ?>
                
            </div>
            <input type="hidden" name="id" value="<?php echo $currentQ->ID; ?>" >
            <input type="hidden" name="count" value="<?php echo $key; ?>" id="count">
            <input type="button" value="Add Question" onclick="addQuestion()">
            <input type="button" value="Delete Last Question" onclick="deleteLastQuestion()">
            <input type="submit" name="submit" value="submit" >
        </form>
        
        
    </div>


    <script>
        function addQuestion(){
            let qDiv = document.getElementById('questdiv');
            let count = qDiv.childElementCount + 1;
            let nDiv = document.createElement("div");
            let inp = document.createElement("INPUT");
            inp.setAttribute("type","text");
            inp.setAttribute("name", count + "");
            inp.setAttribute("required", true);
            nDiv.appendChild(inp);
            qDiv.appendChild(nDiv);
            let hid = document.getElementById('count');
            hid.value = count;
        }
        
        function deleteLastQuestion(){
            let qDiv = document.getElementById('questdiv');
            let count = qDiv.childElementCount;
            if (count > 1){
                let child = qDiv.children[count - 1];
                child.parentNode.removeChild(child);
                let hid = document.getElementById('count');
                hid.value = count - 1;
            }
        }

    </script>
</body>
</html>