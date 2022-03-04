<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách mã giảm giá
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
                </span>New Record</span>
        </div>
    </div>
    {{-- Add --}}
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mã giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên mã giảm giá:</label>
                                <input type="text" class="form-control form-control-solid" id="coupon_name"
                                    placeholder="Tên mã giảm giá" />
                                <span class="form-text text-muted">Vui lòng điền tên mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá:</label>
                                <input type="text" class="form-control form-control-solid" id="coupon_code"
                                    placeholder="Mã giảm giá" />
                                <span class="form-text text-muted">Vui lòng điền mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input type="text" class="form-control form-control-solid" id="coupon_time"
                                    placeholder="Số lượng" />
                                <span class="form-text text-muted">Vui lòng điền số lượng mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" class="form-control form-control-solid" id="coupon_start">
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input type="date" class="form-control form-control-solid" id="coupon_end">
                            </div>
                            <div class="form-group">
                                <label>Tính năng:</label>
                                <select id="coupon_condition" class="form-control">
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select id="coupon_status" class="form-control">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Tắt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc tiền giảm:</label>
                                <input type="text" class="form-control form-control-solid" id="coupon_number"
                                    placeholder="Nhập số % hoặc tiền giảm" />
                                <span class="form-text text-muted">Vui lòng điền số % hoặc tiền giảm</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_coupon" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa mã giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <input type="hidden" id="edit_coupon_id">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên mã giảm giá:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_coupon_name"
                                    placeholder="Tên mã giảm giá" />
                                <span class="form-text text-muted">Vui lòng điền tên mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_coupon_code"
                                    placeholder="Mã giảm giá" />
                                <span class="form-text text-muted">Vui lòng điền mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_coupon_time"
                                    placeholder="Số lượng" />
                                <span class="form-text text-muted">Vui lòng điền số lượng mã giảm giá</span>
                            </div>
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" class="form-control form-control-solid" id="edit_coupon_start">
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input value="30/07/2021" type="date" class="form-control form-control-solid"
                                    id="edit_coupon_end">
                            </div>
                            <div class="form-group">
                                <label>Tính năng:</label>
                                <select id="edit_coupon_condition" class="form-control">
                                    <option value="">Chọn mã</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc tiền giảm:</label>
                                <input type="text" class="form-control form-control-solid" id="edit_coupon_number"
                                    placeholder="Tên thương hiệu" />
                                <span class="form-text text-muted">Vui lòng điền số % hoặc tiền giảm</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_coupon" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Tên mã</th>
                    <th>Mã giảm giá</th>
                    <th>Số lần giảm</th>
                    <th>Mức giảm</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var dt = new Date();

        year = dt.getFullYear();
        month = (dt.getMonth() + 1).toString().padStart(2, "0");
        day = dt.getDate().toString().padStart(2, "0");

        var today = year + '-' + month + '-' + day;
        $('#coupon_start').val(today);
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-coupon') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'coupon_name'
                },
                {
                    'data': 'coupon_code'
                },
                {
                    'data': 'coupon_time'
                },
                {

                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.coupon_condition == 1) {
                            return `\
                                ${row.coupon_number} %
                            `;
                        } else {
                            return formatter.format(row.coupon_number);
                        }
                    }
                },
                {
                    'data': 'coupon_date_start'
                },
                {
                    'data': 'coupon_date_end'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.coupon_status == 0) {
                            return `\
                            <span data-id_coupon='${row.coupon_id}' class="unactivecat btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_coupon='${row.coupon_id}' class="activecat btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_coupon='${row.coupon_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span data-id_coupon='${row.coupon_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $('#add_coupon').on('click', function(e) {
            var coupon_name = $('#coupon_name').val();
            var coupon_code = $('#coupon_code').val();
            var coupon_time = $('#coupon_time').val();
            var coupon_condition = $('#coupon_condition').val();
            var coupon_number = $('#coupon_number').val();
            var coupon_status = $('#coupon_status').val();
            var coupon_start = $('#coupon_start').val();
            var coupon_end = $('#coupon_end').val();
            var Regex = /^\d+$/;

            if (coupon_name == "" || coupon_code == "" || coupon_time == "" ||
                coupon_number == "" || coupon_start == "" || coupon_end == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else if (coupon_code.length < 6 || coupon_code.length > 20) {
                Swal.fire("Thất bại", "Mã giảm giá chỉ được từ 6 đến 20 kí tự!", "error");
            } else if (!Regex.test(coupon_number)) {
                Swal.fire("Thất bại", "Mức giảm chỉ được nhập số nguyên!", "error");
            } else if (!Regex.test(coupon_time)) {
                Swal.fire("Thất bại", "Số lượng chỉ được nhập số nguyên!", "error");
            } else if (coupon_number < 0 || coupon_condition == 1 && coupon_number > 100) {
                Swal.fire("Thất bại", "Vui lòng nhập lại mức giảm giá!", "error");
            } else if (coupon_end < today) {
                Swal.fire("Thất bại", "Ngày kết thức không được nhỏ hơn ngày hôm nay!", "error");
            } else if (coupon_start > coupon_end) {
                Swal.fire("Thất bại", "Ngày kết thúc không được nhỏ hơn ngày bất đầu!", "error");
            } else {
                $.ajax({
                    url: 'save-coupon',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        coupon_name: coupon_name,
                        coupon_code: coupon_code,
                        coupon_time: coupon_time,
                        coupon_condition: coupon_condition,
                        coupon_number: coupon_number,
                        coupon_start: coupon_start,
                        coupon_end: coupon_end,
                        coupon_status: coupon_status,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm mã giảm giá thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Mã giảm giá đã tồn tại!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Thêm mã giảm giá thất bại!", "error");
                        }
                    }
                })
            }
            e.preventDefault();
        })
        $(document).on('click', '#update_coupon', function(e) {
            var coupon_id = $('#edit_coupon_id').val();
            var coupon_name = $('#edit_coupon_name').val();
            var coupon_code = $('#edit_coupon_code').val();
            var coupon_time = $('#edit_coupon_time').val();
            var coupon_condition = $('#edit_coupon_condition').val();
            var coupon_number = $('#edit_coupon_number').val();
            var coupon_start = $('#edit_coupon_start').val();
            var coupon_end = $('#edit_coupon_end').val();
            var Regex = /^\d+$/;
            if (coupon_name == "" || coupon_code == "" || coupon_time == "" ||
                coupon_number == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else if (coupon_code.length < 6 || coupon_code.length > 20) {
                Swal.fire("Thất bại", "Mã giảm giá chỉ được từ 6 đến 20 kí tự!", "error");
            } else if (!Regex.test(coupon_number)) {
                Swal.fire("Thất bại", "Mức giảm chỉ được nhập số nguyên!", "error");
            } else if (!Regex.test(coupon_time)) {
                Swal.fire("Thất bại", "Số lượng chỉ được nhập số nguyên!", "error");
            } else if (coupon_number < 0 || coupon_condition == 1 && coupon_number > 100) {
                Swal.fire("Thất bại", "Vui lòng nhập lại mức giảm giá!", "error");
            } else if (coupon_end < today) {
                Swal.fire("Thất bại", "Ngày kết thức không được nhỏ hơn ngày hôm nay!", "error");
            } else if (coupon_start > coupon_end) {
                Swal.fire("Thất bại", "Ngày kết thúc không được nhỏ hơn ngày bất đầu!", "error");
            } else {
                $.ajax({
                    url: 'update-coupon/' + coupon_id,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        coupon_name: coupon_name,
                        coupon_code: coupon_code,
                        coupon_time: coupon_time,
                        coupon_condition: coupon_condition,
                        coupon_number: coupon_number,
                        coupon_start: coupon_start,
                        coupon_end: coupon_end,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa mã giảm giá thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại", "Mã giảm giá đã tồn tại!", "error");
                        } else if (data == 2) {
                            Swal.fire("Thất bại", "Sửa mã giảm giá thất bại!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var coupon_id = $(this).data('id_coupon');
            $.ajax({
                url: 'edit-coupon/' + coupon_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_coupon_id').val(response.data.coupon_id);
                    $('#edit_coupon_name').val(response.data.coupon_name);
                    $('#edit_coupon_code').val(response.data.coupon_code);
                    $('#edit_coupon_time').val(response.data.coupon_time);
                    $('#edit_coupon_condition').val(response.data.coupon_condition);
                    $('#edit_coupon_number').val(response.data.coupon_number);
                    $('#edit_coupon_start').val(response.data.coupon_date_start);
                    $('#edit_coupon_end').val(response.data.coupon_date_end);
                }
            })
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var coupon_id = $(this).data('id_coupon');
            Swal.fire({
                    title: "Xoá thương hiệu",
                    text: "Bạn có chắc là muốn mã giảm giá không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-coupon/' + coupon_id,
                            method: 'GET',
                            success: function(feedback) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Xoá mã giảm giá thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            },
                        });
                    }
                });
        });
        $(document).on('click', '.activecat', function(e) {
            e.preventDefault();
            var coupon_id = $(this).data('id_coupon');
            $.ajax({
                url: 'active-coupon/' + coupon_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã bật mã giảm giá!",
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
            var coupon_id = $(this).data('id_coupon');
            $.ajax({
                url: 'unactive-coupon/' + coupon_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã tắt mã giảm giá!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            })
        });
    })
</script>
