<?php

    function isAdmin(){
        return in_array(1, $_SESSION['role']);
    }

    function isDoctor(){
        return in_array(2, $_SESSION['role']);
    }

    function isDoctorOrSupport(){
        return in_array(3, $_SESSION['role']) || in_array(2, $_SESSION['role']);
    }

?>