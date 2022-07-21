<?php
require_once "constant.php";
class redirect
{
    public function __construct($index = '')
    {
        if ($index != '') {
            header("location:".base_url.$index."");
        }
    }
    public function setFlash($type, $text = '')
    {
        if (isset($_SESSION[$type])) {
            $message = $_SESSION[$type];
            unset($_SESSION[$type]);
            return $message;
        } else {
            $_SESSION[$type] = $text;
        }
        return '';
    }
}
