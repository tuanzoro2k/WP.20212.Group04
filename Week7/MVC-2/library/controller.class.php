<?php
    /**
     * protected properties or methods can be accessed within the class or "WITHIN" classes derived from that class
     */
    
    class Controller {
        // string
        protected $_model;
        protected $_controller;
        protected $_action;
        
        // Template - view
        protected $_template;
        
        function __construct($model, $controller, $action) {
            $this->_controller = $controller;
            $this->_action = $action;
            $this->_model = $model;
            
            // create object for model & template(view)
            // $this->$model means take the string in $model & make object with that
            // In this case it's $this->Item = new Item();
            $this->$model = new $model;
            $this->_template = new Template($controller, $action);
        }
        
        // set field to template $variables array
        function set($name, $value) {
            $this->_template->set($name, $value);
        }
        
        // While destroying the class we call the render() function which displays the view (template) file
        // called in hook() in shared.php
        function __destruct() {
            $this->_template->render();
        }
    }
