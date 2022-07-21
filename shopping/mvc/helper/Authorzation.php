<?php 
class Authorzation extends controller{
    public $AdminModels;
    function __construct(){
        $this->AdminModels       =  $this->models('AdminModels');
    }
    function checkAuth($array){
        $id = $array['id'];
        $username = $array['username'];
        $checkUS = $this->AdminModels->select_array('*',['id' => $id,'username' => $username]);
        if ($checkUS != NULL && count($checkUS) > 0) {
            return true;
        }
        else{
            return false;
        }
    }
}