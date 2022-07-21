<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>
<link rel="stylesheet" href="public/build/css/product.css">
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'].'/add' ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>
            <a href="javascript:void(0)" onclick="delAll(this)" data-control ="<?= $data['template'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            <a href="<?=  $data['template'].'/index' ?>" data-control ="<?= $data['template'] ?>" class="btn btn-success"><i class="fa fa-history"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12" id="MessageFlash">
            <?php if(isset($_SESSION['flash'])){?>
                    <h3 class="text-success"><?= $redirect->setFlash('flash');  ?></h3>
            <?php } ?>
            <?php if(isset($_SESSION['errors'])){?>
                <h3 class="text-danger"><?= $redirect->setFlash('errors');  ?></h3>
           <?php } ?>
        </div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <div id="loadTable">
                <?php require_once "./mvc/views/cpanel/product/loadTable.php" ?>
            </div>
        </div>
    </div>
    </div>
</div>


