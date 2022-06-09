<?php
    
    class Model extends SQLQuery {
        protected $_model;  // string - name of the class of an object (ex: Item)
    
        function __construct() {
            $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $this->_model = get_class($this);   // name of the class of an object
            $this->_table = strtolower($this->_model) . "s";
        }
        
        function __destruct() {
        }
    }
