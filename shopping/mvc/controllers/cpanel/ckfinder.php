<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class ckfinder extends controller
{
    // load Models
    public $CategoryModels;
    // Load MyController
    public $MyController;
    // Load helper
    public $Authorzation;
    public $JWTOKEN;
    public $template    = 'ckfinder';
    const  type         = 1;
    public $message     = [];
    public function __construct()
    {
        $this->CategoryModels       =  $this->models('CategoryModels');
        $this->MyController         = new MyController();
        // load helper
        $this->JWTOKEN              =  $this->helper('JWTOKEN');
        $this->Authorzation         =  $this->helper('Authorzation');

    }
    public function index()
    {
        //  ======================
        if (isset($_SESSION['admin'])){
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('auth/index');
                }
            }
            else{
                $redirect = new redirect('auth/index');
            }
        }
        else{
            $redirect = new redirect('auth/index');
        }
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/index',
            'template'          => $this->template,
        ];
        $this->view('ckfinder/index');
    }
}
