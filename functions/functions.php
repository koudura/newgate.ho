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
        exit();
    }

    function getCurrentUserOrDie(){
        if(!isset($_SESSION['user'])){
            doUnauthorized();
        }else{
            return $_SESSION['user'];
        }
    }
    /**
     * END OF AUTH FUNCTIONS
     */


    function redirect($url){
        header("Location: $url");
    }

    class Input{
        static function post($var, $default = NULL){
            if( isset($_POST[$var])){
                $res = $_POST[$var];
                if(trim($res)){
                    return $res;
                }else{
                    return $default;
                }
            }else{
                return $default;
            }
        }

        static function get($var, $default = NULL){
            if( isset($_GET[$var])){
                $res = $_GET[$var];
                if(trim($res)){
                    return $res;
                }else{
                    return $default;
                }
            }else{
                return $default;
            }
        }
        

        static function htmlpost($var, $default = NULL){
            if( isset($_POST[$var])){
                $res = $_POST[$var];
                if(trim($res)){
                    return htmlspecialchars($res);
                }else{
                    return $default;
                }
            }else{
                return $default;
            }
        }

        static function htmlget($var, $default = NULL){
            if( isset($_GET[$var])){
                $res = $_GET[$var];
                if(trim($res)){
                    return htmlspecialchars($res);
                }else{
                    return $default;
                }
            }else{
                return $default;
            }
        }


        static function toMysqlDate($datestr){
            return date('Y-m-d', strtotime($datestr));
        }

    }

?>