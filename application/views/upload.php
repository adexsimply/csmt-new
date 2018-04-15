<!DOCTYPE html>
<html>
<head>
    <title>Upload Score</title>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/sweetalert/dist/sweetalert.css'; ?>"/>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/disabler-enabler/disabler.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/disabler-enabler/enabler.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/sweetalert/dist/sweetalert.min.js'; ?>"></script>
</head>
<body>
<form method="post" id="form-signin">
    Select Session Name:<input type="text" name="session_names"><br/>
    Select Term Name:<input type="text" name="term_name">
<button id="sign-in">Uplaod Result</button>
</form>
 <br/>
</body>
</html>

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
        $.post("<?php echo base_url() . 'auth/upload_score'; ?>", data).done(function(data) {
                alert('Upload Successful');
            if (data.status == "success") {
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