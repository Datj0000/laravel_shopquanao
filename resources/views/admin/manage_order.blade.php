<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách đơn hàng
                <span class="d-block text-muted pt-2 font-size-sm">Quản lý đơn hàng của shop</span>
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
        </div>
    </div>
    {{-- View --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" id="load_order"></div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-separate table-head-custom table-checkable display nowrap" cellspacing="0"
            width="100%" id="kt_datatable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Thời gian đặt</th>
                    <th>Người đặt</th>
                    <th>Chi tiết</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-order') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': 'order_code'
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        return moment(row.created_at).format('DD-MM-YYYY');
                    }
                },
                {
                    'data': 'customer_name'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_order='${row.order_id}' class="view_order btn btn-sm btn-clean btn-icon" title="Chi tiết đơn">\
								<i class="la la-eye"></i>\
							</span>\
                            `
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.shipping_method == 2) {
                            return `\
                            <span class="label label-lg label-light-success label-inline">Đã thanh toán</span>\
                            `;
                        } else if (row.shipping_method == 1) {
                            return `\
                            <span class="label label-lg label-light-primary label-inline"">Chưa thanh toán</span>\
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
                        if (row.order_status == 1) {
                            return `\
                            <span data-order_status='2' data-id_order='${row.order_id}' class="delivery label label-lg label-light-success label-inline" style="cursor: pointer">Đang xử lý</span>\
                            `;
                        } else if (row.order_status == 2) {
                            return `\
                            <span class="label label-lg label-light-warning label-inline" style="cursor: wait">Đang giao</span>\
                            `;
                        }
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
        $(document).on('click', '.view_order', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id_order');
            $.ajax({
                url: 'view-order/' + order_id,
                method: 'GET',
                success: function(response) {
                    $('#load_order').html(response);
                }
            })
        });
        $(document).on('click', '.delivery', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id_order');
            var order_status = $(this).data('order_status');
            Swal.fire({
                    title: "Xác nhận",
                    text: "Bạn có chắc là muốn giao đơn hàng không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delivery-order',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr(
                                    'content')
                            },
                            data: {
                                order_status: order_status,
                                order_id: order_id
                            },
                            success: function(feedback) {
                                if(feedback == 1){
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Giao đơn hàng thành công!",
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
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id_order');
            Swal.fire({
                    title: "Xoá đơn hàng",
                    text: "Bạn có chắc là muốn xóa đơn hàng không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-order/' + order_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá đơn hàng thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 2) {
                                    Swal.fire("Thất bại", "Xoá đơn hàng thất bại!",
                                        "error");
                                }
                            },
                        });
                    }
                });
        });
    })
</script>
