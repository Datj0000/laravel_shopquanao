<link rel="stylesheet" href="{{ asset('public/backend/assets/css/bootstrap-tagsinput.css') }}">
<style type="text/css">
    #displayImg img {
        width: 90px;
        margin-right: 15px;
        display: inline-block;
        margin-bottom: 15px;
    }

    #edit_displayImg img {
        width: 90px;
        margin-right: 15px;
        display: inline-block;
        margin-bottom: 15px;
    }

    [type="file"] {
        height: 0;
        overflow: hidden;
        width: 0;
    }

    [type="file"]+label {
        background: #f15d22;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: 'Rubik', sans-serif;
        font-size: inherit;
        font-weight: 500;
        margin-bottom: 1rem;
        outline: none;
        padding: 1rem 50px;
        position: relative;
        transition: all 0.3s;
        vertical-align: middle;
    }

</style>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Danh sách bài viết
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm bài viết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Danh mục:</label>
                                <select id="blog_category" name="blog_category" class="form-control">
                                    @foreach ($cate_blog as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên bài viết:</label>
                                <input type="text" class="form-control form-control-solid" name="blog_name"
                                    id="blog_name" placeholder="Tên bài viết" />
                                <span class="form-text text-muted">Vui lòng điền tên bài viết</span>
                            </div>
                            <div class="form-group">
                                <label>Nội dung bài viết:</label>
                                <textarea placeholder="Nội dung bài viết" id="blog_desc"
                                    class="form-control form-control-solid"></textarea>
                                <span class="form-text text-muted">Vui lòng nội dung bài viết</span>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị:</label>
                                <select id="blog_status" class="form-control">
                                    <option value="0">Hiện</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh:</label><br>
                                <input type="file" id="blog_image" onchange="ImagesFileAsURL()" />
                                <label style="margin-top: 20px" for="blog_image"
                                    class="btn btn-light-primary font-weight-bolder">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14"
                                                    rx="1" />
                                                <path
                                                    d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </span>Tải ảnh</label>
                            </div>
                            <div class="form-group">
                                <div id="displayImg"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="add_blog" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Sửa bài viết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="edit_blog_id">
                        <div class="form-group">
                            <label>Danh mục:</label>
                            <select id="edit_blog_category" class="form-control">
                                @foreach ($cate_blog as $key => $cate)
                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên bài viết:</label>
                            <input type="text" class="form-control form-control-solid" id="edit_blog_name"
                                placeholder="Tên bài viết" />
                            <span class="form-text text-muted">Vui lòng điền tên bài viết</span>
                        </div>
                        <div class="form-group">
                            <label>Nội dung bài viết:</label>
                            <textarea placeholder="Nội dung bài viết" id="edit_blog_desc"
                                class="form-control form-control-solid"></textarea>
                            <span class="form-text text-muted">Vui lòng nội dung bài viết</span>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh:</label><br>
                            <input type="file" id="edit_blog_image" onchange="edit_ImagesFileAsURL()" />
                            <label style="margin-top: 20px" for="edit_blog_image"
                                class="btn btn-light-primary font-weight-bolder">
                                <span class="svg-icon menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14"
                                                rx="1" />
                                            <path
                                                d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                </span>Tải ảnh</label>
                        </div>
                        <div class="form-group">
                            <div id="edit_displayImg"></div>
                        </div>
                        <div class="card-footer">
                            <button id="update_blog" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <th>Danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Tên bài viết</th>
                    <th>Hiển thị</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    var myEditor;
    ClassicEditor
        .create(document.querySelector('#blog_desc'))
        .then(editor => {
            console.log( 'Editor was initialized', editor );
            myEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#edit_blog_desc'))
        .then(editor => {
            edit_blog_desc = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script type="text/javascript">
    function ImagesFileAsURL() {
        var fileSelected = document.getElementById('blog_image').files;
        if (fileSelected.length > 0) {
            var fileToLoad = fileSelected[0];
            var fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement('img');
                newImage.src = srcData;
                document.getElementById('displayImg').innerHTML = newImage.outerHTML;
            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }

    function edit_ImagesFileAsURL() {
        var fileSelected = document.getElementById('edit_blog_image').files;
        if (fileSelected.length > 0) {
            var fileToLoad = fileSelected[0];
            var fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement('img');
                newImage.src = srcData;
                document.getElementById('edit_displayImg').innerHTML = newImage.outerHTML;
            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }

    function ChangeToSlug(blog_name) {
        blog_name = blog_name.toLowerCase();
        blog_name = blog_name.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        blog_name = blog_name.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        blog_name = blog_name.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        blog_name = blog_name.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        blog_name = blog_name.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        blog_name = blog_name.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        blog_name = blog_name.replace(/đ/gi, 'd');
        blog_name = blog_name.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        blog_name = blog_name.replace(/ /gi, "-");
        blog_name = blog_name.replace(/\-\-\-\-\-/gi, '-');
        blog_name = blog_name.replace(/\-\-\-\-/gi, '-');
        blog_name = blog_name.replace(/\-\-\-/gi, '-');
        blog_name = blog_name.replace(/\-\-/gi, '-');
        blog_name = '@' + blog_name + '@';
        blog_name = blog_name.replace(/\@\-|\-\@|\@/gi, '');
        return blog_name;
    }
    $(document).ready(function() {
        var i = 0;
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-blog') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1;
                    }
                },
                {
                    'data': 'category_name'
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
                    'data': 'blog_name'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.blog_status == 0) {
                            return `\
                            <span data-id_blog='${row.blog_id}' class="unactivecat btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_blog='${row.blog_id}' class="activecat btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_blog='${row.blog_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_blog='${row.blog_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $(document).on('click', '#add_blog', function(e) {
            var error = 0;
            var blog_category = $('#blog_category').val();
            var blog_name = $('#blog_name').val();
            var blog_slug = ChangeToSlug(blog_name);
            var blog_desc = myEditor.getData();
            var blog_status = $('#blog_status').val();
            var blog_image = $('#blog_image').get(0).files[0];
            var _token = $('input[name="_token"]').val();
            var form_data = new FormData();
            if (blog_image) {
                var name = blog_image.name;
                var fsize = blog_image.size;
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Swal.fire("Thất bại", "Vui lòng tải ảnh lên!", "error");
                    error++;
                } else if (fsize > 2000000) {
                    Swal.fire("Thất bại", "Ảnh quá lớn!", "error");
                    error++;
                } else {
                    form_data.append("blog_image", blog_image);
                }
            }
            if (error == 0) {
                form_data.append("blog_category", blog_category);
                form_data.append("blog_name", blog_name);
                form_data.append("blog_desc", blog_desc);
                form_data.append("blog_status", blog_status);
                form_data.append("blog_slug", blog_slug);
                form_data.append("_token", _token);
                if (blog_image == "" || blog_category == "" || blog_name == "" || blog_desc == "") {
                    Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
                } else {
                    $.ajax({
                        url: "{{ url('/save-blog') }}",
                        method: 'POST',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Thêm bài viết thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            } else if (data == 0) {
                                Swal.fire("Thất bại", "bài viết đã trùng tên!", "error");
                            } else if (data == 2) {
                                Swal.fire("Thất bại", "Thêm bài viết thất bại!", "error");
                            }
                        }
                    })
                }
            }

        })
        $(document).on('click', '#update_blog', function(e) {
            var blog_id = $('#edit_blog_id').val();
            var blog_category = $('#edit_blog_category').val();
            var blog_name = $('#edit_blog_name').val();
            var blog_slug = ChangeToSlug(blog_name);
            var blog_desc = edit_blog_desc.getData();
            var blog_image = $('#edit_blog_image').get(0).files[0];
            var _token = $('input[name="_token"]').val();
            var error = 0;
            var form_data = new FormData();
            if (blog_image) {
                var name = blog_image.name;
                var fsize = blog_image.size;
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Swal.fire("Thất bại", "Vui lòng tải ảnh lên!", "error");
                    error++;
                } else if (fsize > 2000000) {
                    Swal.fire("Thất bại", "Ảnh quá lớn!", "error");
                    error++;
                } else {
                    form_data.append("blog_image", blog_image);
                }
            }
            if (error == 0) {
                form_data.append("blog_image", blog_image);
                form_data.append("blog_category", blog_category);
                form_data.append("blog_name", blog_name);
                form_data.append("blog_desc", blog_desc);
                form_data.append("blog_slug", blog_slug);
                form_data.append("_token", _token);
                if (blog_image == "" || blog_category == "" || blog_name == "" || blog_desc == "") {
                    Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
                } else {
                    $.ajax({
                        url: "{{ url('/update-blog') }}" + '/' + blog_id,
                        method: 'POST',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data == 1) {
                                i = 0;
                                table.ajax.reload();
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Sửa bài viết thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else if (data == 0) {
                                Swal.fire("Thất bại", "bài viết đã trùng tên!", "error");
                            } else if (data == 2) {
                                Swal.fire("Thất bại", "Sửa bài viết thất bại!", "error");
                            }
                        }
                    })
                };
            }

        })
        $(document).on('click', '.edit', function(e) {
            var blog_id = $(this).data('id_blog');
            $.ajax({
                url: 'edit-blog/' + blog_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_blog_id').val(response.data.blog_id);
                    $('#edit_blog_category').val(response.data.category_id);
                    $('#edit_blog_name').val(response.data.blog_name);
                    edit_blog_desc.setData(response.data.blog_desc);

                }
            })
        });
        $(document).on('click', '.activecat', function(e) {
            var blog_id = $(this).data('id_blog');
            $.ajax({
                url: 'active-blog/' + blog_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã hiển thị bài viết!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.ajax.reload();
                    i = 0;
                }
            });
        });
        $(document).on('click', '.unactivecat', function(e) {
            var blog_id = $(this).data('id_blog');
            $.ajax({
                url: 'unactive-blog/' + blog_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã ẩn bài viết!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });
        });
        $(document).on('click', '.delete', function(e) {
            var blog_id = $(this).data('id_blog');
            Swal.fire({
                    title: "Xoá bài viết",
                    text: "Bạn có chắc là muốn xóa bài viết không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-blog/' + blog_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá bài viết thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 2) {
                                    Swal.fire("Thất bại", "Xoá bài viết thất bại!",
                                        "error");
                                }
                            },
                        });
                    }
                });

        });
    })
</script>
