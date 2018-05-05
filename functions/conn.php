<?php
function connect(){
    $hostname = 'localhost';
    $username = 'root';
    $pwd = '';
    $db = 'db_newgate';

    try{
        $conn = new PDO("mysql:host=$hostname;dbname=$db", $username, $pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $ex){
        file_put_contents("PDOERRORS.TXT", $ex->getMessage(), FILE_APPEND);
    }
    return $conn;
}
?>