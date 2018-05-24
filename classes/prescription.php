<?php
    class Prescription{
        function __construct($ID, $diagnosisID, $name, $dosage, $bill){
            $this->ID = $ID;
            $this->diagnosisID = $diagnosisID;
            $this->name = $name;
            $this->dosage = $dosage;
            $this->bill = $bill;
        }
        
        function saveToDB($conn){
            $query = "INSERT INTO tbl_prescriptions(ID, diagnosisID, name, dosage, bill) VALUES(:ID, :diagnosisID, :name, :dosage, :bill)";
            $stmt = $conn->prepare($query);
            $stmt->execute(array('ID'=>null, 'diagnosisID'=>$this->diagnosisID, 'name'=>$this->name, 'dosage'=>$this->dosage, 'bill'=>$this->bill));
        }

        static function getPrescriptionFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_prescriptions WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Prescription($ID, $result["diagnosisID"], $result["name"], $result["dosage"], $result["bill"]);            
        }

        static function getPrescriptionsFromDiagnosis($conn, $diagnosisID){
            $stmt = $conn->query("SELECT * FROM tbl_prescriptions WHERE diagnosisID = $diagnosisID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row[$ID], $diagnosisID, $result["name"], $result["dosage"], $result["bill"]));
            }
            return $array;            
        }

        static function getAllPrescriptionsFromDB($conn, $diagnosisID){
            $stmt = $conn->query("SELECT * FROM tbl_prescriptions WHERE diagnosisID = $diagnosisID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row[$ID], $diagnosisID, $result["name"], $result["dosage"], $result["bill"]));
            }
            return $array;            
        }
    }
?>