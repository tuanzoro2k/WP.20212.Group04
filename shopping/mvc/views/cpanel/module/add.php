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
                            <label for="">Danh mục cha</label>
                            <select name="data_post[parentID]" class="form-control" id="">
                                    <option value="0">Chọn danh mục cha</option>
                                <?php if(isset($data['parent']) && $data['parent']!=NULL){?>
                                    <?php foreach($data['parent'] as $key => $val){?>
                                        <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên module</label>
                            <input id="name" type="text" class="form-control" name="data_post[name]">
                        </div>
                        <div class="form-group">
                            <label for="link">Liên kết</label>
                            <input id="link" type="text"  class="form-control" name="data_post[link]">
                        </div>
                        <div class="form-group">
                            <label for="controller">Controller</label>
                            <input id="controller" type="text"  class="form-control" name="data_post[controller]">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input id="icon" type="text"  class="form-control" name="data_post[icon]">
                        </div>
                        <div class="form-group">
                            <label for="publish">Hiển thị</label>
                            <input id="publish" type="checkbox" checked name="data_post[publish]">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="submit" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>