<?php
    require_once('../functions/conn.php');
    require_once('../functions/functions.php');
    require_once("../classes/user.php");
    require_once("../classes/patient.php");
    require_once("../classes/diagnosis.php");
    require_once("../classes/allergy.php");
    require_once("../classes/prescription.php");

    session_start();
    $conn = connect();


    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();
    }

    $currentP;
    if(isset($_GET['ID'])){
        $conn = connect();
        $id = Input::get('ID');
        $currentP = Patient::getPatientByID($conn,$id);
        if(!$currentP){
            exit();
        }
        
    }




    if (isset($_POST['submitinfo'])) {

        if (date('Y-m-d') < Input::toMysqlDate(Input::post('dob'))) {
            echo "<script>alert('Invalid Date');</script>";
        } else {
            $conn = connect();
            $id = Input::post('pID');
            $currentP = Patient::getPatientByID($conn,$id);
            $firstname = Input::post('firstname');
            $lastname = Input::post('lastname');
            $email = Input::post('email');
            $phone_num = Input::post('phone_num');
            $height = Input::post('height');
            $weight = Input::post('weight');
            $dob = Input::post('dob');
        
            $patient = new Patient($id, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight);
            $patient->updateDB($conn);
            // redirect("viewpatients.php");

        }
    }

    if (isset($_POST['submitallergy'])) {

        $id = Input::post('pID');
        $currentP = Patient::getPatientByID($conn,$id);
        $desc = Input::post('desc');
        $allergy = new Allergy(null,$id,$desc);
        $allergy->saveToDB($conn);
        // redirect("viewpatients.php");   
    }

    if (isset($_POST['submitdiag'])) {
        $id = Input::post('pID');
        $currentP = Patient::getPatientByID($conn,$id);
        $sess = Session::getLast($conn);
        $sessid = $sess->ID;
        $now = date('Y-m-d');
        $diagnosis = Input::post('diagnosis');
        $diag = new Diagnosis(null,$sessid,$diagnosis, $now);
        $diag->saveToDB($conn);
        // redirect("viewpatients.php");   
    }

    if (isset($_POST['submitprescript'])) {        
        $id = Input::post('pID');
        $currentP = Patient::getPatientByID($conn,$id);
        $name = Input::post('name');
        $dosage = Input::post('dosage');
        $diagID = Input::post('diagnosisID');
        $bill = Input::post('bill');
        $pres = new Prescription(null,$diagID,$name, $dosage, $bill);
        $pres->saveToDB($conn);
        // redirect("viewpatients.php");   
    }

    

    if (isset($_POST['paid'])) {        
        $id = Input::post('pID');
        $currentP = Patient::getPatientByID($conn,$id);
        $paid = Input::post('paid'); 
        $sess = Session::getLast($conn);
        $sess->paid = ($paid=="Paid")?1:0;
        $sess->updatePaid($conn);
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
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/managepatients.css"/>

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
        <div id="header-tab" >
            <h3><?php
            $conn = Connect();
            $sess = SESSION::getLast($conn);
            $name = $sess->getDoctorName($conn);
            $status = ($sess->paid)?"PAID":"PENDING";
            echo "<p class='emp'>SESSION</p> #".$sess->ID."    <p class='emp'>IN-CHARGE</p>: ".$name."  <p class='emp'>TOTAL BILL</p>: N ".$sess->getTotalBill($conn)." <p class='emp'>PAYMENT</p>: ".$status;
            ?>
            </h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="pID" value="<?php echo $currentP->ID;?>">
                <input class="bodbut" type='submit' name="paid" value="Paid" />
                <input class="bodbut" type='submit' name="paid" value="Pending" />
            </form
        </div>
        <div class="card">
            <div class="history_display">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'info')"><i class="fas fa-info"></i>Info</button>
                    <button class="tablinks " onclick="openCity(event, 'diagnosis')"><i class="fas fa-diagnoses"></i>Diagnosis</button>
                    <button class="tablinks " onclick="openCity(event, 'prescription')"><i class="fas fa-syringe"></i>Prescription</button>
                    <button class="tablinks " onclick="openCity(event, 'allergies')"><i class="fas fa-allergies"></i>Allergies</button>
                </div>

                <div id="allergies" class="tabcontent">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <input class="inputext addp" type="hidden" name="pID" value="<?php echo $currentP->ID; ?>" required><br>
                        <input class="inputext addp" type="text" name="desc" placeholder="Description" required><br>
                        <input class="bodbut addp" type="submit" name="submitallergy" value="submit">
                    </form>   
                </div>
                <div id="info" class="tabcontent">                    
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="pID" value="<?php echo $currentP->ID;?>">
                                <input class="inputext addp" type="text" name="firstname" placeholder="firstname"
                                    value="<?php echo htmlspecialchars($currentP->firstname); ?>" required><br>
                                <input class="inputext addp" type="text" name="lastname" placeholder="lastname"
                                    value="<?php echo htmlspecialchars($currentP->lastname); ?>" required><br>
                                <input class="inputext addp" type="email" name="email" placeholder="email"
                                    value="<?php echo htmlspecialchars($currentP->email); ?>"><br>
                                <input class="inputext addp" type="text" name="phone_num" placeholder="phone num"
                                    value="<?php echo htmlspecialchars($currentP->phone_num); ?>"><br>
                                <input class="inputext addp" type="date" name="dob" placeholder="date of birth"
                                    value="<?php echo htmlspecialchars($currentP->dob); ?>" required><br>
                                <input class="inputext addp" type="number" name="height" placeholder="height"
                                    value="<?php echo htmlspecialchars($currentP->height); ?>"><br>
                                <input class="inputext addp" type="number" name="weight" placeholder="weight"
                                    value="<?php echo htmlspecialchars($currentP->weight); ?>"><br>
                                <input id="submit_info" class="bodbut addp" type="submit" name="submitinfo" value="submit">
                            </form>
                </div>

                <div id="diagnosis" class="tabcontent">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="pID" value="<?php echo $currentP->ID;?>">
                        <input class="inputext addp" type="text" name="diagnosis" placeholder="diagnosis"
                            value="" required><br>
                        <input id="add_diag" class="bodbut addp" type="submit" name="submitdiag" value="Add">
                    </form>
                    
                </div>

                <div id="prescription" class="tabcontent">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="pID" value="<?php echo $currentP->ID;?>">
                                <input class="inputext addp" type="text" name="name" placeholder="prescription"
                                    value="" required><br>
                                <input class="inputext addp" type="text" name="dosage" placeholder="dosage"
                                    value="<?php echo Input::htmlpost('dosage'); ?>" required><br>
                                <input class="inputext addp" type="number" name="bill" placeholder="Bill"
                                    value="<?php echo Input::htmlpost('bill'); ?>" required><br>
                                <select class="inputext addp" name="diagnosisID" required>
                                    <?php
                                        $conn = connect();
                                        $lastSess = Session::getLast($conn);
                                        $sessID = $lastSess->ID;
                                        $diags = Diagnosis::getDiagnosisFromSession($conn, $sessID);
                                        foreach ($diags as $diag){
                                            echo "<option value=".$diag->ID.">".$diag->diagnosis."</option>";
                                        }
                                    ?>
                                </select><br>
                                <input id="add_presc" class="bodbut addp" type="submit" name="submitprescript" value="Add Prescription">
                            </form>
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
    </div>
</section>
</body>
</html>