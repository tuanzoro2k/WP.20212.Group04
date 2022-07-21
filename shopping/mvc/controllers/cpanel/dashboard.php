<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class dashboard extends controller{

    public $html;
    var $template = 'cpanel/dashboard';
    function __construct(){
        $this->AdminModels          =  $this->models('AdminModels');
        $this->MyController         = new MyController();
        // load helper
        $this->JWTOKEN              =  $this->helper('JWTOKEN');
        $this->Authorzation         =  $this->helper('Authorzation');
        // 
        $this->html = new DOMDocument();
    }
    function index(){
        //  ======================
        if (isset($_SESSION['admin'])){
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            }
            else{
                $redirect = new redirect('cpanel/auth/index');
            }
        }
        else{
            $redirect = new redirect('cpanel/auth/index');
        }
        $data_admin = $this->MyController->getIndexAdmin();
        
      
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/index',
            'template'          => $this->template,
        ];
        $this->view('cpanel/masterlayout',$data);
    }
   
}