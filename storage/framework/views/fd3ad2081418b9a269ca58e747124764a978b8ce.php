<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->
    <link href="<?php echo e(asset('css/special.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('fa/css/font-awesome.css')); ?>" rel="stylesheet">


        <link href="<?php echo e(asset('storage/favicon.png')); ?>" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/dropzone/dist/dropzone.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/fullcalendar/dist/fullcalendar.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('bower_components/slick-carousel/slick/slick.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">


</head>


     <body class="auth-wrapper">
        <div class="all-wrapper menu-side with-pattern">
            <div class="auth-box-w">
                <div class="logo-w">
                    <a href="index.php"><img alt="" src="img/logo-big.png"></a>
                </div>
                <h4 class="auth-header">
                    Login Form
                </h4>


                <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>



                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div>
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                        </div>



                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="control-label">Password</label>

                            <div>
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    </div>


                    <div class="form-group">
                            <div class="">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                </form>
            </div>
        </div>
  


<script src="<?php echo e(asset('js/app.js')); ?>"></script>

            
    
</body>
</html>