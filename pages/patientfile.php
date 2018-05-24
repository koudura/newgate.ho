<?php
require_once('../functions/conn.php');
require_once('../functions/functions.php');
require_once("../classes/user.php");
require_once("../classes/patient.php");
require_once("../classes/allergy.php");
require_once("../classes/session.php");
require_once("../classes/diagnosis.php");

session_start();
$conn = connect();

$current_user = getCurrentUserOrDie();
if (!$current_user->isDoctor() && $current_user->isSupport()) {
    doUnauthorized();
}

$currentP;
$sessions;
if (isset($_GET['ID'])) {
    $conn = connect();
    $id = Input::get('ID');
    $currentP = Patient::getPatientByID($conn, $id);
    if ($currentP) {
        $sessions = Session::getSessionFromPatient($conn, $id);
    }

}

if (isset($_POST['submitinfo'])) {

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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/report.css"/>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <title>Manage Patients</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewpatients.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="fas fa-user-circle"></i>Patient Report</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
    </nav>
</section>
<header>
    <div class="name-field">
        <H1><?php
            $name = ($current_user->isDoctor()) ? "DR " : "";
            $name .= strtoupper($current_user->firstname) . ", ";
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
<section id="content-area">
    <div class="heading">
        <h1>Patient Report</h1>
        <p>Generate and edit patient report</p>
    </div>
    <div class="cards-r">
        <div class="card-r col-md-4">
            <div class="patient-img"></div>
            <span class="user-name"><?php echo htmlspecialchars($currentP->firstname . " " . $currentP->lastname); ?></span>
            <span class="user-detail">ID <?php echo $currentP->ID; ?></span>
            <hr>
            <div class="col-md-3">
                <span class="height txt">Height</span>
                <span class="height val"><?php echo htmlspecialchars($currentP->height); ?></span>
            </div>
            <div class="col-md-9">
                <span class="weight txt">Weight</span>
                <span class="weight val"><?php echo htmlspecialchars($currentP->weight); ?></span>
            </div>
            <a class="edit_btn" href="managepatients.php?ID=<?php echo $currentP->ID; ?>">EDIT</a>
        </div>
    </div>
    <div class="card-r">
        <h6>Report Analysis</h6>
        <div class="history_display">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'allergies')"><i class="fas fa-allergies"></i>Allergies
                </button>
                <button class="tablinks" onclick="openCity(event, 'prescription')"><i class="fas fa-syringe"></i>Prescription
                </button>
                <button class="tablinks" onclick="openCity(event, 'diagnose')"><i class="fas fa-diagnoses"></i>Diagnosis
                </button>
                <button class="tablinks active" onclick="openCity(event, 'sessions')"><i class="fas fa-clock"></i>Sessions
                </button>
            </div>

            <div id="allergies" class="tabcontent">
                <table id="allegy_table" class="genTab">
                    <thead>
                    <tr>
                        <th>
                            Description
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div id="prescription" class="tabcontent">
                <table id="allegy_table" class="genTab">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div id="diagnose" class="tabcontent">
                <table id="diag_table" class="genTab">
                    <thead>
                    <tr>
                        <th>
                            Condition
                        </th>
                        <th>
                            Date(Diagnosed)
                        </th>
                        <th>
                            Prescriptions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
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
                            Session Bill(N)
                        </th>
                        <th>
                            Paid Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($sessions as $sess) {
                        $docname = $sess->getDoctorName($conn);
                        $paid = ($sess->paid == 1) ? "TRUE" : "FALSE";
                        echo <<<_END
                                <tr>
                                    <td>
                                        $sess->ID
                                    </td>
                                    <td>
                                        $docname
                                    </td>
                                    <td>
                                        $sess->startdate
                                    </td>
                                    <td>
                                        $sess->consultation_bill
                                    </td>
                                    <td>
                                        $paid
                                    </td>
                                </tr>
_END;
                    }
                    ?>
                    </tbody>
                </table>
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
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(Name).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>
        </div>
    </div>
</section>

</body>
</html>