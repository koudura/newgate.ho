<?php
    class Diagnosis{
        function __construct($ID, $patient_ID, $diagnosis, $date, $medication){
            $this->ID = $id;
            $this->patient_ID = $patient_ID;
            $this->diagnosis = $diagnosis;
            $this->date = $date;
        }
        static function getDiagnosisFromDB($conn, $ID, $patient_ID){
             
        }
        static function getAllDiagnosisFromDB($conn, $patientID){

        }
    }
?>