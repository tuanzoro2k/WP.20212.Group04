<?php
    
    class Template {
        
        protected $variables = array();
        protected $_controller;     // string
        protected $_action;         // string
        
        function __construct($controller, $action) {
            $this->_controller = $controller;
            $this->_action = $action;
        }
        
        /** Set Variables **/
        
        function set($name, $value) {
            $this->variables[$name] = $value;
        }
        
        /**
         * Display Template HTML
         * HEADER - CONTENT - FOOTER
         */
        
        function render() {
            // create $name(s), $value(s) corresponding to key value in variables array
            // will be used inside template below
            extract($this->variables);
            
            // find header in /application/views/{controller}/header.php
            // if not found -> /application/views/header.php
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
                include(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
            } else {
                include(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
            }
            
            // find action in /application/views/{controller}/{action}.php
            include(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php');
    
            // find footer in /application/views/{controller}/footer.php
            // if not found -> /application/views/footer.php
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
                include(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
            } else {
                include(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
            }
        }
        
    }
