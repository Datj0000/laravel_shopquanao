<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách thương hiệu sản phẩm
                {{-- <span class="d-block text-muted pt-2 font-size-sm">extended pagination options</span> --}}
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                    fill="#000000" opacity="0.3" />
                                <path
                                    d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                    fill="#000000" />
                            </g>
                        </svg>
                    </span>Export</button>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose
                            an option:</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
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
                </span>New Record</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thương hiệu sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên thương hiệu:</label>
                                <input type="text" class="form-control form-control-solid" id="brand_name"
                                    placeholder="Tên thương hiệu" />
                                <span class="form-text text-muted">Vui lòng điền tên thương hiệu sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả thương hiệu:</label>
                                <textarea placeholder="Mô tả thương hiệu" id="brand_desc"
                                    class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">Vui lòng mô tả thương hiệu sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select id="brand_status" class="form-control">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiện</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_brand" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thương hiệu sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <input type="hidden" id="edit_brand_id">
                            <div class="form-group">
                                <label>Tên thương hiệu:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_brand_name"
                                    placeholder="Tên thương hiệu" />
                                <span class="form-text text-muted">Vui lòng điền tên thương hiệu sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả thương hiệu:</label>
                                <textarea placeholder="Mô tả thương hiệu" id="edit_brand_desc"
                                    class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">Vui lòng mô tả thương hiệu sản phẩm</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_brand" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Tên thương hiệu</th>
                    <th>Mô tả</th>
                    <th>Hiển thị</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    function ChangeToSlug(brand_name) {
        brand_name = brand_name.toLowerCase();
        brand_name = brand_name.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        brand_name = brand_name.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        brand_name = brand_name.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        brand_name = brand_name.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        brand_name = brand_name.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        brand_name = brand_name.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        brand_name = brand_name.replace(/đ/gi, 'd');
        brand_name = brand_name.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        brand_name = brand_name.replace(/ /gi, "-");
        brand_name = brand_name.replace(/\-\-\-\-\-/gi, '-');
        brand_name = brand_name.replace(/\-\-\-\-/gi, '-');
        brand_name = brand_name.replace(/\-\-\-/gi, '-');
        brand_name = brand_name.replace(/\-\-/gi, '-');
        brand_name = '@' + brand_name + '@';
        brand_name = brand_name.replace(/\@\-|\-\@|\@/gi, '');
        return brand_name;
    }
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-brand') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'brand_name'
                },
                {
                    'data': 'brand_desc'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.brand_status == 0) {
                            return `\
                            <span data-id_brand='${row.brand_id}' class="unactivecat btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_brand='${row.brand_id}' class="activecat btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_brand='${row.brand_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_brand='${row.brand_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $('#add_brand').on('click', function(e) {
            var brand_name = $('#brand_name').val();
            var brand_desc = $('#brand_desc').val();
            var brand_status = $('#brand_status').val();
            var brand_slug = ChangeToSlug(brand_name);
            var _token = $('input[name="_token"]').val();
            if (brand_name == "" || brand_desc == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'save-brand',
                    method: 'POST',
                    data: {
                        brand_name: brand_name,
                        brand_desc: brand_desc,
                        brand_status: brand_status,
                        brand_slug: brand_slug,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm thương hiệu thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Thương hiệu đã trùng tên!", "error");
                        }
                    }
                })
            }
            e.preventDefault();
        })
        $(document).on('click', '#update_brand', function(e) {
            var brand_id = $('#edit_brand_id').val();
            var brand_name = $('#edit_brand_name').val();
            var brand_desc = $('#edit_brand_desc').val();
            var brand_slug = ChangeToSlug(brand_name);
            var _token = $('input[name="_token"]').val();
            if (brand_name == "" || brand_desc == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'update-brand/' + brand_id,
                    method: 'POST',
                    data: {
                        brand_id: brand_id,
                        brand_name: brand_name,
                        brand_desc: brand_desc,
                        brand_slug: brand_slug,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa thương hiệu thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "thương hiệu đã trùng tên!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var brand_id = $(this).data('id_brand');
            $.ajax({
                url: 'edit-brand/' + brand_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_brand_id').val(response.data.brand_id);
                    $('#edit_brand_name').val(response.data.brand_name);
                    $('#edit_brand_desc').val(response.data.brand_desc);
                }
            })
        });
        $(document).on('click', '.activecat', function(e) {
            var brand_id = $(this).data('id_brand');
            $.ajax({
                url: 'active-brand/' + brand_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã hiện thị thương hiệu!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });
            e.preventDefault();
        });
        $(document).on('click', '.unactivecat', function(e) {
            var brand_id = $(this).data('id_brand');
            $.ajax({
                url: 'unactive-brand/' + brand_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã ẩn thương hiệu!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });
            e.preventDefault();
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var brand_id = $(this).data('id_brand');
            Swal.fire({
                    title: "Xoá thương hiệu",
                    text: "Bạn có chắc là muốn xóa thương hiệu không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-brand/' + brand_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá thương hiệu thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 0) {
                                    Swal.fire("Thất bại", "Thương hiệu đang có sản phẩm!",
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
