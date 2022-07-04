<?php
    function escape($html){
        return htmlspecialchars($html,ENT_QUOTES | ENT_SUBSTITUTE,"UTF-8");
    }
    function csrf(){
        session_start();

        if (empty(($_SESSION['csrf']))){
            if (function_exists('random_bytes')){
                $_SESSION['csrf']= bin2hex(\Sodium\randombytes_buf(32));
            }else if(function_exists('mycrypt_create_iv')){
                $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32,MCRYPT_DEV_URANDOM));
            }else{
                $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32,MCRYPT_DEV_URANDOM));

            }
        }
    }
?>