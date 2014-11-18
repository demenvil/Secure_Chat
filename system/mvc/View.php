<?php

/**
 * View class
 */
class View {
    private $title;
    private $layout;
    private $template;
    private $vars;
    
    /**
     * create view
     * @param type $template
     * @param type $vars
     * @param type $layout
     */
    public function __construct($template, $vars = array(), $title = 'TITLE', $layout = 'default') {
        $this->template = ROOT . 'app' . DS . 'views' . DS . $template;
        $this->vars = $vars;
        $this->title = $title;
        $this->layout = ROOT . 'app' . DS . 'views' . DS . 'layout' . DS . $layout . EXT;
    }
    
    /**
     * render view and display page
     */
    public function render($action = 'index') {
        $view = $this->template . DS . $action . EXT;
        if(file_exists($view) && file_exists($this->layout)) {
            ob_start();
            $title = $this->title;
            extract($this->vars);
            include $view;
            $content = ob_get_clean();
            
            include $this->layout;
            die();
        }        
    }
}