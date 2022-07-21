<?php
    
    const DS = DIRECTORY_SEPARATOR;
    define('ROOT', dirname(dirname(__FILE__)));
    
    if (isset($_GET['url'])) {
        $url = $_GET['url'];
        echo $url;
    }
    
    require_once(ROOT . DS . 'library' . DS . 'bootstrap.php');
