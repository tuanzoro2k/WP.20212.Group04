<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'] . '/index' ?>" class="btn btn-primary"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="">
        <form class="" action="" method="post" novalidate>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fullname">Tên</label>
                        <input id="fullname" type="text" value="<?= $data['datas']['name'] ?>" class="form-control" name="data_post[name]">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" value="<?= $data['datas']['email'] ?>" class="form-control" name="data_post[email]">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>