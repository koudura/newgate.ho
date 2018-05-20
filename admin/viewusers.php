<?php
    require_once("../functions/conn.php");
    require_once("../functions/functions.php");
    require_once("../user.php");
    session_start();
    if (!isset($_SESSION["ID"]) || !isAdmin()){
        doUnauthorized();        
    }

    $conn = connect();
    $stmt = $conn->query("SELECT * FROM tbl_users");
    $users = User::getAllUsers($conn);    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Users</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
        </div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
            <div class ="navgrid">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Users</button></a> 
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Questionnaires</button></a>
                </div>
            </div>
        </div>
 <div class = "stuff">        
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Admin</th>
                <th>Role</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {
                $admin = ($user->isAdmin())?"True":"False";
                $role = ($user->isDoctor())?"Doctor":"Support";
                
                echo <<<_END
            <tr>
                <td> $user->email</td>
                <td> $user->firstname</td>
                <td> $user->lastname</td>
                <td> $admin </td>
                <td> $role </td>
                <td> $user->phonenos </td>
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