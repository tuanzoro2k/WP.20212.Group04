<?php
    
    /** Check if environment is development and display errors **/
    
    function setReporting() {
        if (DEVELOPMENT_ENVIRONMENT == true) {
            error_reporting(E_ALL); // Report all PHP errors
            ini_set('display_errors', 'On');    // set config option
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
        }
    }
    
    /** Check for Magic Quotes and remove them **/
    
    function stripSlashesDeep($value) {     // stripped off "\"
        return is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    }
    
    function removeMagicQuotes() {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
    
    /** Check register globals and remove them **/
    
    function unregisterGlobals() {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    
    /** Main Call Function
    So callHook() basically takes the URL which we have received from index.php and separates it out as
    $controller, $action and the remaining as $queryString.
     * $model is the singular version of $controller.
    After the separation is done, it creates a new object of the class $controller.”Controller” and calls the method
    $action() of the class.
     */
    
    function callHook() {
        global $url;
        
        $urlArray = array();
        $urlArray = explode("/", $url);     // split $url by "/" to $urlArray
        
        // get controller/action/queryString from $url (string)
        $controller = $urlArray[0];
        array_shift($urlArray);
        $action = $urlArray[0];
        array_shift($urlArray);
        $queryString = $urlArray;
        
        // Controller to Model (ex url: localhost/items/viewall)
        $controllerName = $controller;  // items
        $controller = ucwords($controller);     // Items
        $model = rtrim($controller, 's');   // Item
        $controller .= 'Controller';    // ItemsController
        $dispatcher = new $controller($model, $controllerName, $action); // new ItemsController("Item", "items", action)
        
        // check if class $controller contains $action() method
        if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatcher, $action), $queryString); // call $dispatch->action() with $queryString as arg
        } else {
            /* Error Generation Code Here */
        }
    }
    
    /** Autoload any classes that are required **/
    
    spl_autoload_register(function ($className) {
        if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
            // find in /library/
            require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
            // find in /application/controllers/
            require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
            // find in /application/models/
            require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
        } else {
            /* Error Generation Code Here */
        }
    });
    
    // init
    setReporting();
    removeMagicQuotes();
    unregisterGlobals();
    callHook();
