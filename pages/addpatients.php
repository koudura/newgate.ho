<?php
    require_once('../functions/conn.php');
    require_once('../functions/functions.php');
    require_once("../classes/user.php");
    require_once("../classes/patient.php");

    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();      
    }

    if (isset($_POST['submit'])){
        
        if ( date('Y-m-d') < Input::toMysqlDate(Input::post('dob')) ){
            echo "<script>alert('Invalid Date');</script>";
        }else{
            var_dump($_POST);
            $conn = connect();
            $stmt = $conn->prepare("INSERT INTO tbl_patients (firstname, lastname, email,phone_num,dob,height,weight) VALUES (:firstname, :lastname, :email, :phone_num, :dob. :height, :weight)");
            
            $firstname = Input::post('firstname');
            $lastname = Input::post('lastname');
            $email = Input::post('email');
            $phone_num = Input::post('phone_num');
            $height = Input::post('height');
            $weight = Input::post('weight');
            $dob = Input::post('dob');
        
            $patient = new Patient(NULL, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight);
            echo $patient->saveToDB($conn);

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add patients</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
</head>
<body>
    <div class="grid">
        <div class = "logo">
            <img class = "lago" src="assets/images/newgate.svg" alt="">
        </div>

        
        <div class = "profile">adsdas</div>


        <div class = "navbar"></div>


        <div class = "stuff">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="text" name="firstname" placeholder="firstname" value="<?php echo Input::htmlpost('firstname');?>" required><br>
                <input type="text" name="lastname" placeholder="lastname" value="<?php echo Input::htmlpost('lastname');?>" required><br>
                <input type="email" name="email" placeholder="email" value="<?php echo Input::htmlpost('email');?>"><br>
                <input type="text" name="phone_num" placeholder="phone num" value="<?php echo Input::htmlpost('phone_num');?>"><br>
                <input type="date" name="dob" placeholder="date of birth" value="<?php echo Input::htmlpost('dob');?>" required><br>
                <input type="number" name="height" placeholder="height" value="<?php echo Input::htmlpost('height');?>"><br>
                <input type="number" name="weight" placeholder="weight" value="<?php echo Input::htmlpost('weight');?>"><br>
                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </div>
</body>
</html>