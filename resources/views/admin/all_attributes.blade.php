<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách thuộc tính sản phẩm
                {{-- <span class="d-block text-muted pt-2 font-size-sm">extended pagination options</span> --}}
            </h3>
        </div>
        <div class="card-toolbar">
            <span class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalPopovers">
                <span class="svg-icon svg-icon-md">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>Thêm mới</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thuộc tính sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên thuộc tính:</label>
                                <select id="attributes_name" class="form-control">
                                    <option value="color">Màu sắc</option>
                                    <option value="size">Size</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá trị thuộc tính:</label>
                                <input type="text" class="form-control form-control-solid" id="attributes_value"
                                    placeholder="Giá trị thuộc tính" />
                                <span class="form-text text-muted">Vui lòng điền giá trị thuộc tính sản phẩm</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_attributes" type="button" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thuộc tính sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên thuộc tính:</label>
                                <select id="edit_attributes_name" class="form-control">
                                    <option value="color">Màu sắc</option>
                                    <option value="size">Size</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá trị thuộc tính:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_attributes_value"
                                    placeholder="Giá trị thuộc tính" />
                                <span class="form-text text-muted">Vui lòng điền giá trị thuộc tính sản phẩm</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_attributes" type="button" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0"
            width="100%" id="kt_datatable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên thuộc tính</th>
                    <th>Giá trị</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-attributes') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        if(row.attributes_name == 'color'){
                            return `Màu sắc`
                        }
                        else{
                            return `Size`
                        }
                    }
                },
                {
                    'data': 'attributes_value'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_attributes='${row.attributes_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_attributes='${row.attributes_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
								<i class="la la-trash"></i>\
							</span>\
                            `
                    }
                },
            ],
            responsive: true,
            pagingType: 'full_numbers',
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
            layout: {
                scroll: false,
                footer: false,
            },
            sortable: true,
            pagination: true,
        });
        $('#add_attributes').on('click', function(e) {
            e.preventDefault();
            var attributes_name = $('#attributes_name').val();
            var attributes_value = $('#attributes_value').val();
            if (attributes_name == "" || attributes_value == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'save-attributes',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        attributes_name: attributes_name,
                        attributes_value: attributes_value,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm thuộc tính thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Thuộc tính đã trùng giá trị với thuộc tính khác!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Thêm thuộc tính thất bại!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '#update_attributes', function(e) {
            var attributes_id = $('#edit_attributes_id').val();
            var attributes_name = $('#edit_attributes_name').val();
            var attributes_value = $('#edit_attributes_value').val();
            if (attributes_name == "" || attributes_value == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'update-attributes/' + attributes_id,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        attributes_name: attributes_name,
                        attributes_value: attributes_value,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa thuộc tính thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Thuộc tính đã trùng giá trị với thuộc tính khác!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Sửa thuộc tính thất bại!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var attributes_id = $(this).data('id_attributes');
            $.ajax({
                url: 'edit-attributes/' + attributes_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_attributes_id').val(response.data.attributes_id);
                    $('#edit_attributes_name').val(response.data.attributes_name);
                    $('#edit_attributes_value').val(response.data.attributes_value);
                }
            })
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var attributes_id = $(this).data('id_attributes');
            Swal.fire({
                    title: "Xoá thuộc tính",
                    text: "Bạn có chắc là muốn xóa thuộc tính không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-attributes/' + attributes_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá thuộc tính thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 0) {
                                    Swal.fire("Thất bại",
                                        "thuộc tính đang có bài viết!",
                                        "error");
                                }
                            },
                        });
                    }
                });
            e.preventDefault();
        });
    })
</script>
