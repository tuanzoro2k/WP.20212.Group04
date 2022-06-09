<?php
    
    const DS = DIRECTORY_SEPARATOR; // char "/"
    define('ROOT', dirname(dirname(__FILE__)));
    
    $url = $_GET['url'];
    echo $url;
    
    require_once(ROOT . DS . 'library' . DS . 'bootstrap.php');  // to import config/config.php + library/shared.php
