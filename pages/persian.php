<?php
    require_once('../functions/conn.php');
    require_once('../functions/functions.php');
    require_once("../classes/user.php");
    require_once("../classes/patient.php");
    require_once("../classes/allergy.php");
    require_once("../classes/session.php");
    require_once("../classes/diagnosis.php");

    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isDoctor() && $current_user->isSupport()) {
        doUnauthorized();      
    }

    $currentP;
    $allergies;
    $sessions;
    if(isset($_GET['id'])){
        $conn = connect();
        $id = Input::get('id');
        $currentP = Patient::getPatientByID($conn,$id);
        if(!$currentP){
            exit();
        }
        $allergies = Allergy::getAllergyFromPatient($conn,$currentP->ID);
        $sessions = Session::getSessionFromPatient($conn, $currentP->ID);

    }

    if (isset($_POST['submit'])){
        
        if ( date('Y-m-d') < Input::toMysqlDate(Input::post('dob')) ){
            echo "<script>alert('Invalid Date');</script>";
        }else{
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
        <div class = "logo">
           <a href="/newgate.ho/pages/dashboard.php">
                <img class = "lago" src="../assets/images/newgate.svg" alt="logo here">
            </a>
        </div>

        
        <div class = "profile">adsdas</div>


        <div class = "navbar"></div>

        <div class = "stuff text-center">
            <div class = "middlegrid">   
                <div></div>
                <div class = "card">            
                    <input type="hidden" name="id" value="<?php echo $currentP->ID;?>">
                    <h3>Name : <?php echo htmlspecialchars($currentP->firstname)." ".htmlspecialchars($currentP->lastname);?> </h3>
                    <h3>Email: <?php echo htmlspecialchars($currentP->email);?></h3>
                    <h3>Phone: <?php echo htmlspecialchars($currentP->phone_num);?></h3>
                    <h3>Date of Birth: <?php echo htmlspecialchars($currentP->dob);?></h3>
                    <h3>Height:  <?php echo htmlspecialchars($currentP->height);?></h3>
                    <h3>Weight: <?php echo htmlspecialchars($currentP->weight);?></h3>
                </div>  
                <div></div>
        </div>
        
        
        <div class = "stuff text-center">
            <div class = "middlegrid">   
                <div></div>
                <div class = "card">
                    <h2>Allergies</h2>
                    <a href="allergy/addallergies.php?ID=<?php ?>">Add Allergy</a>
                    <?php if($allergies){ ?>
                    <table class="genTab">
                        <thead>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php foreach($allergies as $allergy){
                            echo <<<_END
                            <tr>
                            <td>$allergy->desc</td>
                            <td><a href="allergy/editallergies.php?ID=$allergy->ID">EDIT</a></td>
                            </tr>
_END;

                        }?>


                        </tbody>
                    </table>  
                    <?php }else{
                        echo "<h3>None</h3>";
                    }?>         
                    
                </div>  
                <div></div>
            </div>
        </div> 
        

        <div class = "stuff text-center">
            <div class = "middlegrid">   
                <div></div>
                <div class = "card">
                    <h2>Sessions</h2>
                    <a href="addsession.php">Add Session</a>
                    <?php if($sessions){ ?>
                    <table class="genTab">
                        <thead>
                            <th>Consultation Bill</th>
                            <th>Start Date</th>
                            <th>Paid</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php foreach($sessions as $session){
                            $last = ($sessions[count($sessions)-1] == $session)? '<a href="editsessions.php?ID=$session->ID">EDIT</a>  <button onclick="sessview($session->ID)">VIEW</button> ':'<button onclick="sessview($session->ID)">VIEW</button>';
                            echo <<<_END
                            <tr>
                            <td>$session->consultation_bill</td>
                            <td>$session->startdate</td>
                            <td>$session->paid</td>
                            <td>$last</td>
                            </tr>
_END;

                        }?>


                        </tbody>
                    </table>  
                    <?php }else{
                        echo "<h3>None</h3>";
                    }?>         
                    
                </div>  
                <div></div>
            </div>
        </div> 


        <div class = "stuff text-center">
            <div class = "middlegrid">   
                <div></div>
                <div class = "card">            
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $currentP->ID;?>">
                        <input class="inputext addp" type="text" name="firstname" placeholder="firstname" value="<?php echo htmlspecialchars($currentP->firstname);?>" required><br>
                        <input class="inputext addp" type="text" name="lastname" placeholder="lastname" value="<?php echo htmlspecialchars($currentP->lastname);?>" required><br>
                        <input class="inputext addp" type="email" name="email" placeholder="email" value="<?php echo htmlspecialchars($currentP->email);?>"><br>
                        <input class="inputext addp" type="text" name="phone_num" placeholder="phone num" value="<?php echo htmlspecialchars($currentP->phone_num);?>"><br>
                        <input class="inputext addp" type="date" name="dob" placeholder="date of birth" value="<?php echo htmlspecialchars($currentP->dob);?>" required><br>
                        <input class="inputext addp" type="number" name="height" placeholder="height" value="<?php echo htmlspecialchars($currentP->height);?>"><br>
                        <input class="inputext addp" type="number" name="weight" placeholder="weight" value="<?php echo htmlspecialchars($currentP->weight);?>"><br>
                        <input class="bodbut addp" type="submit" name="submit" value="submit">
                    </form>   
                </div>  
                <div></div>
        </div> 


    </div>

    <script src="../../../../../../xampp/htdocs/newgate.ho/assets/js/ajax.js"></script>
    <script>

    function sessionLoad(){

    }

    
    </script>
</body>
</html>