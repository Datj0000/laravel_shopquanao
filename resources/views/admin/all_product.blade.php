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
            <h3 class="card-label">Danh sách sản phẩm
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Thương hiệu:</label>
                                <select id="product_brand" name="product_brand" class="form-control">
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục:</label>
                                <select id="product_category" name="product_category" class="form-control">
                                    @foreach ($cate_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm:</label>
                                <input type="text" class="form-control form-control-solid" name="product_name"
                                    id="product_name" placeholder="Tên sản phẩm" />
                                <span class="form-text text-muted">Vui lòng điền tên sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm:</label>
                                <input type="text" name="product_price" class="form-control form-control-solid"
                                    id="product_price" data-validation="number" placeholder="Giá sản phẩm" />
                                <span class="form-text text-muted">Vui lòng điền giá sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Tồn kho:</label>
                                <input type="text" name="product_quantity" class="form-control form-control-solid"
                                    id="product_quantity" data-validation="number" placeholder="Số sản phẩm tồn kho" />
                                <span class="form-text text-muted">Vui lòng điền số sản phẩm tồn kho</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm:</label>
                                <textarea placeholder="Mô tả sản phẩm" id="product_desc"
                                    class="form-control form-control-solid"></textarea>
                                <span class="form-text text-muted">Vui lòng mô tả sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị:</label>
                                <select id="product_status" class="form-control">
                                    <option value="0">Hiện</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select id="product_top" class="form-control">
                                    <option value="1">Không nổi bật</option>
                                    <option value="0">Nổi bật</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tags sản phẩm:</label><br>
                                <input value="" type="text" class="form-control form-control-solid" id="product_tags"
                                    data-role="tagsinput" />
                                <span class="form-text text-muted">Vui lòng điền tags sản phẩm</span>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh:</label><br>
                                <input type="file" id="product_image" onchange="ImagesFileAsURL()" />
                                <label style="margin-top: 20px" for="product_image"
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
                            <button id="add_product" type="button" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Sửa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="edit_product_id">
                        <div class="form-group">
                            <label>Thương hiệu:</label>
                            <select id="edit_product_brand" class="form-control">
                                @foreach ($brand_product as $key => $brand)
                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Danh mục:</label>
                            <select id="edit_product_category" class="form-control">
                                @foreach ($cate_product as $key => $cate)
                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-solid" id="edit_product_name"
                                placeholder="Tên sản phẩm" />
                            <span class="form-text text-muted">Vui lòng điền tên sản phẩm</span>
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm:</label>
                            <input type="text" class="form-control form-control-solid" id="edit_product_price"
                                data-validation="number" placeholder="Giá sản phẩm" />
                            <span class="form-text text-muted">Vui lòng điền giá sản phẩm</span>
                        </div>
                        <div class="form-group">
                            <label>Tồn kho:</label>
                            <input type="text" class="form-control form-control-solid" id="edit_product_quantity"
                                data-validation="number" placeholder="Số sản phẩm tồn kho" />
                            <span class="form-text text-muted">Vui lòng điền số sản phẩm tồn kho</span>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm:</label>
                            <textarea placeholder="Mô tả sản phẩm" id="edit_product_desc"
                                class="form-control form-control-solid"></textarea>
                            <span class="form-text text-muted">Vui lòng mô tả sản phẩm</span>
                        </div>
                        <div class="form-group">
                            <label>Tags sản phẩm:</label><br>
                            <input type="text" class="form-control form-control-solid" id="edit_product_tags" />
                            <span class="form-text text-muted">Vui lòng điền tags sản phẩm</span>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh:</label><br>
                            <input type="file" id="edit_product_image" onchange="edit_ImagesFileAsURL()" />
                            <label style="margin-top: 20px" for="edit_product_image"
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
                            <button id="update_product" type="button" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Gallery --}}
    <div class="modal fade" id="exampleModalPopovers3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Quản lý ảnh mô tả</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="gallery_id">
                        <div class="form-group">
                            <label>Hình ảnh:</label><br>
                            <input type="file" id="gallery_image" multiple />
                            <label style="margin-top: 20px" for="gallery_image" class="btn btn-primary mr-2">
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
                    </form>
                    <div id="gallery_load"></div>
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
                    <th>Thương hiệu</th>
                    <th>Danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Đã bán</th>
                    <th>Ảnh mô tả</th>
                    <th>Hiển thị</th>
                    <th>Nổi bật</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script src="{{ asset('public/backend/assets/js/bootstrap-tagsinput.min.js') }}"></script>
