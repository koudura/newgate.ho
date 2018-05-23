<?php
    class Prescription{
        function __construct($ID, $diagnosisID, $name, $dose, $bill){
            $this->ID = $ID;
            $this->diagnosisID = $diagnosisID;
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

        static function getPrescriptionsFromDiagnosis($conn, $diagnosisID){
            $stmt = $conn->query("SELECT * FROM tbl_prscriptions WHERE diagnosisID = $diagnosisID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row[$ID], $diagnosisID, $result["name"], $result["dose"], $result["bill"]));
            }
            return $array;            
        }

        static function getAllPrescreptionsFromDB($conn, $diagnosisID){
            $stmt = $conn->query("SELECT * FROM tbl_prscriptions WHERE diagnosisID = $diagnosisID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row[$ID], $diagnosisID, $result["name"], $result["dose"], $result["bill"]));
            }
            return $array;            
        }
    }
?>