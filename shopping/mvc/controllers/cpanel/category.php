<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class category extends controller
{
    public $template    = 'cpanel/category';
    public $title       = 'danh mục sản phẩm';
    const  type         = 1;
    public $message     = [];
    public function __construct()
    {
        $this->CategoryModels       =  $this->models('CategoryModels');
        $this->SlugModels           =  $this->models('SlugModels');
        $this->MyController         = new MyController();
        // load helper
        $this->JWTOKEN              =  $this->helper('JWTOKEN');
        $this->Authorzation         =  $this->helper('Authorzation');
        $this->Functions            =  $this->helper('Functions');
    }
    public function index()
    {
        //  ======================
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        $data_admin = $this->MyController->getIndexAdmin();
        $datas = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        foreach ($datas as $key => $val) {
            $children = $this->CategoryModels->select_array('*', ['parentID' => $val['id']]);
            $datas[$key]['children'] = $children;
        }
        $data = [
            'data_admin'        => $data_admin,
            'page'      => $this->template . '/index',
            'title'     => 'Danh sách ' . $this->title,
            'template'  => $this->template,
            'datas'     => $datas
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function add()
    {
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        //  =============
        $data_admin = $this->MyController->getIndexAdmin();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data_post = $_POST['data_post'];
            $slug = $this->Functions->createSlug($data_post['slug'], self::type);
            $data_post['slug'] = $slug;
            $data_post['publish'] ? $publish = 1 : $publish = 0;
            $data_post['publish']  = $publish;
            $data_post['type']  = self::type;
            $data_post['created_at']  = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
            $result = $this->CategoryModels->add($data_post);
            $return = json_decode($result, true);
            if ($return['type'] == "sucessFully") {
                $redirect = new redirect($this->template . '/' . 'index');
                $redirect->setFlash('flash', 'Thêm thành công danh mục sản phẩm');
            }
        }
        // parentID
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);

        $data = [
            'data_admin'        => $data_admin,
            'page'          => $this->template . '/add',
            'title'         => 'Thêm mới ' . $this->title,
            'template'      => $this->template,
            'parent'        => $parent
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function edit($id)
    {
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        // =========================
        $data_admin = $this->MyController->getIndexAdmin();
        $datas = $this->CategoryModels->select_row('*', ['id' => $id]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data_post = $_POST['data_post'];
            if ($id == $data_post['parentID']) {
                $redirect = new redirect($this->template . '/' . 'index');
                $redirect->setFlash('errors', 'id của danh mục này trùng với id hiện tại');
            } else {
                $slug = $this->Functions->createSlug($data_post['slug'], self::type, $datas['slug']);
                $data_post['slug'] = $slug;
                $data_post['publish'] ? $publish = 1 : $publish = 0;
                $data_post['publish']  = $publish;
                $data_post['update_at']  = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
                $result = $this->CategoryModels->update($data_post, ['id' => $id]);
                $return = json_decode($result, true);
                if ($return['type'] == "sucessFully") {
                    $redirect = new redirect($this->template . '/' . 'index');
                    $redirect->setFlash('flash', 'Cập nhật thành công');
                }
            }
        }
        // ======================
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        $data = [
            'data_admin'        => $data_admin,
            'page'          => $this->template . '/edit',
            'title'         => 'Cập nhật ' . $this->title,
            'template'      => $this->template,
            'parent'        => $parent,
            'datas'         => $datas
        ];
        $this->view('cpanel/masterlayout', $data);
    }
    public function delete()
    {
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        $id = $_POST['id'];
        $datas = $this->CategoryModels->select_row('*', ['id' => $id]);
        $this->SlugModels->delete(['name' => $datas['slug']]);
        $result = $this->CategoryModels->delete(['id' => $id]);
        $return = json_decode($result, true);
        if ($return['type'] == "sucessFully") {
            $this->CategoryModels->update(['parentID' => 0], ['parentID' => $id]);
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
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        $listID = $_POST['listID'];
        $arrayID = explode(',', $listID);
        foreach ($arrayID as $key => $val) {
            $datas = $this->CategoryModels->select_row('*', ['id' => $val]);
            $this->SlugModels->delete(['name' => $datas['slug']]);
            $this->CategoryModels->delete(['id' => $val]);
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
        if (isset($_SESSION['admin'])) {
            $verify = $this->JWTOKEN->decodeToken($_SESSION['admin'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if ($auth != true) {
                    $redirect = new redirect('cpanel/auth/index');
                }
            } else {
                $redirect = new redirect('cpanel/auth/index');
            }
        } else {
            $redirect = new redirect('cpanel/auth/index');
        }
        $id = $_POST['id'];
        $value = $_POST['value'];
        $fields = $_POST['fields'];
        $dataUpdate[$fields] = $value;
        $result = $this->CategoryModels->update($dataUpdate, ['id' => $id]);
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
