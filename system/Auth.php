<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Thomas
 */
class Auth {
    
    private static $model;


    private static $login;
    private static $password;
    
    public static function loadModel($name) {
        $name = strtolower($name);
        $modelClass = $name . 'Model';
        $model = ROOT . 'app' . DS . 'models' . DS . $name . EXT;
        
        if(file_exists($model)) {
            require $model;
            self::$model = new $modelClass();
        }
    }
    
    public static function connect($login, $password) {
        self::loadModel('users');

        $user = self::$model->getUserConnect($login, $password);
       
        if(!empty($user)){
            $_SESSION['user'] = $user;
            return TRUE;
        }
        
        return FALSE;
    }
    
    public static function isConnected() {
        if(!empty($_SESSION['user']))
            return TRUE;
        return FALSE;
    }
    
    public static function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['idR']);
    }
}
