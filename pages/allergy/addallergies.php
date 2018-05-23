<?php
    require_once('../../functions/conn.php');
    require_once('../../functions/functions.php');
    require_once("../../classes/user.php");
    require_once("../../classes/patient.php");
    require_once("../../classes/allergy.php");

    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();      
    }

    $patient;

    if(isset($_GET['ID'])){
        $conn = connect();
        $id = Input::get('ID');
        $patient = Patient::getPatientByID($conn, $id);
    }

    if (isset($_POST['submit'])){
        $conn = connect();
        $pid = Input::post('id');
        $desc = Input::post('desc');
        $allergy = new Allergy(NULL, $pid, $desc);
        $allergy->saveToDB($conn);
        redirect("../persian.php");
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add patients</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../../assets/css/addpatients.css"/>
</head>
<body>
    <div class="grid">
        <div class = "logo">
           <a href="/newgate.ho/pages/dashboard.php">
                <img class = "lago" src="../../assets/images/newgate.svg" alt="logo here">
            </a>
        </div>

        
        <div class = "profile">adsdas</div>


        <div class = "navbar"></div>


        <div class = "stuff text-center">
        <div class = "middlegrid">   
        <div></div>
        <div class = "card">            
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input class="inputext addp" type="hidden" name="id" value="<?php echo $patient->ID; ?>" required><br>
                    <input class="inputext addp" type="text" name="desc" placeholder="Description" required><br>
                    <input class="bodbut addp" type="submit" name="submit" value="submit">
                </form>   
        </div>  
        <div></div>
    </div> 
</body>
</html>