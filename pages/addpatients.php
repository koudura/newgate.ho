<?php
    require_once('../functions/conn.php');
    require_once('../functions/functions.php');
    require_once("../classes/user.php");
    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();      
    }

    if (isset($_POST['submit'])  && (date('m/d/Y') <= date($_POST['dob']) )  ){
        
        $conn = connect();
        $stmt = $conn->prepare("INSERT INTO tbl_patients (firstname, lastname, email,phone_num,dob,height,weight) VALUES (:firstname, :lastname, :email, :phone_num, :dob. :height, :weight)");
        $data = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone_num' => $_POST['phone_num'],
            'height' => $_POST['height'],
            'weight' => $_POST['weight'],
            'dob' => $_POST['dob']
        );

        if($stmt->execute($data)){
            header('Location: /newgate.ho/pages/viewpatients.php');
        }

    }

    $d1 = date('d/m/Y');
    $d2 = date('5/21/2018');
    echo $d1. "----". $d2;
    echo $d1 > $d2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add patients</title>
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="lastname" placeholder="lastname">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="phone_num" placeholder="phone num">
        <input type="date" name="dob" placeholder="date of birth">
        <input type="number" name="height" placeholder="height">
        <input type="submit" name="submit" value="submit">
    </form>

</body>
</html>