<?php
    class Allergy{
        function __construct($ID, $patient_ID, $name, $desc){
            $this->ID = $ID;
            $this->patient_ID = $patient_ID;
            $this->name = $name;
            $this->desc = $desc;
        }
        static function getAllergyFromDB($conn, $ID, $patient_ID){
            
        }
        static function getAllAllergies($conn, $patient_ID){

        }
    }
?>