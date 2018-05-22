<?php
    require_once("../functions/conn.php");
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    require_once("../classes/patient.php");

    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();      
    }
    $conn = connect();
    $stmt = $conn->query("SELECT * FROM tbl_patients");
    $patients = $stmt->fetchall(PDO::FETCH_ASSOC);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Patients</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">sss</div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Patients</button></a> 
                <a href="/newgate.ho/pages/addpatients.php"><button class="nav-btn">Add Patients</button></a>
            </div>
        </div>
 <div class = "stuff">
            
    <table>
        <thead>
            <tr>
                <td>Email</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Admin</td>
                <td>Role</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user) {
                $email = $user['email'];
                $firstname = $user['firstname'];
                $lastname = $user['lastname'];
                $admin = in_array('ADMIN', $roles[$user['ID']])? "TRUE":"FALSE";
                $role = "";
                if (in_array('DOCTOR', $roles[$user['ID']])){
                    $role = "DOCTOR";
                }elseif (in_array('SUPPORT', $roles[$user['ID']])){
                    $role = "SUPPORT";
                }
                echo <<<_END
            <tr>
                <td> $email</td>
                <td> $firstname</td>
                <td> $lastname</td>
                <td> $admin </td>
                <td> $role </td>
            </tr>
_END;
             }?>
        
        
        </tbody>
    </table>
        </div>
    </div>


    <script src="/newgate.ho/assets/js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){


            
        });
    </script>
</body>
</html>