<?php
    class Diagnosis{
        function __construct($ID, $session_ID, $diagnosis, $date, $medication){
            $this->ID = $id;
            $this->session_ID = $session_ID;
            $this->diagnosis = $diagnosis;
            $this->date = $date;
        }
        static function getDiagnosisFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_diagnosis WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Diagnosis($ID, $result["sessionID"], $result["diagnosis"], $result["date"], $result["medication"]);             
        }
        static function getAllDiagnosisFromDB($conn, $session_ID){
            $stmt = $conn->query("SELECT * FROM tbl_diagnosis WHERE sessionID = $session_ID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Diagnosis($row["ID"], $session_ID, $row["diagnosis"], $result["date"], $result["medication"]));
            }
            return $array;
        }
    }
?>