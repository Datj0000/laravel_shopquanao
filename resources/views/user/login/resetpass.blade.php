<div class="form-block mx-auto">
    <div class="text-center mb-5">
        <div style="display: flex">
            <h3 onclick="load_login();;" style="width: 25%; cursor: pointer;" class="text-uppercase"><i
                    class="fa fa-arrow-left" aria-hidden="true"></i></h3>
            <h3 class="text-uppercase">Lấy lại mật khẩu</h3>
        </div>
    </div>
    <form>
        <div class="form-group">
            <label for="token">Mã token</label>
            <input type="text" class="form-control" placeholder="Mã token" id="token">
        </div>
        <div class="form-group last mb-3">
            <label for="password">Mật khẩu</label>
            <input autocomplete="new-password" type="password" class="form-control" placeholder="Mật khẩu"
                id="password">
        </div>
        <div class="form-group last mb-3">
            <label for="re-password">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="re-password">
        </div>
        <button id="reset" type="button" class="btn btn-block py-2 btn-primary">Đăng kí</button>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#reset').click(function() {
                var token = $('#token').val();
                var password = $('#password').val();
                var repassword = $('#re-password').val();
                var passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

                if (token == "" || repassword == "" || password == "") {
                    Swal.fire("", "Vui lòng điền đủ thông tin!", "warning");
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
                        url: '{{ url('/reset-pass') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                        },
                        data: {
                            customer_token: token,
                            customer_password: password,
                        },
                        success: function(data) {
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
                    })
                }
            })
        })
    </script>
</div>
