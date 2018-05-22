<?php
    class Session{
        function __construct($ID, $patient_ID, $consultation_bill, $paid){
            $this->ID =$ID;
            $this->patient_ID = $patient_ID;
            $this->consultation_bill = $consultation_bill;
            $this->paid = $paid;
        }
        static function getSessionFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_session WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Session($ID, $result["patientID"], $result["consultation_bill"], $result["paid"]);
        }
        static function getAllSessionsFromDB($conn, $patient_ID){
            $stmt = $conn->query("SELECT * FROM tbl_sessions WHERE sessionID = $session_ID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Session($row["ID"], $patient_ID, $row["consultation_bill"], $result["paid"]));
            }
            return $array;

        }
        function getTotalBill($conn){
            $query = "SELECT ID FROM tbl_diagnosis WHERE sessionID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $bill = 0;
            foreach ($result as $row) {
                $diagnosisID = $row["ID"];
                $query = "SELECT * FROM tbl_prescriptions WHERE diagnosisID=$ID";
                $stmt = $conn->query($query);
                $result2 = $stmt->fetchall(PDO::FETCH_ASSOC);
                $array = array();
                foreach ($result2 as $row2) {
                    $bill += row2["bill"];
                }
            }
            
        }
        function getDiagnosis($conn){
            $query = "SELECT * FROM tbl_diagnosis WHERE sessionID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Diagnosis($row["ID"], $ID, $row["diagnosis"], $result["date"], $result["medication"]));
            }
            return $array;

        }
    }
?>