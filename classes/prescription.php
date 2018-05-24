<?php
    class Prescription{
        function __construct($ID, $diagnosisID, $patientID, $name, $dosage, $bill){
            $this->ID = $ID;
            $this->diagnosisID = $diagnosisID;
            $this->patientID = $patientID;
            $this->name = $name;
            $this->dosage = $dosage;
            $this->bill = $bill;
        }
        
        function saveToDB($conn){
            $query = "INSERT INTO tbl_prescriptions(ID, diagnosisID, patientID, name, dosage, bill) VALUES(:ID, :diagnosisID, :patientID, :name, :dosage, :bill)";
            $stmt = $conn->prepare($query);
            $stmt->execute(array('ID'=>null, 'diagnosisID'=>$this->diagnosisID, 'patientID'=>$this->patientID, 'name'=>$this->name, 'dosage'=>$this->dosage, 'bill'=>$this->bill));
        }

        static function getPrescriptionFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_prescriptions WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Prescription($ID, $result["diagnosisID"], $result["patientID"], $result["name"], $result["dosage"], $result["bill"]);            
        }

        static function getPrescriptionsFromDiagnosis($conn, $diagnosisID){
            $stmt = $conn->query("SELECT * FROM tbl_prescriptions WHERE diagnosisID = $diagnosisID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row["ID"], $diagnosisID, $result["patientID"], $result["name"], $result["dosage"], $result["bill"]));
            }
            return $array;            
        }

        static function getAllPrescriptionsFromDB($conn){
            $stmt = $conn->query("SELECT * FROM tbl_prescriptions");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Prescription($row["ID"], $row["diagnosisID"], $row["patientID"], $row["name"], $result["dosage"], $row["bill"]));
            }
            return $array;            
        }
    }
?>