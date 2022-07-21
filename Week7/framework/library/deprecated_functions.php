<?php
    function mysqli_field_name($result, $field_offset) {
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->name : null;
    }
    
    function mysqli_field_table($result, $field_offset) {
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->table : null;
    }

?>