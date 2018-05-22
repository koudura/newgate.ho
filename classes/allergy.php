<?php
    class Allergy{
        function __construct($ID, $patient_ID, $name, $desc){
            $this->ID = $ID;
            $this->patient_ID = $patient_ID;
            $this->desc = $desc;
        }
        static function getAllergyFromDB($conn, $ID){
            $query = "SELECT * FROM tbl_allergies WHERE ID=$ID";
            $stmt = $conn->query($query);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            return new Allergy($ID, $result["patientID"], $result["description"]);
        }
        static function getAllAllergies($conn, $patient_ID){
            $stmt = $conn->query("SELECT * FROM tbl_allergies WHERE patientID=$patient_ID");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $array = array();
            foreach ($result as $row) {
                array_push($array, new Allergy($row[$ID], $patient_ID, $row["description"]));
            }
            return $array;
        }
    }
?>