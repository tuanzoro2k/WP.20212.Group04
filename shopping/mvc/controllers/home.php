<?php
class home extends controller
{
    public $MyModels;
    public $ProductModels;
    public $CategoryModels;
    function __construct()
    {
        $this->MyModels             = $this->models('MyModels');
        $this->ProductModels        =  $this->models('ProductModels');
        $this->CategoryModels       = $this->models('CategoryModels');
    }
    public function index()
    {
        $product = $this->ProductModels->select_array('*', ['publish' => 1], 'id desc');
        $top_product = array_slice($product, 0, 3);
        $categories = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        foreach ($categories as $key => $val) {
            $children = $this->CategoryModels->select_array('*', ['parentID' => $val['id']]);
            $categories[$key]['children'] = $children;
        }

        $data = [
            'page'      => 'home/index',
            'product'   => $product,
            'categories' => $categories,
            'top_product' => $top_product,
        ];
        $this->viewFrontEnd('frontend/masterlayout', $data);
    }
    // function detail($slug)
    // {
    //     $data = $this->ProductModels->select_row('*', ['slug' => $slug]);
    //     if ($data != NULL) {
    //         $cart = $this->cart($data);
    //     }
    // }
}
