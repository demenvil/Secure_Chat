<?php

/**
 * Router Class
 * @author Loick Mahieux
 */
class Router {
    
    /**
     * run router
     */
    public function run() {
        //get url
        $params = Input::getPathInfo();
        //fix bug of first param
        array_shift($params);
        
        //get controller name
        $controllerName = array_shift($params);
        
        //default controller name
        if(empty($controllerName))
            $controllerName = 'home';
        
        //set path controller
        $controller = ROOT . 'app' . DS . 'controllers' . DS . $controllerName . EXT;
        
        //get action name
        $action = array_shift($params);
        
        //default action name
        if(empty($action))
            $action = 'index';
        
        //if controller doesn't exists -> 404 error
        if(!file_exists($controller) || $controllerName == 'errors')
            $this->loadError();
        
        //include controller file
        require $controller;
        
        //set controller class
        $controller = $controllerName . 'Controller';
        //instance of controller
        $controllerInstance = new $controller();
        
        // if action doesn't exists -> 404 error
        if(!method_exists($controllerInstance, $action))
            $this->loadError();
        
        
        //set params
        $controllerInstance->setParams($params);
        
        //call action of controller
        $controllerInstance->$action();
        
    }
    
    /**
     * load error page
     * @param string $err error name
     */    
    public function loadError($err = '404') {
        //set path of error controller
        require ROOT . 'app' . DS . 'controllers' . DS . 'errors' . EXT;
        //instance of controller
        $controller = new errorsController();
        //set action of controller
        $action = 'err' . $err;
        
        //if action doesn't exists -> 404 error
        if(!method_exists($controller, $action))
            $action = 'err404';
        
        //call error page
        $controller->$action();
        //stop at the error
        die();
    }
}