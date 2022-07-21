<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/controllers/MyController.php";
class product extends controller
{

    public $template    = 'cpanel/product';
    public $title       = 'sản phẩm';
    public $message     = [];
    // 
    var $path_dir = 'public/uploads/images/product/';
    var $path_dir_detail = 'public/uploads/images/product/detail/';
    const type = 2;
    const limit = 10;
    public function __construct()
    {
        $this->CategoryModels       =  $this->models('CategoryModels');
        $this->ProductModels        =  $this->models('ProductModels');
        $this->SlugModels           =  $this->models('SlugModels');
        $this->PhotoModels          =  $this->models('PhotoModels');
        $this->MyController         = new MyController();
        // load helper
        $this->JWTOKEN              =  $this->helper('JWTOKEN');
        $this->Authorzation         =  $this->helper('Authorzation');
        $this->uploads              =  $this->helper('uploads');
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
        //  query join table
        //  phân trang ajax
        $rows = $this->ProductModels->select_array_join_table(
            'tbl_product.*,tbl_category.name as name_cate',
            NULL,
            'tbl_product.id desc',
            NULL,
            NULL,
            'tbl_category',
            'tbl_category.id = tbl_product.cateID',
            'LEFT'
        );
        // 30 sản phẩm total_rows = 30
        // mỗi trang sẽ chứa 1 sản phẩm limit = 1
        // 30 / 1 => 30 trang total_rows / limit
        $limit = self::limit;
        $page = 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        $datas = [];
        if ($total_rows > 0) {
            $datas = $this->ProductModels->select_array_join_table(
                'tbl_product.*,tbl_category.name as name_cate',
                NULL,
                'tbl_product.id desc',
                $start,
                $limit,
                'tbl_category',
                'tbl_category.id = tbl_product.cateID',
                'LEFT'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page, $page);
        // ======================
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template . '/index',
            'title'             => 'Danh sách ' . $this->title,
            'template'          => $this->template,
            'datas'             => $datas,
            'button_pagination' => $button_pagination
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
            if ($_FILES['image']['name']) {
                $path_dir = $this->path_dir;
                $data_upload = $this->uploads->upload($_FILES['image'], $path_dir, uniqid(), 400, 400);
                if ($data_upload['result'] == "false") {
                    $redirect = new redirect($this->template . '/' . 'index');
                    $redirect->setFlash('flash', $data_upload['message']);
                } else {
                    $image = $data_upload['image'];
                    $thumb = $data_upload['thumb'];
                }
            } else {
                $image =    "";
                $thumb =    "";
            }
            $type = self::type;
            $data_post      = $_POST['data_post'];
            $data_properties = $_POST['data_properties'];
            $properites = '';
            if (isset($data_properties) && $data_properties != NULL) {
                $properites = json_encode($data_properties);
            }

            $slug = $this->Functions->createSlug($data_post['slug'], $type);
            $price = str_replace(',', "", $data_post['price']);
            $data_post['price'] = $price;
            $data_post['slug']  = $slug;
            $data_post['image'] = $image;
            $data_post['thumb'] = $thumb;
            $data_post['publish'] ? $publish = 1 : $publish = 0;
            $data_post['publish']  = $publish;
            $data_post['properties']  = $properites;
            $data_post['created_at']  = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
            $result = $this->ProductModels->add($data_post);
            $return = json_decode($result, true);
            // 
            $data_photoID = $_POST['photoID'];
            if (isset($data_photoID) &&  $data_photoID != NULL) {
                foreach ($data_photoID as $key => $val) {
                    $this->PhotoModels->update(['productID' => $return['id']], ['uuid' => $val]);
                }
            }
            if ($return['type'] == "sucessFully") {
                $redirect = new redirect($this->template . '/' . 'index');
                $redirect->setFlash('flash', 'Thêm thành công danh mục sản phẩm');
            }
        }
        // parentID
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        foreach ($parent as $key => $val) {
            $parent[$key]['children'] =  $this->CategoryModels->select_array('*', ['parentID' => $val['id']]);
        }
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
        $datas = $this->ProductModels->select_row('*', ['id' => $id]);
        // danh sách ảnh chi tiết
        $list_photo = $this->PhotoModels->select_array('*', ['productID' => $id]);
        $arr_properties = [];
        if ($datas['properties'] != '' && $datas['properties'] != null) {
            $arr_properties = json_decode($datas['properties'], true);
        }
        $image_folder = $datas['image'];
        $thumb_folder = $datas['thumb'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_FILES['image']['name']) {
                if (file_exists($image_folder)) {
                    unlink($image_folder);
                }
                if (file_exists($thumb_folder)) {
                    unlink($thumb_folder);
                }
                $path_dir = $this->path_dir;
                $data_upload = $this->uploads->upload($_FILES['image'], $path_dir, uniqid(), 400, 400);
                if ($data_upload['result'] == "false") {
                    $redirect = new redirect($this->template . '/' . 'index');
                    $redirect->setFlash('flash', $data_upload['message']);
                } else {
                    $image = $data_upload['image'];
                    $thumb = $data_upload['thumb'];
                }
            } else {
                $image =    $datas['image'];
                $thumb =    $datas['thumb'];
            }
            $data_post = $_POST['data_post'];
            $data_properties = $_POST['data_properties'];
            // echo "<pre>";
            // print_r($data_properties);die;
            $properites = '';
            if (isset($data_properties) && $data_properties != NULL) {
                $properites = json_encode($data_properties);
            }
            $type = self::type;
            $slug = $this->Functions->createSlug($data_post['slug'], $type, $datas['slug']);
            $price = str_replace(',', "", $data_post['price']);
            $data_post['price'] = $price;
            $data_post['image'] = $image;
            $data_post['slug']  = $slug;
            $data_post['thumb'] = $thumb;
            $data_post['publish'] ? $publish = 1 : $publish = 0;
            $data_post['publish']       = $publish;
            $data_post['properties']    = $properites;
            $result = $this->ProductModels->update($data_post, ['id' => $id]);
            $return = json_decode($result, true);
            if (isset($_POST['photoID']) &&  $_POST['photoID'] != NULL) {
                $data_photoID = $_POST['photoID'];
                foreach ($data_photoID as $key => $val) {
                    $this->PhotoModels->update(['productID' => $id], ['uuid' => $val]);
                }
            }
            if ($return['type'] == "sucessFully") {
                $redirect = new redirect($this->template . '/' . 'index');
                $redirect->setFlash('flash', 'Cập nhật thành công');
            }
        }
        // ======================
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        foreach ($parent as $key => $val) {
            $parent[$key]['children'] =  $this->CategoryModels->select_array('*', ['parentID' => $val['id']]);
        }
        $data = [
            'data_admin'        => $data_admin,
            'page'              => $this->template . '/edit',
            'title'             => 'Cập nhật ' . $this->title,
            'template'          => $this->template,
            'parent'            => $parent,
            'datas'             => $datas,
            'arr_properties'    => $arr_properties,
            'list_photo'        => $list_photo
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
        $datas = $this->ProductModels->select_row('*', ['id' => $id]);
        $image_folder = $datas['image'];
        $thumb_folder = $datas['thumb'];
        if (file_exists($image_folder)) {
            unlink($image_folder);
        }
        if (file_exists($thumb_folder)) {
            unlink($thumb_folder);
        }
        $result = $this->ProductModels->delete(['id' => $id]);
        $this->SlugModels->delete(['name' => $datas['slug']]);
        $return = json_decode($result, true);
        if ($return['type'] == "sucessFully") {
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
            $datas = $this->ProductModels->select_row('*', ['id' => $val]);
            $image_folder = $datas['image'];
            $thumb_folder = $datas['thumb'];
            if (file_exists($image_folder)) {
                unlink($image_folder);
            }
            if (file_exists($thumb_folder)) {
                unlink($thumb_folder);
            }
            $this->ProductModels->delete(['id' => $val]);
            $this->SlugModels->delete(['name' => $datas['slug']]);
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
        $result = $this->ProductModels->update($dataUpdate, ['id' => $id]);
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
    function pagination_page()
    {
        $rows = $this->ProductModels->select_array_join_table(
            'tbl_product.*,tbl_category.name as name_cate',
            NULL,
            'tbl_product.id desc',
            NULL,
            NULL,
            'tbl_category',
            'tbl_category.id = tbl_product.cateID',
            'LEFT'
        );
        // 30 sản phẩm total_rows = 30
        // mỗi trang sẽ chứa 1 sản phẩm limit = 1
        // 30 / 1 => 30 trang total_rows / limit
        $limit = self::limit;
        $page = $_POST['page'] ? $_POST['page'] : 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas = $this->ProductModels->select_array_join_table(
                'tbl_product.*,tbl_category.name as name_cate',
                NULL,
                'tbl_product.id desc',
                $start,
                $limit,
                'tbl_category',
                'tbl_category.id = tbl_product.cateID',
                'LEFT'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page, $page);
        $data = [
            'template'          => $this->template,
            'datas'             => $datas,
            'button_pagination' => $button_pagination
        ];
        $this->view('product/loadTable', $data);
    }
    function uploads()
    {
        if ($_FILES['file']['name']) {
            $path_dir = $this->path_dir_detail;
            $data_upload = $this->uploads->upload($_FILES['file'], $path_dir, $_POST['uuid'], 600, 400);
            if ($data_upload['result'] == "false") {
                $redirect = new redirect($this->template . '/' . 'index');
                $redirect->setFlash('flash', $data_upload['message']);
            } else {
                $image = $data_upload['image'];
                $thumb = $data_upload['thumb'];
            }
            $array = [
                'uuid'          => $_POST['uuid'],
                'image'         => $image,
                'thumb'         => $thumb,
                'productID'     => 0,
                'created_at'    => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
            ];
            $this->PhotoModels->add($array);
        }
    }
    function deletePhotoID()
    {
        $data = $this->PhotoModels->select_row('*', ['id' => $_POST['id']]);
        if ($data['image'] != '' && $data['image'] != null) {
            if (file_exists($data['image'])) {
                unlink($data['image']);
            }
        }
        if ($data['thumb'] != '' && $data['thumb'] != null) {
            if (file_exists($data['thumb'])) {
                unlink($data['thumb']);
            }
        }
        $result = $this->PhotoModels->delete(['id' => $_POST['id']]);
        echo $result;
    }
    function deletezone()
    {
        $uuid = $_POST['id'];
        $data = $this->PhotoModels->select_row('*', ['uuid' => $uuid]);
        if ($data['image'] != '' && $data['image'] != null) {
            if (file_exists($data['image'])) {
                unlink($data['image']);
            }
        }
        if ($data['thumb'] != '' && $data['thumb'] != null) {
            if (file_exists($data['thumb'])) {
                unlink($data['thumb']);
            }
        }
        $result = $this->PhotoModels->delete(['uuid' => $uuid]);
    }
}
