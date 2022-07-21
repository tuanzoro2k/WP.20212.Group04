<?php
class cart extends controller
{
    public $ProductModels;
    function __construct()
    {
        $this->ProductModels        =  $this->models('ProductModels');
    }
    public function index()
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $data = [
                'page'      => 'cart/index',
                'cart'      => $cart,
            ];
        } else {
            $data = [
                'page'      => 'cart/index',
            ];
        }

        $this->viewFrontEnd('frontend/masterlayout', $data);
    }
    public function addToCart()
    {
        if (isset($_POST['slug'])) {
            $slug = $_POST['slug'];
        }
        $data = $this->ProductModels->select_row('*', ['slug' => $slug]);
        if ($data != NULL) {
            $cart = $this->cart($data);
        }
        $data = [
            'page'      => 'cart/index',
            'cart'      => $cart,
        ];
        $this->viewFrontEnd('frontend/masterlayout', $data);
    }
    function cart($array)
    {
        if (isset($_SESSION['cart'])) {
            if (array_key_exists($array['id'], $_SESSION['cart'])) {
                $_SESSION['cart'][$array['id']]['qty'] += 1;
            } else {
                $_SESSION['cart'][$array['id']] = $array;
                $_SESSION['cart'][$array['id']]['qty'] = 1;
            }
        } else {
            $_SESSION['cart'][$array['id']] = $array;
            $_SESSION['cart'][$array['id']]['qty'] = 1;
        }
        return $_SESSION['cart'];
    }
    function update()
    {
        $product_id = $_GET['id'];
        $qty = $_POST['qty'];
        $_SESSION['cart'][$product_id]['qty'] = $qty;
        $this->index();
    }
    function delete()
    {
        $product_id = $_GET['id'];
        unset($_SESSION['cart'][$product_id]);
        $this->index();
    }
    function checkout()
    {
        unset($_SESSION['cart']);
        $this->index();
    }
}
