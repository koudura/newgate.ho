<?php
    class Prescription{
        function __construct($name, $desc, $dose){
            $this->name = $name;
            $this->desc = $desc;
            $this->dose = $dose;
        }
        
        static function getPrescFromDB($conn, $diagnosis, $name){
            
        }
    }
?>