<?php
    class Prescription{
        function __construct($ID, $diagnosis_ID, $name, $dose, $bill){
            $this->ID = $ID;
            $this->diagnosis_ID = $diagnosis_ID;
            $this->name = $name;
            $this->dose = $dose;
            $this->bill = $bill;
        }
        
        static function getPrescriptionFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_prescriptions WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Prescription($ID, $result["diagnosisID"], $result["name"], $result["dose"], $result["bill"]);            
        }
        static function getAllPrescreptionsFromDB($conn, $diagnosis_ID){
            $stmt = $conn->query("SELECT * FROM tbl_prscriptions WHERE diagnosisID = $diagnosis_ID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row[$ID], $diagnosis_ID, $result["name"], $result["dose"], $result["bill"]));
            }
            return $array;            
        }
    }
?>