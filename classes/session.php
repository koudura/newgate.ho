<?php
    class Session{
        function __construct($id, $patient_ID, $consultation_bill, $paid){
            $this->ID =$ID;
            $this->patient_ID = $patient_ID;
            $this->consultation_bill = $consultation_bill;
            $this->paid = $paid;
        }
        static function getSessionFromDB($conn, $ID, $patient_ID){

        }
        static function getAllSessionsFromDB($conn, $patient_ID){

        }
        function getTotalBill($conn){
            
        }
    }
?>