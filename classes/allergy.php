<?php
    class Allergy{
        function __construct($ID, $patientID, $name, $desc){
            $this->ID = $ID;
            $this->patientID = $patientID;
            $this->desc = $desc;
        }
        static function getAllergyFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_allergies WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Allergy($ID, $result["patientID"], $result["description"]);
        }

        static function getAllergyFromPatient($conn, $patientID){
            $stmt = $conn->query("SELECT * FROM tbl_allergies WHERE patientID=$patientID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Allergy($row[$ID], $patientID, $row["description"]));
            }
            return $array;
        }

        static function getAllAllergies($conn, $patientID){
            $stmt = $conn->query("SELECT * FROM tbl_allergies WHERE patientID=$patientID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Allergy($row[$ID], $patientID, $row["description"]));
            }
            return $array;
        }
    }
?>