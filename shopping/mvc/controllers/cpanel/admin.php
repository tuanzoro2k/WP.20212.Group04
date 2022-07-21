<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class admin extends controller
{
    public $template    = 'cpanel/admin';
    public $title       = 'Tài khoản quản trị';
    public function __construct()
    {
        $this->AdminModels       =  $this->models('AdminModels');
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
        //  ======================
        $data_admin = $this->MyController->getIndexAdmin();
        $datas = $this->AdminModels->select_array('*');
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/index',
            'title'             => 'Danh sách '.$this->title,
            'template'          => $this->template,
            'datas'             => $datas
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function add()
    {
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
        //  =============
        $data_admin = $this->MyController->getIndexAdmin();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data_post = $_POST['data_post'];
            $password = password_hash($data_post['password'],PASSWORD_BCRYPT);
            $data_post['password'] = $password;
            $data_post['publish'] ? $publish = 1:$publish = 0;
            $data_post['publish']  = $publish;
            $result = $this->AdminModels->add($data_post);
            $return = json_decode($result, true);
            if ($return['type']=="sucessFully") {
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Thêm thành công');
            }
        }
        
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template.'/add',
            'title'             => 'Thêm mới '.$this->title,
            'template'          => $this->template,
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function edit($id)
    {
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
        // =========================
        $data_admin = $this->MyController->getIndexAdmin();
        $datas = $this->AdminModels->select_row('*', ['id' => $id]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data_post = $_POST['data_post'];
            $data_post['publish'] ? $publish = 1:$publish = 0;
            $data_post['publish']  = $publish;
            $result = $this->AdminModels->update($data_post, ['id' => $id]);
            $return = json_decode($result, true);
            if ($return['type']=="sucessFully") {
                $redirect = new redirect($this->template.'/'.'index');
                $redirect->setFlash('flash', 'Cập nhật thành công');
            }
        }
        // ======================
        $data = [
            'data_admin'        => $data_admin,
            'page'          => $this->template.'/edit',
            'title'         => 'Cập nhật '.$this->title,
            'template'      => $this->template,
            'datas'         => $datas
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function delete()
    {
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
        $id = $_POST['id'];
        $result = $this->AdminModels->delete(['id' => $id]);
        $return = json_decode($result, true);
        if ($return['type'] =="sucessFully") {
            echo json_encode(
                [
                    'result'    => "true",
                    'message'   => $return['Message']
                ]
            );
        }
    }
    public function delAll()
    {
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
        $listID = $_POST['listID'];
        $arrayID = explode(',', $listID);
        foreach ($arrayID as $key => $val) {
            $this->AdminModels->delete(['id' => $val]);
        }
        echo json_encode(
            [
                'result'    => 'success',
                'message'   => 'Delete Success'
            ]
        );
    }
    public function checkpublish()
    {
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
        $id = $_POST['id'];
        $value = $_POST['value'];
        $fields = $_POST['fields'];
        $dataUpdate[$fields] = $value;
        $result = $this->AdminModels->update($dataUpdate, ['id' => $id]);
        $return = json_decode($result, true);
        if ($return['type'] == "sucessFully") {
            echo json_encode(
                array(
                    'type'      => 'sucessFully',
                    'Message'   => 'Update data success',
                )
            );
        }
    }
}
