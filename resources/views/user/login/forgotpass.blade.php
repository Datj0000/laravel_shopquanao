<div class="form-block mx-auto">
    <div style="display: flex">
        <h3 onclick="load_login();;" style="width: 25%;  cursor: pointer;" class="text-uppercase"><i class="fa fa-arrow-left" aria-hidden="true"></i></h3>
        <h3 class="text-uppercase">Quên mật khẩu</h3>
    </div>
    <form action="#" method="post">
        <div class="form-group">
            <label for="email_forgot">Email</label>
            <input type="text" class="form-control" placeholder="your-email@gmail.com" id="email_forgot">
        </div>
        <input id="forgot_pass" type="button" value="Gửi" class="btn btn-block py-2 btn-primary">
    </form>
</div>
<script>
    function _send_token(customer_email) {
        $.ajax({
            url: 'send-token',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data: {
                customer_email: customer_email,
            }
        })
    }
    $('#forgot_pass').on('click', function(e) {
        var customer_email = $('#email_forgot').val();
        $.ajax({
            url: 'check-user',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
            },
            data: {
                customer_email: customer_email,
            },
            success: function(data) {
                if (data == 0) {
                    Swal.fire("", "Email này chưa đăng kí tài khoản!", "warning");
                } else if (data == 1) {
                    Swal.fire("", "Vui lòng kiểm tra email để lấy lại mật khẩu!", "success");
                    _send_token(customer_email);
                    load_resetpass();
                }
            }
        })
    })
</script>
