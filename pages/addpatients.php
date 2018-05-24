<?php
require_once('../functions/conn.php');
require_once('../functions/functions.php');
require_once("../classes/user.php");
require_once("../classes/patient.php");

session_start();
$current_user = getCurrentUserOrDie();
if (!$current_user->isDoctor() && !$current_user->isSupport()) {
    doUnauthorized();
}

$conn = connect();
$doctors = User::getDoctors($conn);

if (isset($_POST['submit'])) {

    if (date('Y-m-d') < Input::toMysqlDate(Input::post('dob'))) {
        echo "<script>alert('Invalid Date');</script>";
    } else {
        $conn = connect();
        $stmt = $conn->prepare("INSERT INTO tbl_patients (firstname, lastname, email,phone_num,dob,height,weight) VALUES (:firstname, :lastname, :email, :phone_num, :dob. :height, :weight)");

        $firstname = Input::post('firstname');
        $lastname = Input::post('lastname');
        $email = Input::post('email');
        $phone_num = Input::post('phone_num');
        $height = Input::post('height');
        $weight = Input::post('weight');
        $dob = Input::post('dob');

        $sessbill = Input::post('sessbill');
        $docID = Input::post('docID');
        $patient = new Patient(NULL, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight, $sessbill, $docID);
        $patient->saveToDB($conn);
        redirect('viewpatients.php');

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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/addpatients.css"/>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewpatients.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="fas fa-plus-circle"></i>Add Patient</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
    </nav>
</section>
<header>
    <div class="name-field">
        <H1><?php 
        $name = ($current_user->isDoctor())?"DR ":"";
        $name .= strtoupper($current_user->firstname).", ";
        $name .= strtoupper($current_user->lastname);
        echo $name;
        ?></H1>
    </div>
    <div class="user-field">
        <a href="#"><i class="b far fa-question-circle"></i></a>
        <a href="#" class="notification"><i class="b fas fa-bell"></i><span class="circle">3</span></a>
        <a href="#">
            <div class="user-img"></div>
            <i class="b far fa-user"></i>
        </a>
    </div>
</header>
<section class="main-container">
    <div class="stuff">
        <div class="middlegrid">
            <div></div>
            <div id="card" class="card">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input class="inputext addp" type="text" name="firstname" placeholder="firstname"
                           value="<?php echo Input::htmlpost('firstname'); ?>" required><br>
                    <input class="inputext addp" type="text" name="lastname" placeholder="lastname"
                           value="<?php echo Input::htmlpost('lastname'); ?>" required><br>
                    <input class="inputext addp" type="email" name="email" placeholder="email"
                           value="<?php echo Input::htmlpost('email'); ?>" required><br>
                    <input class="inputext addp" type="text" name="phone_num" placeholder="phone num"
                           value="<?php echo Input::htmlpost('phone_num'); ?>" required><br>
                    <input class="inputext addp" type="date" name="dob" placeholder="date of birth"
                           value="<?php echo Input::htmlpost('dob'); ?>" required><br>
                    <input class="inputext addp" type="number" name="height" placeholder="height"
                           value="<?php echo Input::htmlpost('height'); ?>" required><br>
                    <input class="inputext addp" type="number" name="weight" placeholder="weight"
                           value="<?php echo Input::htmlpost('weight'); ?>" required><br>
                    <input class="inputext addp" type="number" name="sessbill" placeholder="bill"
                           value="<?php echo Input::htmlpost('sessbill'); ?>" required><br>
                    <Label>Doctor:</Label><select name="docID" required>
                        <?php
                            foreach ($doctors as $doc) {
                                echo '<option value="'.$doc->id.'" selected>'.$doc->firstname.' '.$doc->lastname.'</option>';
                            }
                        ?>
                    </select>
                    <input id="submit" class="bodbut addp" type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>