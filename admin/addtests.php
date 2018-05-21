<?php
    require_once("../functions/functions.php");
    session_start();
    if (!isset($_SESSION["user"]) || !isAdmin()){
        doUnauthorized();        
    }

?>