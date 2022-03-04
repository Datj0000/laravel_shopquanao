<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <base href="../../../"> --}}
    <meta charset="utf-8" />
    <title>Đăng nhập</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('public/backend/assets/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/media/logos/favicon.ico') }}" />
</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                    <a href="#" class="text-center pt-2">
                        <img src="{{ asset('public/backend/assets/media/logos/logo.png') }}" class="max-h-75px"
                            alt="" />
                    </a>
                    <div class="d-flex flex-column-fluid flex-column flex-center">
                        <div class="login-form login-signin py-11">
                            <form class="form" novalidate="novalidate" id="kt_login_signin_form">
                                <div class="text-center pb-8">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Đăng nhập</h2>
                                    {{-- <span class="text-muted font-weight-bold font-size-h4">Or
										<a href="" class="text-primary font-weight-bolder" id="kt_login_signup">Create An Account</a></span> --}}
                                </div>
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                    <input id="admin_email"
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text"
                                        name="username"  />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mật khẩu</label>
                                        <a href="javascript:;"
                                            class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                                            id="kt_login_forgot">Quên mật khẩu ?</a>
                                    </div>
                                    <input id="admin_password"
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                                        type="password" name="password" />
                                </div>
                                <div class="text-center pt-2">
                                    <button id="kt_login_signin_submit"
                                        class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div>
                        <div class="login-form login-forgot pt-11">
                            <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                                <div class="text-center pb-8">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Quên mật khẩu ?</h2>
                                    <p class="text-muted font-weight-bold font-size-h4">Điền Email của bạn để lấy lại mật khẩu</p>
                                </div>
                                <div class="form-group">
                                    <input
                                        id="email_forgot"
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="email" placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                                    <button type="button" id="kt_login_forgot_submit"
                                        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Submit</button>
                                    <button type="button" id="kt_login_forgot_cancel"
                                        class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <div class="login-form login-signup pt-11">
                            <form class="form" autocomplete="off" novalidate="novalidate" id="kt_login_signup_form">
                                <div class="text-center pb-8">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Lấy lại mật khẩu</h2>
                                    <p class="text-muted font-weight-bold font-size-h4">Điền mã và mật khẩu mới của bạn</p>
                                </div>
                                <div class="form-group">
                                    <input id="token" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="Mã token" name="token" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input id="password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Mật khẩu" name="password" autocomplete="new-password" />
                                </div>
                                <div class="form-group">
                                    <input id="re_password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Nhập lại mật khẩu" name="cpassword" autocomplete="off" />
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                                    <button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Submit</button>
                                    <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
                <div
                    class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
                    <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Shop bán hàng
                    </h3>
                    <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">Nền tảng quản lý và bán hàng đa kênh
                        <br />được sử dụng nhiều nhất Việt Nam
                    </p>
                </div>
                <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset('public/backend/assets/media/svg/illustrations/login-visual-2.svg') }});">
                </div>
            </div>
        </div>
    </div>
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <script src="{{ asset('public/backend/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/pages/custom/login/login-general.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
