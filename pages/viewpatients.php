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
    $patients = Patient::getAllPatients($conn);
    
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
                    <a href="/newgate.ho/admin/viewpatients.php"><button class="bodbut">Manage Patients</button></a> 
                </div>
        </div>
 <div class = "stuff">
            
    <table>
        <thead>
            <tr>
                <td> ID </td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Phone No</td>
                <td>Email</td>
                <td>DOB</td>
                <td>Height</td>
                <td>Weight</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($patients as $patient) {
                echo <<<_END
            <tr>
                <td> $patient->id </td>
                <td> $patient->firstname</td>
                <td> $patient->lastname</td>
                <td> $patient->phone_num </td>
                <td> $patient->email </td>
                <td> $patient->dob</td>
                <td> $patient->height</td>
                <td> $patient->weight</td>
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