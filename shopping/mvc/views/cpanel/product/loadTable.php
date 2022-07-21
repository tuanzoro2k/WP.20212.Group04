<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th>
                <input type="checkbox" id="check-all"  onclick="toggle(this)">
            </th>
            <th class="column-title">Tên sản phẩm</th>
            <th class="column-title">Danh mục</th>
            <th class="column-title">Hình ảnh</th>
            <th class="column-title">Giá </th>
            <th class="column-title">Hiển thị </th>
            <th class="column-title">Ngày tạo </th>
            <th class="column-title no-link last"><span class="nobr">Chức năng</span>
            </th>
        </tr>
    </thead>
    <?php if(isset($data['datas']) && $data['datas']!= NULL){?>
        <tbody>
            <?php foreach($data['datas'] as $key => $val){?>
                <tr class="even<?= $val['id'] ?> pointer">
                    <td><input type="checkbox" name="foo" value="<?= $val['id'] ?>"></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['name_cate'] ?></td>
                    <td><img src="<?= $val['image'] ?>" height="100" alt=""></td>
                    <td><?= number_format($val['price']) ?> đ</td>
                    <td><input type="checkbox" onclick="checkPublish(<?= $val['id'] ?>,'publish')" id="publish<?= $val['id'] ?>" data-control="<?= $data['template'] ?>" <?= $val['publish'] == 1?'checked':'' ?>></td>
                    <td><?= date('d/m/Y' , strtotime($val['created_at'])) ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="del(<?= $val['id'] ?>)" id="del<?= $val['id'] ?>" data-control="<?= $data['template'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        <a href="<?= $data['template'].'/'.'edit/'.$val['id'] ?>"class="btn btn-success"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    <?php } ?>
</table>
<ul class="pagination" style="justify-content:flex-end">
    <?= $data['button_pagination']; ?>
</ul>
<script>
    $(document).ready(function(){
        let data;
        let page = 1;
        $('.pagination li a.page-link').click(function(){
            page = $(this).attr('num-page')
            data = {
                page:page
            }
            callback('product/pagination_page',data);
        })
        function callback(url,data){
            $.ajax({
                url:url,
                method:"post",
                data:data,
                success:function(response){
                    $('#loadTable').html(response);
                }
            })
        }
    });
    function toggle(__this){
       let isChecked = __this.checked;
       let checkbox = document.querySelectorAll('input[name="foo"]');
        for (let index = 0; index < checkbox.length; index++) {
            checkbox[index].checked = isChecked
        }
    }
</script>
