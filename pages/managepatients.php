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

if (isset($_POST['submit'])) {

    if (date('Y-m-d') < Input::toMysqlDate(Input::post('dob'))) {
        echo "<script>alert('Invalid Date');</script>";
    } else {
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
        $patient->saveToDB($conn);

    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/addpatients.css"/>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <title>Manage Patients</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>

        <a href="viewpatients.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="fas fa-wrench"></i>Patients Manager</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
        <a href="../logout.php" class="dash_btn"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </nav>
</section>
<header>
    <div class="search-field">
        <i class="fas fa-search"></i>
        <input type="text" name="" value="">
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
        <div class="card">
            <h3>Patient Report</h3>
            <div class="history_display">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'allergies')"><i class="fas fa-syringe"></i>Allergies</button>
                    <button class="tablinks" onclick="openCity(event, 'sessions')"><i class="fas fa-clock"></i>Sessions</button>
                    <button class="tablinks" onclick="openCity(event, 'contact')"><i class="fas fa-phone"></i>Contact Details</button>
                </div>

                <div id="allergies" class="tabcontent">

                </div>
                <div id="sessions" class="tabcontent">
                    <table id="sess_table" class="genTab">
                        <thead>
                        <tr>
                            <th>
                                Session Ref.No
                            </th>
                            <th>
                                Doctor
                            </th>
                            <th>
                                Start Date
                            </th>
                            <th>
                                End Date
                            </th>
                            <th>
                                No. of Prescription
                            </th>
                            <th>
                                Session Bill(N)
                            </th>
                            <th>
                                Paid Status
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div id="contact" class="tabcontent">
                </div>

                <script>
                    function openCity(evt, Name) {
                        var i, tabcontent, tablinks;
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }
                        tablinks = document.getElementsByClassName("tablinks");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace("active", "");
                        }
                        document.getElementById(Name).style.display = "block";
                        evt.currentTarget.className += "active";
                    }
                </script>
            </div>
        </div>
        <div class="middlegrid">
            <div id="card" class="card">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input class="inputext addp" type="text" name="firstname" placeholder="firstname"
                           value="<?php echo Input::htmlpost('firstname'); ?>" required><br>
                    <input class="inputext addp" type="text" name="lastname" placeholder="lastname"
                           value="<?php echo Input::htmlpost('lastname'); ?>" required><br>
                    <input class="inputext addp" type="email" name="email" placeholder="email"
                           value="<?php echo Input::htmlpost('email'); ?>"><br>
                    <input class="inputext addp" type="text" name="phone_num" placeholder="phone num"
                           value="<?php echo Input::htmlpost('phone_num'); ?>"><br>
                    <input class="inputext addp" type="date" name="dob" placeholder="date of birth"
                           value="<?php echo Input::htmlpost('dob'); ?>" required><br>
                    <input class="inputext addp" type="number" name="height" placeholder="height"
                           value="<?php echo Input::htmlpost('height'); ?>"><br>
                    <input class="inputext addp" type="number" name="weight" placeholder="weight"
                           value="<?php echo Input::htmlpost('weight'); ?>"><br>
                    <input id="submit" class="bodbut addp" type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>