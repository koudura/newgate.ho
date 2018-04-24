<?php
    require_once("../functions/functions.php");
    session_start();
    if (!isset($_SESSION["ID"]) || !isAdmin()){
        doUnauthorized();        
    }

?>