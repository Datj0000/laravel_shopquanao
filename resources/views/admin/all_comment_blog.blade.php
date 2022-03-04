<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách bình luận bài viết
                {{-- <span class="d-block text-muted pt-2 font-size-sm">extended pagination options</span> --}}
            </h3>
        </div>
    </div>
    {{-- Reply --}}
    <div class="modal fade" id="exampleModalPopovers2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trả lời bình luận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <input type="hidden" id="blog_id">
                            <input type="hidden" id="comment_id">
                            <div class="form-group">
                                <label>Trả lời:</label>
                                <textarea placeholder="Trả lời" id="comment_desc"
                                    class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">Vui lòng trả lời bình luận bài viết</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="reply_comment" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Duyệt</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Bài viết</th>
                    <th>Người bình luận</th>
                    <th>Bình luận</th>
                    <th>Trả lời</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-comment-blog') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.comment_status == 0) {
                            return `\
                            <span data-id_comment='${row.comment_id}' data-id_allow='1' class="allowcomment btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_comment='${row.comment_id}' data-id_allow='0' class="allowcomment btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
								<i class="la la-eye-slash"></i>\
							</span>\
                            `;
                        }
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.comment_rep == 1) {
                            return `\
                            <span class="btn btn-sm btn-clean btn-icon" title="Đã trả lời">\
								<i class="la la-check"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span class="btn btn-sm btn-clean btn-icon" title="Chưa trả lời">\
								<i class="la la-close"></i>\
							</span>\
                            `;
                        }
                    }
                },
                {
                    'data': null,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return moment(row.comment_date).format('DD-MM-YYYY');
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <img class="img-thumbnail" style="max-width: 70px"
                            src="{{ asset('public/uploads/blog/${row.blog_image}') }}" />
                            `
                    }
                },
                {
                    'data': 'comment_name'
                },
                {
                    'data': 'comment'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_comment='${row.comment_id}' data-id_product='${row.product_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-reply"></i>\
							</span>\
                            `
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '60px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `
                            <span  data-id_comment='${row.comment_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $(document).on('click', '#reply_comment', function(e) {
            var comment_blog_id = $('#blog_id').val();
            var comment_id = $('#comment_id').val();
            var comment = $('#comment_desc').val();
            var _token = $('input[name="_token"]').val();
            if (comment == "") {
                Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
            } else {
                $.ajax({
                    url: 'reply-comment-blog',
                    method: 'POST',
                    data: {
                        comment_id: comment_id,
                        comment_blog_id: comment_blog_id,
                        comment: comment,
                        _token: _token,
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Đã trả lời bình luận thành công!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            i = 0;
                            table.ajax.reload();
                            $('#comment_desc').val('');
                        }
                    }
                })
            }
        })
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var comment_id = $(this).data('id_comment');
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'view-reply-comment-blog/' + comment_id,
                method: 'GET',
                success: function(response) {
                    $('#comment_id').val(response.data.comment_id);
                    $('#blog_id').val(response.data.comment_blog_id);
                }
            })
        });
        $(document).on('click', '.allowcomment', function(e) {
            var comment_id = $(this).data('id_comment');
            var comment_status = $(this).data('id_allow');
            $.ajax({
                url: 'allow-comment-blog',
                method: 'POST',
                data: {
                    comment_id: comment_id,
                    comment_status: comment_status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã thay đổi trạng thái bình luận!",
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
            var comment_id = $(this).data('id_comment');
            Swal.fire({
                    title: "Xoá bình luận",
                    text: "Bạn có chắc là muốn xóa bình luận không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-comment-blog/' + comment_id,
                            method: 'GET',
                            success: function(feedback) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Xoá bình luận thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            },
                        });
                    }
                });
            e.preventDefault();
        });
    })
</script>
