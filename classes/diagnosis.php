<?php
    class Diagnosis{
        function __construct($id, $condition, $date, $medication){
            $this->id = $id;
            $this->condition = $condition;
            $this->date = $date;
            $this->medication = $medication;
        }
        static function getDiagnosisFromDB($conn, $id){
             
        }
    }
?>