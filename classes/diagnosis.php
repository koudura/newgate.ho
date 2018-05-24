<?php
    class Diagnosis{
        function __construct($ID, $sessionID, $diagnosis, $date){
            $this->ID = $ID;
            $this->sessionID = $sessionID;
            $this->diagnosis = $diagnosis;
            $this->date = $date;
        }

        function saveToDB($conn){
            $query = "INSERT INTO tbl_diagnosis(ID, sessionID, diagnosis, date) VALUES(:ID, :sessionID, :diagnosis, :ddate)";
            $stmt = $conn->prepare($query);
            $stmt->execute(array('ID'=>null, 'sessionID'=>$this->sessionID, 'diagnosis'=>$this->diagnosis, 'ddate'=>$this->date));
        }

        static function getDiagnosisFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_diagnosis WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Diagnosis($ID, $result["sessionID"], $result["diagnosis"], $result["ddate"]);             
        }


        static function getDiagnosisFromSession($conn, $sessionID){
            $query = "SELECT * FROM tbl_diagnosis WHERE sessionID=$sessionID";
            $stmt = $conn->query($query);
            $diagnoses = array();
            if($rows = $stmt->fetchall(PDO::FETCH_ASSOC)){
                foreach($rows as $result){
                    array_push($diagnoses, new Diagnosis($result['ID'], $result["sessionID"], $result["diagnosis"], $result["ddate"]));
                }
            }
            return $diagnoses;
        }

        static function getAllDiagnosisFromDB($conn){
            $stmt = $conn->query("SELECT * FROM tbl_diagnosis WHERE sessionID = $sessionID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Diagnosis($row["ID"], $sessionID, $row["diagnosis"], $row["ddate"]));
            }
            return $array;
        }
    }
?>