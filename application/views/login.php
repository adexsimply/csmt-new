<!DOCTYPE html>
<html>
    <head>
        <title>CSMT - Login page</title>
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        <link href="<?php echo base_url(); ?>assets/css/font.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    </head>
    <body class="auth-wrapper">
        <div class="all-wrapper menu-side with-pattern">
            <div class="auth-box-w">
                <div class="logo-w">
                    <a href="#"><img alt="logo" src="<?php echo base_url(); ?>assets/img/logo.png" style="width: 80px"></a>
                </div>
                <h4 class="auth-header">
                    Login Form
                </h4>
                <form id="form-signin">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input class="form-control" required="" placeholder="Enter your username" name="username" type="text">
                        <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                                    <div class="validation-message" data-field="username"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input class="form-control" required="" placeholder="Enter your password" name="password" type="password">
                        <div class="pre-icon os-icon os-icon-fingerprint"></div>
                                    <div class="validation-message" data-field="password"></div>
                    </div>
                    <div class="buttons-w">
                        <button class="btn btn-primary" id="sign-in">Log in</button>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">Remember Me
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script type="text/javascript">
    ////Signin script starts here       
    $('#sign-in').on("click", function() {
        login();
    });
    $("#form-signin").keypress(function(event) {
        if (event.which == 13) {
            login();
        }
    });

    function login() {
        $('#sign-in').html("Authenticating...").attr('disabled', true);
        var data = $('#form-signin').serialize();
        $.post("<?php echo base_url() . 'auth/login_attempt'; ?>", data).done(function(data) {
            if (data.status == "success") {
                window.location.replace("<?php echo base_url(); ?>");
            } else {
                $('#sign-in').html("Login").attr('disabled', false);
                $('.validation-message').html('');
                $('.validation-message').each(function() {
                    for (var key in data) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(data[key]);
                        }
                    }
                });
            }
        });
    }
    /////////////End of Signin script
</script>