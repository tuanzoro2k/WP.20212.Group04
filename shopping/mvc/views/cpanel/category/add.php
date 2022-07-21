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
                                <?php if (isset($data['parent']) && $data['parent']!=null) {?>
                                    <?php foreach ($data['parent'] as $key => $val) {?>
                                        <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input id="name" type="text" onkeyup="removeAccents(this)" class="form-control" name="data_post[name]">
                            <input type="hidden" name="data_post[slug]" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="publish">Hiển thị</label>
                            <input id="publish" type="checkbox" value="1" checked name="data_post[publish]">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="submit" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
<script>
    function removeAccents(str) {
        let substr = str.value;
        var AccentsMap = [
            "aàảãáạăằẳẵắặâầẩẫấậ",
            "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
            "dđ", "DĐ",
            "eèẻẽéẹêềểễếệ",
            "EÈẺẼÉẸÊỀỂỄẾỆ",
            "iìỉĩíị",
            "IÌỈĨÍỊ",
            "oòỏõóọôồổỗốộơờởỡớợ",
            "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
            "uùủũúụưừửữứự",
            "UÙỦŨÚỤƯỪỬỮỨỰ",
            "yỳỷỹýỵ",
            "YỲỶỸÝỴ",
            " .:/@#<>%^*()",
        ];
        for (var i=0; i<AccentsMap.length; i++) {
            var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
            var char = AccentsMap[i][0];
            substr = substr.replace(re, char);
            substr = substr.replace(/\s/g,'-');
        }
        document.querySelector('#slug').value = substr;
    }
</script>