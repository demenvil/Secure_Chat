<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author loick
 */
class Controller {
    /**
     * the view
     * @var View
     */
    protected $view;
    
    protected $params = array();

    /**
     * load a model
     * @param string $name model name
     */
    public function loadModel($name, $instance) {
        $name = strtolower($name);
        $modelClass = $name . 'Model';
        $model = ROOT . 'app' . DS . 'models' . DS . $name . EXT;
        
        if(file_exists($model)) {
            require $model;
            $instance = new $modelClass();
        }
    }
    
    /**
     * load a view
     * @param string $template template name
     */
    public function loadView($template = 'home') {
        $this->view = new View($template, $this->params);
    }
    
    /**
     * set params for view
     * @param array $params
     */
    public function setParams($params = array()) {
        $this->params = $params;
    }
    
    /**
     * redirect to another controller
     * @param string $controller
     * @param string $action
     */
    public function redirect($controller, $action = null) {
        header('Location: /' . $controller . '/' . $action);
    }

}
