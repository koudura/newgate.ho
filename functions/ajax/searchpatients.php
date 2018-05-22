<?php
    require_once("../conn.php");
    require_once("../functions.php");
    require_once("../../classes/patient.php");

    
    $conn = connect();

    $idcond = Input::post('id', NULL);
    $fnamecond = Input::post('name', NULL);
    $lnamecond = Input::post('name', NULL);
    $emailcond = Input::post('email', NULL);
    
    $patients = array();
    if ($idcond){
        $patient = Patient::getPatientByID($conn, $idcond);
        if ($patient){
            array_push($patients, $patient);
        }
    }else{
        
    }

?>