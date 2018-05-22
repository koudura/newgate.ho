<?php
    class Prescription{
        function __construct($name, $ID, $diagnosis_ID, $dose){
            $this->ID = $ID;
            $this->diagnosis_ID = $diagnosis_ID;
            $this->name = $name;
            $this->dose = $dose;
        }
        
        static function getPrescriptionFromDB($conn, $ID, $diagnosis_ID, $name){
            
        }
        static function getAllPrescreptionsFromDB($conn, $diagnosis_ID, $name){
            
        }
    }
?>