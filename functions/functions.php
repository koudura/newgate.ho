<?php

    /**
     * AUTH FUNCTIONS
     */
    function isAdmin(){
        return in_array('ADMIN', $_SESSION['role']);
    }

    function isDoctor(){
        return in_array('DOCTOR', $_SESSION['role']);
    }

    function isDoctorOrSupport(){
        return in_array('SUPPORT', $_SESSION['role']) || isDoctor();
    }

    function doUnauthorized(){
        header('Location: /newgate.ho/errors/401.php');
    }
    /**
     * END OF AUTH FUNCTIONS
     */


    function redirect($url){
        header("Location: $url");
    }

    function tpost($var){
        return (isset($_POST[$var])) ? $_POST[$var] : NULL;
    }

?>