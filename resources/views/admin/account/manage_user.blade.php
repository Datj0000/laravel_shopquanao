<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách tài khoản
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý tài khoản nhân viên</span>
            </h3>
        </div>
    </div>
    {{-- Add --}}
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
                            <input type="hidden" id="edit_customer_id">
                            <div class="form-group">
                                <label>Họ tên:</label>
                                <input readonly type="text" class="form-control form-control-solid" id="edit_customer_name"
                                    placeholder="Họ và tên" />
                            </div>
                            <div class="form-group">
                                <label>Phân quyền:</label>
                                <select id="edit_customer_role" class="form-control">
                                    <option value="1">Vip</option>
                                    <option value="0">Không có</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_customer" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Vip</th>
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
            ajax: '{{ url('/fetchdata-user') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'customer_name'
                },
                {
                    'data': 'customer_email'
                },
                {
                    'data': 'customer_phone'
                },
                {
                    'data': null,
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.customer_role == 1) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id_customer='${row.customer_id}' style="cursor: pointer" class="view_role_customer label label-lg label-light-success label-inline">Vip Member</span>\
                            `;
                        } else if (row.customer_role == 0) {
                            return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers" data-id_customer='${row.customer_id}' style="cursor: pointer" class="view_role_customer label label-lg label-light-primary label-inline"">---</span>\
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
                            <span data-id_customer='${row.customer_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $(document).on('click', '.view_role_customer', function(e) {
            e.preventDefault();
            var customer_id = $(this).data('id_customer');
            $.ajax({
                url: 'view-role-customer/' + customer_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_customer_id').val(response.data.customer_id);
                    $('#edit_customer_name').val(response.data.customer_name);
                    $('#edit_customer_role').val(response.data.customer_role);
                }
            })
        });
        $(document).on('click', '#update_customer', function(e) {
            var customer_id = $('#edit_customer_id').val();
            var customer_role = $('#edit_customer_role').val();
            $.ajax({
                url: 'update-customer/' + customer_id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                data: {
                    customer_id: customer_id,
                    customer_role: customer_role,
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
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var customer_id = $(this).data('id_customer');
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
                            url: 'delete-customer/' + customer_id,
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
