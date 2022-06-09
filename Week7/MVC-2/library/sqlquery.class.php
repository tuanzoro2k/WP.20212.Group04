<?php
    
    /**
     * Class SQLQuery => SQL abstraction layer
     */
    class SQLQuery {
        public $_dbHandle;  //$connection
        protected $_result;
        
        /** Connects to database * */
        function connect($address, $account, $pwd, $name) {
            $this->_dbHandle = @mysqli_connect($address, $account, $pwd);
            if ($this->_dbHandle) {
                if (mysqli_select_db($this->_dbHandle, $name)) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
        
        /** Disconnects from database * */
        function disconnect() {
            if (@mysqli_close($this->_dbHandle) != 0) {
                return 1;
            } else {
                return 0;
            }
        }
        
        function selectAll() {
            $query = 'select * from `' . $this->_table . '`';
            return $this->query($query);
        }
        
        function select($id) {
            $query = 'select * from `' . $this->_table . '` where `id` = \'' . mysqli_real_escape_string($this->_dbHandle, $id) . '\'';
            return $this->query($query, 1);
        }
        
        /** Custom SQL Query * */
        function query($query, $singleResult = 0) {
            
            $this->_result = mysqli_query($this->_dbHandle, $query);
            // Find the string of text "select"
            // The "i" after the pattern delimiter indicates a case-insensitive search
            if (preg_match("/select/i", $query)) { // if query is "select"
                $result = array();
                $field = array();   // output fields
                $table = array();   // corresponding table of output fields
                $tempResults = array();
                $numOfFields = 0;
                
                // find out all the output fields and their corresponding tables
                while ($fieldinfo = mysqli_fetch_field($this->_result)) {
                    array_push($table, $fieldinfo->table);
                    array_push($field, $fieldinfo->name);
                    $numOfFields++;
                }
                
                // fetches all the rows, and converts the table to a Model name and places it in our multi-dimensional array
                // The result is of the form $var['modelName']['fieldName']
                while ($row = mysqli_fetch_row($this->_result)) {
                    for ($i = 0; $i < $numOfFields; ++$i) {
                        $table[$i] = trim(ucfirst($table[$i]), "s");
                        $tempResults[$table[$i]][$field[$i]] = $row[$i];
                    }
                    if ($singleResult == 1) {
                        mysqli_free_result($this->_result);
                        return $tempResults;
                    }
                    array_push($result, $tempResults);
                }
                mysqli_free_result($this->_result);
                return ($result);
            }
        }
        
        /** Get number of rows * */
        function getNumRows() {
            return mysqli_num_rows($this->_result);
        }
        
        /** Free resources allocated by a query * */
        function freeResult() {
            mysqli_free_result($this->_result);
        }
        
        /** Get error string * */
        function getError() {
            return mysqli_error($this->_dbHandle);
        }
        
    }
