<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách danh mục bài viết
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục bài viết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" class="form-control form-control-solid" id="category_name"
                                    placeholder="Tên danh mục" />
                                <span class="form-text text-muted">Vui lòng điền tên danh mục bài viết</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả danh mục:</label>
                                <textarea placeholder="Mô tả danh mục" id="category_desc"
                                    class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">Vui lòng mô tả danh mục bài viết</span>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select id="category_status" class="form-control">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiện</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_category" type="button" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục bài viết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <input type="hidden" id="edit_category_id">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_category_name"
                                    placeholder="Tên danh mục" />
                                <span class="form-text text-muted">Vui lòng điền tên danh mục bài viết</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả danh mục:</label>
                                <textarea placeholder="Mô tả danh mục" id="edit_category_desc"
                                    class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">Vui lòng mô tả danh mục bài viết</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_category" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hiển thị</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    function ChangeToSlug(category_name) {
        category_name = category_name.toLowerCase();
        category_name = category_name.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        category_name = category_name.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        category_name = category_name.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        category_name = category_name.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        category_name = category_name.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        category_name = category_name.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        category_name = category_name.replace(/đ/gi, 'd');
        category_name = category_name.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        category_name = category_name.replace(/ /gi, "-");
        category_name = category_name.replace(/\-\-\-\-\-/gi, '-');
        category_name = category_name.replace(/\-\-\-\-/gi, '-');
        category_name = category_name.replace(/\-\-\-/gi, '-');
        category_name = category_name.replace(/\-\-/gi, '-');
        category_name = '@' + category_name + '@';
        category_name = category_name.replace(/\@\-|\-\@|\@/gi, '');
        return category_name;
    }
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-category-blog') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'category_name'
                },
                {
                    'data': 'category_desc'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.category_status == 0) {
                            return `\
                            <span data-id_category='${row.category_id}' class="unactivecat btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_category='${row.category_id}' class="activecat btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
								<i class="la la-eye-slash"></i>\
							</span>\
                            `;
                        }
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_category='${row.category_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_category='${row.category_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $('#add_category').on('click', function(e) {
            e.preventDefault();
            var category_name = $('#category_name').val();
            var category_desc = $('#category_desc').val();
            var category_status = $('#category_status').val();
            var category_slug = ChangeToSlug(category_name);
            var _token = $('input[name="_token"]').val();
            if (category_name == "" || category_desc == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'save-category-blog',
                    method: 'POST',
                    data: {
                        category_name: category_name,
                        category_desc: category_desc,
                        category_status: category_status,
                        category_slug: category_slug,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm danh mục thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Danh mục đã trùng tên!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Thêm danh mục thất bại!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '#update_category', function(e) {
            var category_blog_id = $('#edit_category_id').val();
            var category_blog_name = $('#edit_category_name').val();
            var category_blog_desc = $('#edit_category_desc').val();
            var category_blog_slug = ChangeToSlug(category_blog_name);
            var _token = $('input[name="_token"]').val();
            if (category_blog_name == "" || category_blog_desc == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'update-category-blog/' + category_blog_id,
                    method: 'POST',
                    data: {
                        categor_id: category_blog_id,
                        category_name: category_blog_name,
                        category_desc: category_blog_desc,
                        category_slug: category_blog_slug,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa danh mục thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Danh mục đã trùng tên!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Sửa danh mục thất bại!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var category_blog_id = $(this).data('id_category');
            $.ajax({
                url: 'edit-category-blog/' + category_blog_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_category_id').val(response.data.category_id);
                    $('#edit_category_name').val(response.data.category_name);
                    $('#edit_category_desc').val(response.data.category_desc);
                }
            })
        });
        $(document).on('click', '.activecat', function(e) {
            e.preventDefault();
            var category_blog_id = $(this).data('id_category');
            $.ajax({
                url: 'active-category-blog/' + category_blog_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã hiện thị danh mục!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            })
        });
        $(document).on('click', '.unactivecat', function(e) {
            e.preventDefault();
            var category_blog_id = $(this).data('id_category');
            $.ajax({
                url: 'unactive-category-blog/' + category_blog_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã ẩn danh mục!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            })
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var category_blog_id = $(this).data('id_category');
            Swal.fire({
                    title: "Xoá danh mục",
                    text: "Bạn có chắc là muốn xóa danh mục không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-category-blog/' + category_blog_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá danh mục thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 0) {
                                    Swal.fire("Thất bại", "Danh mục đang có bài viết!",
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
