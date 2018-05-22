<?php
    require_once("../conn.php");
    require_once("../functions.php");
    require_once("../../classes/patient.php");

    
    $conn = connect();

    $idcond = Input::post('id', NULL);
    $namecond = Input::post('name', NULL);
    $emailcond = Input::post('email', NULL);
    
    $patients = array();
    if ($idcond){
        $patient = Patient::getPatientByID($conn, $idcond);
        if ($patient){
            array_push($patients, $patient);
        }
        echo json_encode($patients);
    }else{
        $patients = Patient::getPatientsByNameAndEmail($conn, $namecond, $emailcond);
        echo json_encode($patients);
    }
  
?>