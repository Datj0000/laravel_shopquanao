<div class="form-block mx-auto">
    <div style="display: flex">
        <h3 onclick="load_login();;" style="width: 25%; cursor: pointer;" class="text-uppercase"><i class="fa fa-arrow-left" aria-hidden="true"></i></h3>
        <h3 class="text-uppercase">Tạo tài khoản</h3>
    </div>
    <form>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="text" class="form-control" placeholder="Email" id="username">
        </div>
        <div class="form-group">
            <label for="username">Họ tên</label>
            <input type="text" class="form-control" placeholder="Họ tên của bạn" id="name">
        </div>
        <div class="form-group">
            <label for="username">Số điện thoại</label>
            <input type="text" class="form-control" placeholder="Số điện thoại của bạn" id="phone">
        </div>
        <div class="form-group last mb-3">
            <label for="password">Mật khẩu</label>
            <input autocomplete="new-password" type="password" class="form-control" placeholder="Mật khẩu" id="password">
        </div>
        <div class="form-group last mb-3">
            <label for="re-password">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="re-password">
        </div>

        <div class="d-sm-flex mb-5 align-items-center">
            <label class="control control--checkbox mb-0"><span class="caption">Tạo tài khoản có nghĩa là bạn đồng ý với các
                 <a href="#">Điều khoản và Điều kiện</a> cũng như <a href="#">Chính sách Bảo mật của chúng tôi</a>.</span>
                <input type="checkbox" checked="checked" />
                <div class="control__indicator"></div>
            </label>
        </div>

        <button id="signup" type="button" class="btn btn-block py-2 btn-primary">Đăng kí</button>

        <span class="text-center my-3 d-block">or</span>


        <div class="">
            <a href="#" class="btn btn-block py-2 btn-facebook">
                <span class="icon-facebook mr-3"></span> Register with Facebook
            </a>
            <a href="#" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Register with
                Google</a>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#signup').click(function() {
                var email = $('#username').val();
                var name = $('#name').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                var repassword = $('#re-password').val();
                var phoneRegex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
                var emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;
                var passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

                if (email == "" || name == "" || repassword == "" || password == "" || phone == "") {
                    Swal.fire("", "Vui lòng điền đủ thông tin!", "warning");
                } else if (!emailRegex.test(email)) {
                    Swal.fire("", "Email không hợp lệ!", "warning");
                } else if (!phoneRegex.test(phone)) {
                    Swal.fire("", "Vui lòng kiểm tra lại số điện thoại!", "warning");
                } else if (repassword != password) {
                    Swal.fire("", "Mật khẩu và mật khẩu nhập lại phải trùng với nhau!", "warning");
                } else if (password.length < 8) {
                    Swal.fire("", "Mật khẩu quá ngắn!", "warning");
                } else if (password.length > 20) {
                    Swal.fire("", "Mật khẩu quá dài!", "warning");
                } else if (!passRegex.test(password)) {
                    Swal.fire("", "Mật khẩu cần ít nhất 1 chữ cái hoặc 1 số!", "warning");
                } else {
                    $.ajax({
                        url: '{{ url('/signup') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            customer_email: email,
                            customer_name: name,
                            customer_phone: phone,
                            customer_password: password,
                        },
                        success: function(data) {
                            console.log(data);
                            if (data == 0) {
                                Swal.fire("", "Email này đã được sử dụng!", "warning");
                            } else {
                                Swal.fire({
                                        title: "Thành công",
                                        text: "Bạn có muốn đến trang đăng nhập không?",
                                        icon: "question",
                                        showCancelButton: true,
                                        confirmButtonText: "Đồng ý!",
                                        cancelButtonText: "Không"
                                    })
                                    .then(function(result) {
                                        load_login();
                                    });
                            }
                        }
                    })
                }
            })
        })
    </script>
</div>
