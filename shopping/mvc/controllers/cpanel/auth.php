<?php 
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class auth extends controller{
    const  DASHBOARD = 'dashboard';
    const  ACTION = 'index';
    const CONTROLLER = "auth";
    function __construct(){
        $this->AdminModels          =  $this->models('AdminModels');
        $this->MyController         = new MyController();
        // Load helper
         $this->JWTOKEN             =  $this->helper('JWTOKEN');
         $this->Authorzation        =  $this->helper('Authorzation');
    }
    function index(){
        if (isset($_SESSION['admin'])){
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth == true) {
                    $redirect = new redirect('cpanel/'.self::DASHBOARD.'/'.self::ACTION);
                }
            }
        }
        $datas = [];
        if (isset($_COOKIE['remember'])) {
            $datas = json_decode($_COOKIE['remember'],true);
        }
        $data = [
            'datas' => $datas
        ];
        $this->view('cpanel/login',$data);
    }
    function login(){
        //  ======================
        if (isset($_SESSION['admin'])){
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'],KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth == true) {
                    $redirect = new redirect('cpanel/'.self::DASHBOARD.'/'.self::ACTION);
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Tìm xem có user tồn tại trong database
            $checkUni = $this->AdminModels->select_row('*',['username' => $username]);
            if (isset($checkUni) && $checkUni != NULL) {
                if (password_verify($password,$checkUni['password'])) {
                    if (isset($_POST['remember']) && $_POST['remember'] == 1) {
                        $array_remember = [
                            'username'  => $username,
                            'password'  => $password,
                            'remember'  => 1
                        ];
                        $json_remember = json_encode($array_remember);
                        setcookie('remember',$json_remember,time()+86400,'/');
                    }
                    else{
                         setcookie('remember','',0,'/');
                    }
                    $array = [
                        'time'      => time() + 3600 * 24,
                        'keys'      => KEYS,
                        'info'      => [
                            'id'        => $checkUni['id'],
                            'username'  => $checkUni['username']
                        ]
                        
                    ];
                    $jwt = $this->JWTOKEN->CreateToken($array);
                    $_SESSION['admin'] = $jwt;
                    $redirect = new redirect('cpanel/'.self::DASHBOARD.'/'.self::ACTION);
                }
                else{
                    $redirect = new redirect('cpanel/'.self::CONTROLLER.'/'.self::ACTION);
                    $redirect->setFlash('errors','Thông tin không trùng khớp');
                }
            }
            else{
                $redirect = new redirect('cpanel/'.self::CONTROLLER.'/'.self::ACTION);
                $redirect->setFlash('errors','Tài khoản không tồn tại');
            }
        }
    }
    function logout(){
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
        unset($_SESSION['admin']);
        $redirect = new redirect('cpanel/'.self::CONTROLLER.'/'.self::ACTION);
        
    }
}