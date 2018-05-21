<?php
    require_once("../functions/conn.php");
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    session_start();
    if (!isset($_SESSION["ID"]) || !isAdmin()){
        doUnauthorized();        
    }
    if (isset($_POST["submit"])){
        if(isset($_POST['role'])){
            $conn = connect();
            $user = new User(null, $_POST['email'], $_POST['firstname'], $_POST['lastname'], "", $_POST['role']);
            $user->saveToDB($conn);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">sss</div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
            <div class ="navgrid">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="bodbut">Manage Patient</button></a> 
                <a href="/newgate.ho/admin/viewusers.php"><button class="bodbut">Add Patient</button></a>
                </div>
            </div>
        </div>
        <div class = "stuff">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="email" name="email" placeholder="email" required>
        <br>
        <input type="text" name="firstname" value="" required>
        <br>
        <input type="text" name="lastname" value="" required>
        <br>
        <ul>
            <h4>Roles</h4>
            <li><label>Admin <input type="checkbox" name="role[]" value="1" ></label></li>
            <li><label>Doctor <input type="checkbox" name="role[]" value="2" ></label></li>
            <li><label>Support <input type="checkbox" name="role[]" value="3" ></label></li>
        </ul>
        <br>
        <input type="submit" name="submit" value="Add User">
        
    </form>
    <p>Default password is lastname in lower case</p>
        </div>
    </div>
    
    
</body>
</html>