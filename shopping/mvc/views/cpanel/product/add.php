<script src="public/cpanel/ckeditor/ckeditor.js"></script>
<script src="public/cpanel/ckfinder/ckfinder.js"></script>
<link rel="stylesheet" href="public/build/css/product.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css">
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'] . '/index' ?>" class="btn btn-primary"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="">
        <form class="" action="" method="post" id="form_data" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Danh mục sản phẩm</label>
                        <select name="data_post[cateID]" class="form-control" id="cateID">
                            <option value="0">Chọn danh mục sản phẩm</option>
                            <?php if (isset($data['parent']) && $data['parent'] != null) { ?>
                                <?php foreach ($data['parent'] as $key => $val) { ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                    <?php if (isset($val['children']) && $val['children'] != null) { ?>
                                        <?php foreach ($val['children'] as $key_child => $val_child) { ?>
                                            <option value="<?= $val_child['id'] ?>"> ----------- <?= $val_child['name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input id="name" type="text" onkeyup="removeAccents(this)" class="form-control" name="data_post[name]">
                        <input type="hidden" name="data_post[slug]" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input id="price" type="text" onkeyup="formatMoney(this)" class="form-control" name="data_post[price]">
                    </div>
                    <div class="form-group">
                        <label for="publish">Hiển thị</label>
                        <input id="publish" type="checkbox" value="1" checked name="data_post[publish]">
                    </div>
                    <div class="form-group">
                        <div class="dropzone" id="mydropzone">
                            <div class="boxID"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <div class="image_box">
                            <div class="image">
                                <img id="preview" src="public/build/images/noimage.png" alt="">
                            </div>
                            <div class="btn_choose">
                                <label for="image">Chọn hình ảnh</label>
                                <input type="file" name="image" id="image" accept="image/png,image/jpeg">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="data_post[contents]" class="form-control" id="" cols="30" rows="10"></textarea>
                        <script>
                            CKEDITOR.replace('data_post[contents]', {
                                filebrowserBrowseUrl: 'http://localhost:8080/shopping/ckfinder/index',
                                filebrowserUploadUrl: 'public/cpanel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserWindowWidth: '1000',
                                filebrowserWindowHeight: '700'
                            });
                        </script>
                    </div>
                </div>
                <div class="col-12 text-left">
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
        for (var i = 0; i < AccentsMap.length; i++) {
            var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
            var char = AccentsMap[i][0];
            substr = substr.replace(re, char);
            substr = substr.replace(/\s/g, '-');
        }
        document.querySelector('#slug').value = substr;
    }

    function formatMoney(__this) {
        let val = __this.value;
        let num = val.replace(/[^\d.]/g, "");
        let arr = num.split('.');
        let val_num = arr[0];
        let len = val_num.length;
        let result = '';
        let j = 0;
        for (let index = len; index > 0; index--) {
            j++;
            if (j % 3 == 1 && j != 1) {
                result = val_num.substr(index - 1, 1) + ',' + result;
            } else {
                result = val_num.substr(index - 1, 1) + result;
            }
        }
        __this.value = result
    }
    let image = document.querySelector('#image');
    image.addEventListener('change', (e) => {
        let input = e.target.files[0];
        if (input) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#preview').setAttribute('src', e.target.result)
            }
            reader.readAsDataURL(input);
        } else {
            document.querySelector('#preview').setAttribute('src', 'public/build/images/noimage.png')
        }
    });
    // ==========================================================================================
</script>
<script>
    Dropzone.autoDiscover = false;
    let Mydropzone = new Dropzone('#mydropzone', {
        url: "cpanel/product/uploads",
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function() {
            this.on('complete', function(file) {
                $('.boxID').append(`<input type="text" name="photoID[]" value="${file.upload.uuid}" >`)
            });
            this.on('sending', function(file, xhr, formData) {
                formData.append('uuid', file.upload.uuid);
            });
            this.on('removedfile', function(file) {
                $.ajax({
                    url: "cpanel/product/deletezone",
                    method: "post",
                    data: {
                        id: file.upload.uuid
                    },
                    success: function(params) {

                    }
                });
            });
        }
    });
</script>
<script>
    function create() {
        let count_items = document.querySelectorAll('.items_properties').length - 1;
        count_items++;
        $('#multi_properties').append(`
            <div class="row items_properties">
                <div class="col-5">
                    <label for="">Tên thuộc tính</label>
                    <input type="text" class="form-control" name="data_properties[${count_items}][name]">
                </div>
                <div class="col-5">
                    <label for="">Giá trị</label>
                    <input type="text" class="form-control" name="data_properties[${count_items}][value]">
                </div>
                <div class="col-2">
                    <label for="">&nbsp;</label>
                    <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger d-block"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        `);

    }

    function delete_(__this) {
        let count_items = document.querySelectorAll('.items_properties').length - 1;
        count_items--;
        $(__this).closest('.items_properties').remove();
    }
</script>