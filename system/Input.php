<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Input
 *
 * @author loick
 */
class Input {
    /**
     * get path info
     * @return array path info
     */
    public static function getPathInfo() {
        return isset($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : array();
    }
    /**
     * get $_POST
     * @return array
     */
    public static function post($key) {        
        return isset($_POST[$key]) ? strip_tags($_POST[$key]) : NULL;
    }
}
