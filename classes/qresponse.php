<?php
    class QResponse{
        function __construct($ID, $userID, $qID, $response){
            $this->ID =$ID;
            $this->userID = $userID;
            $this->qID = $qID;
            $this->response = $response;
        }
        

        static function getResponseByID($conn, $userID, $qID){
            $stmt = $conn->prepare("SELECT * FROM tbl_user_questionnaires WHERE userID = :userID AND questionnaireID = :qID");
            $data = array('userID'=> $userID, 'qID'=>$qID);
            $stmt->execute($data);
            if($q = $stmt->fetch(PDO::FETCH_ASSOC)){
                $quest = new QResponse($q["ID"], $q["userID"], $q["questionnaireID"], $q['response']);
                return $quest;
            }
            return null;
            
        }
        
    }
?>