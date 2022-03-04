<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/frontend/login/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/login/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/login/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/login/css/sweetalert2.css') }}">
    <script src="{{ asset('public/frontend/login/js/sweetalert2.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    <title>Tài khoản</title>
</head>

<body>
    <div class="d-md-flex half">
        <div class="bg" style="background-image: url('public/frontend/login/images/bg_1.jpg');"></div>
        <div class="contents">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div id="content" class="col-md-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/frontend/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/login/js/main.js') }}"></script>
    <script>
        load_login();
        check_login();
        function check_login(){
            $.ajax({
                url: '{{ url('/check-login-user') }}',
                method: 'GET',
                success: function(response) {
                    if(response == 1){
                        history.back();
                    }
                }
            })
        };
        function load_login(){
            $.ajax({
                url: '{{ url('/login-user') }}',
                method: 'GET',
                success: function(response) {
                    $('#content').html(response);
                }
            })
        };
        function load_signup(){
            $.ajax({
                url: '{{ url('/signup-user') }}',
                method: 'GET',
                success: function(response) {
                    $('#content').html(response);
                }
            })
        };
        function load_forgotpass(){
            $.ajax({
                url: '{{ url('/forgotpass-user') }}',
                method: 'GET',
                success: function(response) {
                    $('#content').html(response);
                }
            })
        };
        function load_resetpass(){
            $.ajax({
                url: '{{ url('/view-reset-pass') }}',
                method: 'GET',
                success: function(response) {
                    $('#content').html(response);
                }
            })
        };
    </script>
</body>

</html>
