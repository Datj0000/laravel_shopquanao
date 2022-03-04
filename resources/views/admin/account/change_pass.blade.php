<form class="form" autocomplete="off" novalidate="novalidate" id="kt_login_change_form">
    <div class="card card-custom card-stretch">
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Đổi mật khẩu</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Đổi mật khẩu cho tài khoản của bạn</span>
            </div>
            <div class="card-toolbar">
                <button type="button" id="kt_login_change_submit" class="btn btn-success mr-2">Lưu thay đổi</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="form-group">
                    <label>Mật khẩu cũ:</label>
                    <input id="old_password" class="form-control form-control-solid" type="password"
                        placeholder="Mật khẩu cũ" name="opassword" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label>Mật khẩu mới:</label>
                    <input id="password" class="form-control form-control-solid" type="password"
                        placeholder="Mật khẩu mới" name="password" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu:</label>
                    <input id="re_password" class="form-control form-control-solid" type="password"
                        placeholder="Nhập lại mật khẩu" name="cpassword" autocomplete="off" />
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const strongPassword = function() {
        return {
            validate: function(input) {
                const value = input.value;
                if (value === '') {
                    return {
                        valid: true,
                    };
                }

                if (value.length < 8) {
                    return {
                        valid: false,
                    };
                }

                if (value === value.toLowerCase()) {
                    return {
                        valid: false,
                    };
                }

                if (value === value.toUpperCase()) {
                    return {
                        valid: false,
                    };
                }

                if (value.search(/[0-9]/) < 0) {
                    return {
                        valid: false,
                    };
                }

                return {
                    valid: true,
                };
            },
        };
    };
    var validation;
    var form = KTUtil.getById('kt_login_change_form');
    FormValidation.validators.checkPassword = strongPassword;
    validation = FormValidation.formValidation(
        form, {
            fields: {
                opassword: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng điền mật khẩu cũ'
                        },
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng điền mật khẩu mới'
                        },
                        checkPassword: {
                            message: 'Mật khẩu ít nhất 8 kí tự gồm cả số và chữ viết hoa, viết thường'
                        },
                    }
                },
                cpassword: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng nhập lại mật khẩu mới'
                        },
                        identical: {
                            compare: function() {
                                return form.querySelector('[name="password"]').value;
                            },
                            message: 'Hai mật khẩu vui lòng trùng nhau'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap()
            }
        }
    );
    $('#kt_login_change_submit').on('click', function(e) {
        e.preventDefault();
        var admin_old_password = $('#old_password').val();
        var admin_password = $('#password').val();
        validation.validate().then(function(status) {
            if (status != 'Valid') {
                swal.fire({
                    text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại .",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Đồng ý!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    KTUtil.scrollTop();
                });
            } else {
                $.ajax({
                    url: '{{ url('/admin/change-new-pass') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token" ]').attr('content')
                    },
                    data: {
                        admin_old_password: admin_old_password,
                        admin_password: admin_password,
                    },
                    success: function(data) {
                        if (data == 0) {
                            Swal.fire("", "Mật khẩu cũ không đúng!", "warning");
                        } else if (data == 1) {
                            Swal.fire("", "Đổi mật khẩu thành công!", "success");
                        }
                    }
                })
            }
        });
    });
</script>
