<?php
    require_once("../functions/conn.php");
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isAdmin()) {
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
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/addusers.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
        </div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Patient</button></a> 
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Add Patient</button></a>
                </div>
        </div>
        <div class = "stuff text-center">
            <div class="middlegrid">
                <div></div>
                <div class = "card">
                    <div class = "content">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input class="inputext" type="email" name="email" placeholder="Email" required>
                    <br>
                    <input class="inputext" type="text" name="firstname" placeholder="Firstname" value="" required>
                    <br>
                    <input class="inputext" type="text" name="lastname" placeholder="Lastname" value="" required>
                    <br>
                    <br>
                    <div clas = "container">
                        <input class="checkmarc" id="rol1" type="checkbox" name="role[]" value="1" >
                        <label for="rol1">Admin</label>
                        <input class="checkmarc" id="rol2" type="checkbox" name="role[]" value="2" >
                        <label for="rol2">Doctor</label>
                        <input class="checkmarc" id="rol3" type="checkbox" name="role[]" value="3" >
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
    </div>
    
    
</body>
</html>
 