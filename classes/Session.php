<?php

class Session {

    public static function init() {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
    }
    
    
    public static function set($key,$value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key) {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return FALSE;
        }
    }
    
    
    public static function destroy() {
        session_destroy();
        session_unset();
        header('location: login.php');
    }
    
    
    
    public static function chkSession(){
        self::init();
        if(self::get("login") == FALSE){
            self::destroy();
        }
        
    }
    
     public static function chkLogin(){
        self::init();
        if(self::get("login") == TRUE){
            header('location: index.php');
        }
        
    }

}

?>