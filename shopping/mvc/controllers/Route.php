<?php

class Route extends controller
{

    function __construct()
    {
        $this->SlugModels    =  $this->models('SlugModels');
        $this->ProductModels =  $this->models('ProductModels');
        $this->PhotoModels   =  $this->models('PhotoModels');
        $this->CategoryModels = $this->models('CategoryModels');
    }
    function index($alias)
    {
        $datas = $this->SlugModels->select_row('*', ['name' => $alias]);
        if ($datas['type'] == 2) {
            $data = $this->product($alias);
            $this->viewFrontEnd('frontend/masterlayout', $data);
        } else {
            if ($datas['type'] == 1) {
                $data = $this->category($alias);
                $this->viewFrontEnd('frontend/masterlayout', $data);
            }
        }
    }
    function product($alias)
    {
        $data = [];
        $data['page'] = 'product/detail';
        $data['product'] =  $this->ProductModels->select_row('*', ['slug' => $alias]);
        $data['list_images'] = $this->PhotoModels->select_array('*', ['productID' => $data['product']['id']]);
        return $data;
    }
    function category($alias)
    {
        $data = [];
        $data['page'] = 'shop/index';
        $data['category'] =  $this->CategoryModels->select_row('*', ['slug' => $alias]);
        $cateID = $data['category']['id'];
        $data['product'] = $this->ProductModels->select_array('*', ['cateID' => $cateID]);
        return $data;
    }
}
