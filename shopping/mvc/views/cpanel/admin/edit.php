<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'].'/index' ?>" class="btn btn-primary"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
        <div class="">
            <form class="" action="" method="post" novalidate>
                <div class="row">
                    <div class="col-6">
                         <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input id="fullname" type="text" value="<?= $data['datas']['fullname'] ?>" class="form-control" name="data_post[fullname]">
                        </div>
                        <div class="form-group">
                            <label for="publish">Hiển thị</label>
                            <input id="publish" type="checkbox"<?= $data['datas']['publish'] == 1?'checked':'' ?> value="1"  name="data_post[publish]">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>