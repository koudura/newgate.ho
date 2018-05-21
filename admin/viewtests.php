<?php
    require_once("../functions/functions.php");
    require_once("../classes/user.php");
    session_start();
    $current_user = getCurrentUserOrDie();
    if (!$current_user->isAdmin()) {
        doUnauthorized();      
    }

?>