<script>
    var myEditor;
    ClassicEditor.create(document.querySelector('#product_desc'))
        .then(editor => {
            myEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#edit_product_desc'))
        .then(editor => {
            edit_product_desc = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script type="text/javascript">
    function ImagesFileAsURL() {
        var fileSelected = document.getElementById('product_image').files;
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
        var fileSelected = document.getElementById('edit_product_image').files;
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

    function load_gallery(product_id) {
        $.ajax({
            url: 'view-gallery/' + product_id,
            method: 'GET',
            data: {
                product_id: product_id,
            },
            success: function(data) {
                $('#gallery_load').html(data);
            }
        });
    }

    function ChangeToSlug(product_name) {
        product_name = product_name.toLowerCase();
        product_name = product_name.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        product_name = product_name.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        product_name = product_name.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        product_name = product_name.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        product_name = product_name.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        product_name = product_name.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        product_name = product_name.replace(/đ/gi, 'd');
        product_name = product_name.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        product_name = product_name.replace(/ /gi, "-");
        product_name = product_name.replace(/\-\-\-\-\-/gi, '-');
        product_name = product_name.replace(/\-\-\-\-/gi, '-');
        product_name = product_name.replace(/\-\-\-/gi, '-');
        product_name = product_name.replace(/\-\-/gi, '-');
        product_name = '@' + product_name + '@';
        product_name = product_name.replace(/\@\-|\-\@|\@/gi, '');
        return product_name;
    }
    $(document).ready(function() {
        var i = 0;
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        var table = $('#kt_datatable').DataTable({
            ajax: '{{ url('/fetchdata-product') }}',
            columns: [{
                    'data': null,
                    render: function() {
                        return i = i + 1;
                    }
                },
                {
                    'data': 'brand_name'
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
                            <img class="img-thumbnail" style="width: 60px"
                            src="{{ asset('public/uploads/product/${row.product_image}') }}" />
                            `
                    }
                },
                {
                    'data': 'product_name'
                },
                {
                    'data': 'product_sold'
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        return `\
                            <span data-toggle="modal" data-target="#exampleModalPopovers3" data-id_product='${row.product_id}' class="viewImages btn btn-sm btn-clean btn-icon" title="Xem ảnh sản phẩm">\
								<i class="la la-pencil"></i>\
							</span>\
                            `;
                    }
                },
                {
                    'data': null,
                    sortable: false,
                    width: '75px',
                    overflow: 'visible',
                    autoHide: false,
                    render: function(data, type, row) {
                        if (row.product_status == 0) {
                            return `\
                            <span data-id_product='${row.product_id}' class="unactivecat btn btn-sm btn-clean btn-icon" title="Đang hiển thị">\
								<i class="la la-eye"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_product='${row.product_id}' class="activecat btn btn-sm btn-clean btn-icon" title="Đang ẩn">\
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
                        if (row.product_top == 0) {
                            return `\
                            <span data-id_product='${row.product_id}' class="unfeatured btn btn-sm btn-clean btn-icon" title="Đang không trên top nổi bật">\
								<i class="la la-arrow-up"></i>\
							</span>\
                            `;
                        } else {
                            return `\
                            <span data-id_product='${row.product_id}' class="featured btn btn-sm btn-clean btn-icon" title="Đang trên top nổi bật">\
								<i class="la la-arrow-down"></i>\
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
                            <span data-toggle="modal" data-target="#exampleModalPopovers2" data-id_product='${row.product_id}' class="edit btn btn-sm btn-clean btn-icon" title="Sửa">\
								<i class="la la-edit"></i>\
							</span>\
                            <span  data-id_product='${row.product_id}' class="delete btn btn-sm btn-clean btn-icon" title="Xoá">\
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
        $(document).on('click', '#add_product', function(e) {
            var error = 0;
            var product_tags = $('#product_tags').val();
            var product_category = $('#product_category').val();
            var product_brand = $('#product_brand').val();
            var product_name = $('#product_name').val();
            var product_slug = ChangeToSlug(product_name);
            var product_price = $('#product_price').val();
            var product_desc = myEditor.getData();
            var product_status = $('#product_status').val();
            var product_top = $('#product_top').val();
            var product_quantity = $('#product_quantity').val();
            var product_image = $('#product_image').get(0).files[0];
            var _token = $('input[name="_token"]').val();
            var Regex = /^\d+$/;
            var form_data = new FormData();
            if (product_image) {
                var name = product_image.name;
                var fsize = product_image.size;
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Swal.fire("Thất bại", "Vui lòng tải ảnh lên!", "error");
                    error++;
                } else if (fsize > 2000000) {
                    Swal.fire("Thất bại", "Ảnh quá lớn!", "error");
                    error++;
                } else {
                    form_data.append("product_image", product_image);
                }
            }
            if (error == 0) {
                form_data.append("product_category", product_category);
                form_data.append("product_brand", product_brand);
                form_data.append("product_name", product_name);
                form_data.append("product_price", product_price);
                form_data.append("product_desc", product_desc);
                form_data.append("product_tags", product_tags);
                form_data.append("product_quantity", product_quantity);
                form_data.append("product_status", product_status);
                form_data.append("product_slug", product_slug);
                form_data.append("product_top", product_top);
                form_data.append("_token", _token);
                if (product_quantity == "" || product_image == "" || product_category == "" ||
                    product_brand == "" || product_name == "" || product_price ==
                    "" || product_tags == "" || product_desc == ""
                ) {
                    Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
                } else if (!Regex.test(product_price)) {
                    Swal.fire("Thất bại", "Giá chỉ được nhập số nguyên!", "error");
                } else if (!Regex.test(product_quantity)) {
                    Swal.fire("Thất bại", "Số lượng chỉ được nhập số nguyên!", "error");
                } else {
                    $.ajax({
                        url: "{{ url('/save-product') }}",
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
                                    text: "Thêm sản phẩm thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                i = 0;
                                table.ajax.reload();
                            } else if (data == 0) {
                                Swal.fire("Thất bại", "Sản phẩm đã trùng tên!", "error");
                            }
                        }
                    })
                }
            }

        })
        $(document).on('click', '#update_product', function(e) {
            var product_id = $('#edit_product_id').val();
            var product_tags = $('#edit_product_tags').val();
            var product_category = $('#edit_product_category').val();
            var product_brand = $('#edit_product_brand').val();
            var product_name = $('#edit_product_name').val();
            var product_slug = ChangeToSlug(product_name);
            var product_price = $('#edit_product_price').val();
            var product_desc = edit_product_desc.getData();
            var product_quantity = $('#edit_product_quantity').val();
            var product_image = $('#edit_product_image').get(0).files[0];
            var _token = $('input[name="_token"]').val();
            var Regex = /^\d+$/;
            var error = 0;
            var form_data = new FormData();
            if (product_image) {
                var name = product_image.name;
                var fsize = product_image.size;
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Swal.fire("Thất bại", "Vui lòng tải ảnh lên!", "error");
                    error++;
                } else if (fsize > 2000000) {
                    Swal.fire("Thất bại", "Ảnh quá lớn!", "error");
                    error++;
                } else {
                    form_data.append("product_image", product_image);
                }
            }

            if (error == 0) {
                form_data.append("product_image", product_image);
                form_data.append("product_category", product_category);
                form_data.append("product_brand", product_brand);
                form_data.append("product_name", product_name);
                form_data.append("product_price", product_price);
                form_data.append("product_desc", product_desc);
                form_data.append("product_tags", product_tags);
                form_data.append("product_slug", product_slug);
                form_data.append("product_quantity", product_quantity);
                form_data.append("_token", _token);
                if (product_quantity == "" || product_image == "" || product_category == "" ||
                    product_brand == "" || product_name == "" || product_price ==
                    "" || product_tags == "" || product_desc == ""
                ) {
                    Swal.fire("Thất bại", "Vui lòng không để trống các thông tin!", "error");
                } else if (!Regex.test(product_price)) {
                    Swal.fire("Thất bại", "Giá chỉ được nhập số nguyên!", "error");
                } else if (!Regex.test(product_quantity)) {
                    Swal.fire("Thất bại", "Số lượng chỉ được nhập số nguyên!", "error");
                } else {
                    $.ajax({
                        url: "{{ url('/update-product') }}" + '/' + product_id,
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
                                    text: "Sửa sản phẩm thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else if (data == 0) {
                                Swal.fire("Thất bại", "Sản phẩm đã trùng tên!", "error");
                            }
                        }
                    })
                };
            }

        })
        $(document).on('click', '.edit', function(e) {
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'edit-product/' + product_id,
                method: 'GET',
                success: function(response) {
                    $('#edit_product_id').val(response.data.product_id);
                    $('#edit_product_category').val(response.data.category_id);
                    $('#edit_product_brand').val(response.data.brand_id);
                    $('#edit_product_name').val(response.data.product_name);
                    $('#edit_product_price').val(response.data.product_price);
                    $('#edit_product_quantity').val(response.data.product_quantity);
                    $('#edit_product_tags').tagsinput('removeAll');
                    $('#edit_product_tags').tagsinput('add', response.data.product_tags);
                    edit_product_desc.setData(response.data.product_desc);
                }
            })

        });
        $(document).on('click', '.activecat', function(e) {
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'active-product/' + product_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã hiển thị sản phẩm!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.ajax.reload();
                    i = 0;
                }
            });
        });
        $(document).on('click', '.unactivecat', function(e) {
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'unactive-product/' + product_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đã ẩn sản phẩm!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });
        });
        $(document).on('click', '.featured', function(e) {
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'featured-product/' + product_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Sản phẩm đã lên top nổi bật!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });

        });
        $(document).on('click', '.unfeatured', function(e) {
            var product_id = $(this).data('id_product');
            $.ajax({
                url: 'unfeatured-product/' + product_id,
                method: 'GET',
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Sản phẩm đã không còn trên top nổi bật!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    i = 0;
                    table.ajax.reload();
                }
            });

        });
        $(document).on('click', '.delete', function(e) {

            var product_id = $(this).data('id_product');
            Swal.fire({
                    title: "Xoá sản phẩm",
                    text: "Bạn có chắc là muốn xóa sản phẩm không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'delete-product/' + product_id,
                            method: 'GET',
                            success: function(feedback) {
                                if (feedback == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Xoá sản phẩm thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    i = 0;
                                    table.ajax.reload();
                                } else if (feedback == 2) {
                                    Swal.fire("Thất bại", "Xoá sản phẩm thất bại!",
                                        "error");
                                }
                            },
                        });
                    }
                });

        });
        $(document).on('click', '.viewImages', function(e) {
            var product_id = $(this).data('id_product');
            load_gallery(product_id);
        });
        $('#gallery_image').change(function() {
            var product_id = $('#gallery_product_id').val();
            var gallery_image = $('#gallery_image')[0].files;
            console.log(gallery_image);
            if (gallery_image.length > 5) {
                Swal.fire("Thất bại", "Không được tải quá 5 ảnh mô tả!", "error");
                error++;
            } else {
                for (var c = 0; c < gallery_image.length; c++) {
                    var name = document.getElementById('gallery_image').files[c].name;
                    var ext = name.split('.').pop().toLowerCase();
                    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        Swal.fire("Thất bại", "Vui lòng tải ảnh lên!", "error");
                        error++;
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById('gallery_image').files[c]);
                    var fsize = gallery_image.size;
                    if (fsize > 2000000) {
                        Swal.fire("Thất bại", "Ảnh quá lớn!", "error");
                    } else {
                        var form_data = new FormData();
                        form_data.append("gallery_image[]", document.getElementById(
                            'gallery_image').files[c]);
                        $.ajax({
                            url: "{{ url('/insert-gallery') }}" + '/' + product_id,
                            method: 'POST',
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                            },
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công",
                                        text: "Thêm ảnh thành công!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    load_gallery(product_id);
                                }
                            }
                        })
                    }
                }
            }
        });
        $(document).on('click', '.delete-gallery', function() {
            var gal_id = $(this).data('gal_id');
            var product_id = $('#gallery_product_id').val();
            Swal.fire({
                    title: "Xoá ảnh",
                    text: "Bạn có chắc là muốn xóa ảnh không?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không"
                })
                .then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('/delete-gallery') }}",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr(
                                    'content')
                            },
                            data: {
                                gal_id: gal_id,
                            },
                            success: function(data) {
                                load_gallery(product_id);
                            }
                        });
                    }
                });
        });
        $(document).on('change', '.file_image', function() {
            var product_id = $('#gallery_product_id').val();
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-" + gal_id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
            form_data.append("gal_id", gal_id);
            $.ajax({
                url: "{{ url('/update-gallery') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    load_gallery(product_id)
                }
            });

        });
    })
</script>
