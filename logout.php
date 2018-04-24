<?php
    session_destroy();
    unset($_SESSION);
    header("Location: http://localhost/newgate.ho/login.php");
?>