<?php
class Patient {
    public $id, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight;
    function __construct($id, $email, $firstname, $lastname, $phone_num, $dob, $height, $weight){
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone_num = $phone_num;
        $this->dob = $dob;
        $this->height = $height;
        $this->weight = $weight;
    }

    function saveToDB($conn){
        $query = "INSERT INTO tbl_patients(ID, email, firstname, lastname, phone_num, dob, height, weight) VALUES(null, '$this->email', '$this->firstname', '$this->lastname', '$this->phone_num', '$this->dob', '$this->height', '$this->weight')";
        if($conn->exec($query)){
            return TRUE;
        }
    }

    static function getPatient($conn, $stmt, $data){
        $stmt->execute($data);
        if( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){        
            $id = $result["ID"];
            return new Patient($id, $result["email"], $result["firstname"], $result["lastname"], $result["phone_num"], $result['dob'], $result['height'], $result['weight']);
        }
        return null;     
    }

    static function getPatientByID($conn, $id){
        $stmt = $conn->prepare("SELECT * FROM tbl_patients WHERE id = :id");
        $data = array("id"=> $id);
        return self::getPatient($conn, $stmt, $data);
    }

    static function getPatientsByName($conn, $id){
        $stmt = $conn->prepare("SELECT * FROM tbl_patients WHERE firstname LIKE ");
        $data = array("id"=> $id);
        return self::getPatient($conn, $stmt, $data);
    }

    static function getAllPatients($conn){
        $users = array();
        $stmt = $conn->query("SELECT * FROM tbl_users");
        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
        foreach($results as $result){        
            $id = $result["ID"];
            $stmt = $conn->query("SELECT role FROM tbl_roles WHERE userID = $id");
            $result2 = $stmt->fetchall(PDO::FETCH_ASSOC);
            $rolearray = array();
            foreach ($result2 as $row) {
                array_push($rolearray,$row["role"]);
            }
            $user = new User($id, $result["email"], $result["firstname"], $result["lastname"], $result["phone_num"], $rolearray);
            array_push($users, $user);
        }
        return $users; 

    }

}