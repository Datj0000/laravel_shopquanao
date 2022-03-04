<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách phí ship
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
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm phí ship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Thành phố:</label>
                                <select id="fee_matp" class="form-control">
                                    @foreach ($city as $key => $value)
                                        <option value="{{ $value->matp }}">{{ $value->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phí ship:</label>
                                <input type="text" class="form-control form-control-solid" id="fee_feeship"
                                    placeholder="Phí ship" />
                                <span class="form-text text-muted">Vui lòng phí ship</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_delivery" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sửa phí ship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <input type="hidden" id="edit_fee_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Thành phố:</label>
                                    <select id="edit_fee_matp" class="form-control">
                                        @foreach ($city as $key => $ci)
                                            <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phí ship:</label>
                                    <input type="text" class="form-control form-control-solid" id="edit_fee_feeship"
                                        placeholder="Phí ship" />
                                    <span class="form-text text-muted">Vui lòng phí ship</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_delivery" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Thành phố</th>
                    <th>Phí ship</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-delivery') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'name_city'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return formatter.format(row.fee_feeship);
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_fee='${row.fee_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_fee='${row.fee_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $('#add_delivery').on('click', function(e) {
            var fee_matp = $('#fee_matp').val();
            var fee_feeship = $('#fee_feeship').val();
            var Regex = /^\d+$/;
            var _token = $('input[name="_token"]').val();
            if (fee_matp == "" || fee_feeship == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else if (!Regex.test(fee_feeship)) {
                Swal.fire("Thất bại", "Giá ship chỉ được nhập số nguyên!", "error");
            } else {
                $.ajax({
                    url: 'insert-delivery',
                    method: 'POST',
                    data: {
                        fee_matp: fee_matp,
                        fee_feeship: fee_feeship,
                        _token: _token,
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thêm phí ship thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại",
                                "Thành phố, tỉnh này đã được nhập phí rồi!", "error");
                        }
                    }
                })
            }
            e.preventDefault();
        })
        $(document).on('click', '#update_delivery', function(e) {
            var fee_id = $('#edit_fee_id').val();
            var fee_matp = $('#edit_fee_matp').val();
            var fee_feeship = $('#edit_fee_feeship').val();
            var Regex = /^\d+$/;
            var _token = $('input[name="_token"]').val();
            if (fee_matp == "" || fee_feeship == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else if (!Regex.test(fee_feeship)) {
                Swal.fire("Thất bại", "Giá ship chỉ được nhập số nguyên!", "error");
            } else {
                $.ajax({
                    url: 'update-delivery/' + fee_id,
                    method: 'POST',
                    data: {
                        fee_id: fee_id,
                        fee_matp: fee_matp,
                        fee_feeship: fee_feeship,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Sửa phí ship thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                        } else if (data == 0) {
                            Swal.fire("Thất bại",
                                "Thành phố, tỉnh này đã được nhập phí rồi!", "error");
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var fee_id = $(this).data('id_fee');
            $.ajax({
                url: 'edit-delivery/' + fee_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_fee_id').val(response.data.fee_id);
                    $('#edit_fee_matp').val(response.data.fee_matp);
                    $('#edit_fee_feeship').val(response.data.fee_feeship);
                }
            })
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var fee_id = $(this).data('id_fee');
            Swal.fire({
                    title: "Xoá phí ship",
                    text: "Bạn có chắc là muốn xóa phí ship không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-delivery/' + fee_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá phí ship thành công!",
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
        });
    })
</script>
