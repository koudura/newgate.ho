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

$currentP;
if (isset($_GET['id'])) {
    $conn = connect();
    $id = Input::get('id');
    $currentP = Patient::getPatientByID($conn, $id);
    if (!$currentP) {
        exit();
    }
}

if (isset($_POST['submit'])) {

    if (date('Y-m-d') < Input::toMysqlDate(Input::post('dob'))) {
        echo "<script>alert('Invalid Date');</script>";
    } else {
        $conn = connect();
        $stmt = $conn->prepare("INSERT INTO tbl_patients (firstname, lastname, email,phone_num,dob,height,weight) VALUES (:firstname, :lastname, :email, :phone_num, :dob. :height, :weight)");

        $id = Input::post('id');
        $firstname = Input::post('firstname');
        $lastname = Input::post('lastname');
        $email = Input::post('email');
        $phone_num = Input::post('phone_num');
        $height = Input::post('height');
        $weight = Input::post('weight');
        $dob = Input::post('dob');

        $patient = new Patient($id, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight);
        $patient->updateDB($conn);
        redirect("viewpatients.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT patients</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/addpatients.css"/>
</head>
<body>
<div class="grid">
    <div class="logo">
        <a href="../pages/dashboard.php">
            <img class="lago" src="../assets/images/newgate.svg" alt="logo here">
        </a>
    </div>


    <div class="profile">adsdas</div>


    <div class="navbar"></div>


    <div class="stuff text-center">
        <div class="middlegrid">
            <div></div>
            <div class="card">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $currentP->ID; ?>">
                    <input class="inputext addp" type="text" name="firstname" placeholder="firstname"
                           value="<?php echo htmlspecialchars($currentP->firstname); ?>" required><br>
                    <input class="inputext addp" type="text" name="lastname" placeholder="lastname"
                           value="<?php echo htmlspecialchars($currentP->lastname); ?>" required><br>
                    <input class="inputext addp" type="email" name="email" placeholder="email"
                           value="<?php echo htmlspecialchars($currentP->email); ?>" required><br>
                    <input class="inputext addp" type="text" name="phone_num" placeholder="phone num"
                           value="<?php echo htmlspecialchars($currentP->phone_num); ?>" required><br>
                    <input class="inputext addp" type="date" name="dob" placeholder="date of birth"
                           value="<?php echo htmlspecialchars($currentP->dob); ?>" required><br>
                    <input class="inputext addp" type="number" name="height" placeholder="height"
                           value="<?php echo htmlspecialchars($currentP->height); ?>" required><br>
                    <input class="inputext addp" type="number" name="weight" placeholder="weight"
                           value="<?php echo htmlspecialchars($currentP->weight); ?>" required><br>
                    <input class="bodbut addp" type="submit" name="submit" value="submit">
                </form>
            </div>
            <div></div>
        </div>
</body>
</html>