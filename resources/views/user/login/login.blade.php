<div class="form-block mx-auto">
    <div class="text-center mb-5">
        <h3 class="text-uppercase">Đăng nhập <strong>Colorlib</strong></h3>
    </div>
    <form action="#" method="post">
        <div class="form-group first">
            <label for="username">Email</label>
            <input type="text" class="form-control" placeholder="Email" id="username">
        </div>
        <div class="form-group last mb-3">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" placeholder="Mật khẩu" id="password">
        </div>

        <div class="d-sm-flex mb-5 align-items-center">
            <span onclick="load_signup()" class="mb-3 mb-sm-0"><span class="forgot-pass">Đăng kí ngay</span></span>
            <span onclick="load_forgotpass()" class="ml-auto"><span class="forgot-pass">Quên mật
                    khẩu</span></span>
        </div>

        <button id="login" type="button" class="btn btn-block py-2 btn-primary">Đăng nhập</button>

        <span class="text-center my-3 d-block">or</span>


        <div class="___class_+?17___">
            <a href="{{url('/login-facebook')}}" class="btn btn-block py-2 btn-facebook">
                <span class="icon-facebook mr-3"></span> Đăng nhập với facebook
            </a>
            <a href="{{url('/login-google')}}" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Đăng nhập với
                Google</a>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#login').click(function() {
                var email = $('#username').val();
                var password = $('#password').val();
                var emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;

                if (email == "" || password == "") {
                    Swal.fire("", "Vui lòng điền đủ thông tin!", "warning");
                } else if (!emailRegex.test(email)) {
                    Swal.fire("", "Email không hợp lệ!", "warning");
                } else {
                    $.ajax({
                        url: '{{ url('/login') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            customer_email: email,
                            customer_password: password,
                        },
                        success: function(data) {
                            if (data == 0) {
                                Swal.fire("", "Sai tài khoản hoặc mật khẩu!", "warning");
                            } else if (data == 1) {
                                var totalPage = window.history.length;
                                if (totalPage > 1) {
                                    history.back()
                                } else {
                                    window.location = "{{ url('/trang-chu') }}";
                                }
                            }
                        }
                    })
                }
            })
        })
    </script>
</div>
