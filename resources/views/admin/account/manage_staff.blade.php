<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách tài khoản
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý tài khoản nhân viên</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <span class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalPopovers2">
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
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form_add_staff" >
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên nhân viên:</label>
                                <input name="name" type="text" class="form-control form-control-solid" id="admin_name"
                                    placeholder="Tên nhân viên" />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input autocomplete="off" name="email" type="email" class="form-control form-control-solid"
                                    id="admin_email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input name="phone" type="text" class="form-control form-control-solid" id="admin_phone"
                                    placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu:</label>
                                <input autocomplete="new-password" name="password" type="password" class="form-control form-control-solid"
                                    id="admin_password" placeholder="Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu:</label>
                                <input name="cpassword" type="password" class="form-control form-control-solid"
                                    placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Phân quyền:</label>
                                <select id="admin_role" class="form-control">
                                    <option value="1">Quản lý</option>
                                    <option value="0">Nhân viên</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_staff" type="button" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phân quyền</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="card-body">
                            <input type="hidden" id="edit_admin_id">
                            <div class="form-group">
                                <label>Họ tên:</label>
                                <input readonly type="text" class="form-control form-control-solid" id="edit_admin_name"
                                    placeholder="Tên danh mục" />
                            </div>
                            <div class="form-group">
                                <label>Phân quyền:</label>
                                <select id="edit_admin_role" class="form-control">
                                    <option value="1">Quản lý</option>
                                    <option value="0">Nhân viên</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_staff" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Quyền</th>
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
            ajax: '{{ url('/fetchdata-staff') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'admin_name'
                },
                {
                    'data': 'admin_email'
                },
                {
                    'data': 'admin_phone'
                },
                {
                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.admin_role == 1) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id_admin='${row.admin_id}' style="cursor: pointer" class="view_role label label-lg label-light-success label-inline">Quản lý</span>\
                            `;
                        } else if (row.admin_role == 0) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id_admin='${row.admin_id}' style="cursor: pointer" class="view_role label label-lg label-light-primary label-inline"">Nhân viên</span>\
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
                            <span data-id_admin='${row.admin_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        const strongPassword = function() {
            return {
                validate: function(input) {
                    const value = input.value;
                    if (value === '') {
                        return {
                            valid: true,
                        };
                    }

                    if (value.length < 8) {
                        return {
                            valid: false,
                        };
                    }

                    if (value === value.toLowerCase()) {
                        return {
                            valid: false,
                        };
                    }

                    if (value === value.toUpperCase()) {
                        return {
                            valid: false,
                        };
                    }

                    if (value.search(/[0-9]/) < 0) {
                        return {
                            valid: false,
                        };
                    }

                    return {
                        valid: true,
                    };
                },
            };
        };
        var validation;
        var form = KTUtil.getById('form_add_staff');
        FormValidation.validators.checkPassword = strongPassword;
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền họ và tên'
                            },
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền số điện thoại'
                            },
                            phone: {
                                country: 'US',
                                message: 'Số điện thoại này không đúng định dạng'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền email'
                            },
                            emailAddress: {
                                message: 'Email này không hợp lệ'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mật khẩu'
                            },
                            checkPassword: {
                                message: 'Mật khẩu ít nhất 8 kí tự gồm cả số và chữ viết hoa, viết thường'
                            },
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng điền mật khẩu'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Hai mật khẩu vui lòng trùng nhau'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $(document).on('click', '.view_role', function(e) {
            e.preventDefault();
            var admin_id = $(this).data('id_admin');
            $.ajax({
                url: 'view-role/' + admin_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_admin_id').val(response.data.admin_id);
                    $('#edit_admin_name').val(response.data.admin_name);
                    $('#edit_admin_role').val(response.data.admin_role);
                }
            })
        });
        $(document).on('click', '#update_staff', function(e) {
            var admin_id = $('#edit_admin_id').val();
            var admin_role = $('#edit_admin_role').val();
            $.ajax({
                url: 'update-staff/' + admin_id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    admin_id: admin_id,
                    admin_role: admin_role,
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Cập nhật quyền thành công!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        i = 0;
                        table.ajax.reload();
                    } else if (data == 0) {
                        Swal.fire("Thất bại", "Ít nhất phải có 1 quản lý!", "error");
                    } else if (data == 2) {
                        Swal.fire("Thành công", "Bạn đã không còn quyền quản lý nữa!",
                            "success");
                        location.reload();
                    }
                }
            })
        });
        $('#add_staff').click(function() {
            var email = $('#admin_email').val();
            var name = $('#admin_name').val();
            var phone = $('#admin_phone').val();
            var password = $('#admin_password').val();
            var role = $('#admin_role').val();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    $.ajax({
                        url: '{{ url('/signup-admin') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            admin_email: email,
                            admin_name: name,
                            admin_phone: phone,
                            admin_password: password,
                            admin_role: role
                        },
                        success: function(data) {
                            if (data == 0) {
                                Swal.fire("", "Email này đã được sử dụng!","warning");
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Tạo tài khoản thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            }
                        }
                    })
                } else {
                    swal.fire({
                        text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại .",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Đồng ý!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var admin_id = $(this).data('id_admin');
            Swal.fire({
                    title: "Xoá tài khoản",
                    text: "Bạn có chắc là muốn xóa tài khoản không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-staff/' + admin_id,
                            method: 'GET',
                            success: function(data) {
                                if (data == 2) {
                                    Swal.fire("", "Bạn không được xoá chính mình!", "warning");
                                } else if (data == 0) {
                                    Swal.fire("", "Bạn không được xoá quản lý!", "warning");
                                } else {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá tài khoản thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                }
                            },
                        });
                    }
                });
            e.preventDefault();
        });
    })
</script>
