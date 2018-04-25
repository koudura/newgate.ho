<?php

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
?>