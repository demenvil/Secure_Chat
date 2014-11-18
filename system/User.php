<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * User is used to get informations about an user (because Message can't do it)
 *
 * @author Thomas
 */
class User {
    
    private static $model;
     
    private static $post;
     
    public static function loadModel($name) {

        $name = strtolower($name);
        $modelClass = $name . 'Model';
        $model = ROOT . 'app' . DS . 'models' . DS . $name . EXT;
        
        if(file_exists($model)) {
            require_once $model;
            self::$model = new $modelClass();
        }
    }
    
    public static function getUserByName($username){
        self::loadModel('users');
        return self::$model->getUserByName($username);
    }
}
