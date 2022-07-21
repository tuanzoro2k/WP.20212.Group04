<?php 
class MyController extends controller{
    public $ModuleModels;
    public $PhotoModels;
    function __construct(){
        $this->ModuleModels = $this->models('ModuleModels');
        $this->PhotoModels  = $this->models('PhotoModels');
    }
    function getIndexAdmin(){
        $data['getModule']      = $this->getModule();
        $data['delelePhoto']    = $this->delelePhoto();
        return $data;
    }
    function getModule(){
        $data = $this->ModuleModels->select_array('*',['parentID' => 0,'publish' => 1]);
        foreach($data as $key => $val){
            $children = $this->ModuleModels->select_array('*',['parentID' => $val['id'],'publish' => 1]);
            $data[$key]['children'] = $children;
        }
        return $data; 
    }
    function delelePhoto(){
        $today = gmdate('Y-m-d',time() + 7 *3600);
        $list = $this->PhotoModels->select_array('*',['productID' => 0,'created_at <' => $today]);
        foreach($list as $key => $val){
            if ($val['image'] != '' && $val['image'] != null) {
                if (file_exists($val['image'])) {
                    unlink($val['image']);
                }
            }
            if ($val['thumb'] != '' && $val['thumb'] != null) {
                if (file_exists($val['thumb'])) {
                    unlink($val['thumb']);
                }
            }
        }
        return  $this->PhotoModels->delete(['productID' => 0,'created_at <' => $today]);
    }
}