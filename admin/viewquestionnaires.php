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
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/viewusers.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Questionnaires</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <a href="/newgate.ho/pages/dashboard.php">
                <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
            </a>
        </div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Users</button></a> 
                <a href="/newgate.ho/admin/viewquestionnaires.php"><button class="nav-btn">Manage Questionnaires</button></a>
                <a href="/newgate.ho/admin/addusers.php"><button class="nav-btn">Add Users</button></a>
                </div>
        </div>
 <div class = "stuff">        
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
    </div>
</body>
</html>