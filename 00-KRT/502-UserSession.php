<?php

class UserSession{
    public function __construct(){
        session_start();
    }
    public function setCurrentUser($user){
        $_SESSION['usr'] = $user;
    }
    public function getCurrentUser(){
        return $_SESSION['usr'];
    }
    public function closeSession(){
        session_unset();
        session_destroy();
    }
}
?>