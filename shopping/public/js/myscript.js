function del(id) {
    let control = $('#del' + id).attr('data-control');
    Swal.fire({
        title: 'Are you sure ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: control + '/delete',
                method: "post",
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.result === "true") {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        $('.even' + id).remove();
                    }
                }
            })
        }
    });
}
function checkPublish(id, fields) {
    let control = $('#' + fields + id).attr('data-control');
    let ischecked = $('#' + fields + id).is(':checked');
    let value = 0;
    if (ischecked) {
        value = 1;
    }
    $.ajax({
        url: control + '/checkpublish',
        method: "post",
        data: { id: id, value: value, fields: fields },
        dataType: 'json',
        success: function (response) {
            if (response.type === "sucessFully") {
                Swal.fire(
                    'Update!',
                    response.Message,
                    'success'
                );
            }
        }
    })
}
function delAll(__this) {
    let control = $(__this).attr('data-control');
    let listID = '';
    Swal.fire({
        title: 'Are you sure ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $('input[name="foo"]').each(function () {
                if (this.checked) {
                    listID = listID + ',' + this.value
                }
            });
            listID = listID.substr(1);
            if (listID !== '') {
                $.ajax({
                    url: control + '/delAll',
                    method: "post",
                    data: { listID: listID },
                    dataType: 'json',
                    success: function (response) {
                        if (response.result === "success") {
                            $('input[name="foo"]').each(function () {
                                if (this.checked) {
                                    $('.even' + this.value).remove();
                                }
                            });
                            Swal.fire('Thành công!', 'Xóa thành công', 'success');
                        }
                    }
                })
            }
            else {
                Swal.fire('Error!', 'Vui lòng chọn mục cần xóa', 'warning');
            }
        }
    });
}
$(document).ready(function () {
    setTimeout(() => {
        $('#MessageFlash').hide(500)
    }, 1000);
});


