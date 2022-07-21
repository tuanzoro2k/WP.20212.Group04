<?php
require_once "./mvc/core/redirect.php";
class auth extends controller
{
    public $MyModels;
    public $AccountModels;
    function __construct()
    {
        $this->MyModels             = $this->models('MyModels');
        $this->AccountModels        =  $this->models('AccountModels');
    }
    public function index()
    {

        $this->viewFrontEnd('frontend/login');
    }
    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $checkUser = $this->AccountModels->select_row("*", ['email' => $email]);
            if (isset($checkUser) && $checkUser != null) {
                if (password_verify($password, $checkUser['password'])) {
                    $redirect = new redirect('home');
                } else {
                    $redirect = new redirect('auth');
                    $redirect->setFlash("errors", "Password is wrong");
                }
            } else {
                $redirect = new redirect('auth');
                $redirect->setFlash("errors", "Account doesn't exist");
            }
        }
    }
    function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $checkUser = $this->AccountModels->select_row('*', ['email' => $email]);
            if ($checkUser) {
                $redirect = new redirect('auth');
                $redirect->setFlash('error', "Account is exist!");
            } else {
                $this->AccountModels->add(['name' => $name, 'email' => $email, 'password' => $password]);
                $redirect = new redirect('auth');
                $redirect->setFlash("Sign up successfully");
            }
        }
    }
}
