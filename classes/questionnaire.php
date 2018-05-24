<?php
    class Questionnaire{
        function __construct($ID, $title, $jsonQ){
            $this->ID =$ID;
            $this->title = $title;
            $this->jsonQ = $jsonQ;
        }
        function saveToDB($conn){
            $stmt = $conn->prepare("INSERT INTO tbl_questionnaires(ID, title, jsonQ) VALUES(:ID, :title, :jsonQ)");
            $data = array('ID'=>$this->ID, 'title'=>$this->title, 'jsonQ'=>$this->jsonQ);
            $stmt->execute($data);
        }
        function updateDB($conn){
            $stmt = $conn->prepare("UPDATE tbl_questionnaires SET title=:title, jsonQ=:jsonQ WHERE ID=:ID");
            $data = array('ID'=>$this->ID, 'title'=>$this->title, 'jsonQ'=>$this->jsonQ);
            $stmt->execute($data);
        }

        function deleteDB($conn){
            $stmt = $conn->prepare("DELETE FROM `tbl_questionnaires` WHERE ID=:ID");
            $data = array('ID'=>$this->ID);
            $stmt->execute($data);
        }

        function filledByUser($conn, $userID){
            $stmt = $conn->prepare("SELECT * FROM tbl_user_questionnaires WHERE userID = :userID AND questionnaireID = :qID");
            $data = array('userID'=> $userID, 'qID'=>$this->ID);
            $stmt->execute($data);
            $result = $stmt;
            $bool = FALSE;
            if($row = $stmt->fetch()){
                $bool = TRUE;
            }
            return $bool;
        }

        function fillByUser($conn, $userID, $response){
            $stmt = $conn->prepare("INSERT INTO tbl_user_questionnaires (ID, userID, questionnaireID, response ) VALUES (NULL, :userID, :qID, :response)");
            $data = array('userID'=> $userID, 'qID'=>$this->ID, 'response'=>$response);
            $stmt->execute($data);
        }

        // static function questionnaireFilledByUser($conn, $userID){
        //     $stmt = $conn->prepare("SELECT * FROM tbl_user_questionnaires WHERE userID = :userID AND questionnaireID = :qID");
        //     $data = array('userID'=> $userID, 'qID'=>$this->ID);
        //     $result = $stmt->execute($data);
        //     $bool = FALSE;
        //     if($row = $result->fetch()){
        //         $bool = TRUE;
        //     }
        //     return $bool;
        // }

        static function getAll($conn){
            $stmt = $conn->query("SELECT * FROM tbl_questionnaires");
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $quests =array();
            foreach ($result as $q) {
                $quest = new Questionnaire($q["ID"], $q["title"], $q["jsonQ"]);
                array_push($quests, $quest);
            }
            return $quests;
        }

        static function getByID($conn, $id){
            $stmt = $conn->prepare("SELECT * FROM tbl_questionnaires WHERE ID = :ID");
            $data = array('ID'=>$id);
            $stmt->execute($data);
            if($q = $stmt->fetch(PDO::FETCH_ASSOC)){
                $quest = new Questionnaire($q["ID"], $q["title"], $q["jsonQ"]);
                return $quest;
            }
            return null;
        }
        
    }
?>