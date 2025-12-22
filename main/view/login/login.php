<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>PCI </b>Digitalization</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="# method=" post">
                    <div class="input-group mb-3">
                        <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="login_type">
                            <option selected="selected">Select login method</option>
                            <option value="0">RTDC Account</option>
                            <option value="1">PCI Account</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="User" id="login_username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-alt">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="login_password">
                        <div class=" input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 offset-3">
                            <button type="button" class="btn btn-success btn-block" id="login_button"> <i class="fas fa-sign-in-alt"></i>&nbsp; Sign In</button>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<script>
    $(function() {

        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });


        $('#login_button').on('click', function() {

            if ($('#login_username').val() == '' || $('#login_password').val() == '' || $('#login_type option:selected').text() == 'Select login method') {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please input your login information.'
                })
                return;
            } else {
                if ($('#login_type option:selected').text() == 'RTDC Account') {
                    $.post('/cognex/one-app/main/route/user.php', {
                        action: 'loginUser',
                        username: $('#login_username').val(),
                        password: $('#login_password').val(),
                    }, function(data) {
                        console.log(data);
                        if (typeof data.error === 'undefined') {
                            if (data.result['status'] == 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.result['message']
                                })
                                setTimeout(function() {
                                    window.location.href = "index.php";
                                    $('#main_sidebar').show();
                                }, 1500);

                            } else if (data.result['status'] == 'error') {
                                Toast.fire({
                                    icon: 'warning',
                                    title: data.result['message']
                                })
                            }
                        } else {
                            console.log(data.error);
                        }
                    }, 'json');
                } else {
                    $.post('main/route/user.php', {
                        action: 'UserLoginAD',
                        username: $('#login_username').val(),
                        password: $('#login_password').val(),
                    }, function(data) {
                        if (typeof data.error === 'undefined') {

                           if (data.result['status'] == 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.result['message']
                                })
                                setTimeout(function() {
                                    window.location.href = "index.php";
                                    $('#main_sidebar').show();
                                }, 1500);

                            } else if (data.result['status'] == 'error') {
                                Toast.fire({
                                    icon: 'warning',
                                    title: data.result['message']
                                })
                            }
                        } else {
                            console.log(data.error);
                        }
                    }, 'json');
                }
            }
        });
    });
</script>