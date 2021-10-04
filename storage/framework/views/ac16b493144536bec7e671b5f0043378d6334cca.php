<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name')); ?> | <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('storage/images/logo.ico')); ?>" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <!-- <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo e(asset('css/datatables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" >

    <link href="<?php echo e(asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('bower_components/slick-carousel/slick/slick.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('icon_fonts_assets/simple-line-icons/css/simple-line-icons.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('icon_fonts_assets/themefy/themify-icons.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('icon_fonts_assets/picons-thin/style.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet" >
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

    <!-- Font awesome -->
    <link href="<?php echo e(asset('fa/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('fa/css/v4-shims.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/confirm.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/special.css')); ?>" rel="stylesheet">
    <style type="text/css">
        .pageLoading{
            display: none !important;
        }
    </style>
</head>
<body id="motherBody" class="menu-position-side menu-side-left full-screen with-content-pane pageLoading">

        <!-- Modal to disable page and show page loading process -->
        <div class="modal hide" style="position:fixed;top:50%;z-index: 999999999;margin-left: auto;margin-right: auto;" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-body text-center">
                <div id="ajax_loader">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('layouts.side-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        <?php echo $__env->make('layouts.top-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <!-- Alert -->
        <?php if(Session::get('success')): ?>
            <?php echo Addon::alertSuccess(Session::get('success')); ?> 
        <?php elseif(Session::get('error')): ?>
            <?php echo Addon::alertDanger(Session::get('success')); ?>

        <?php endif; ?>


        <?php echo $__env->yieldContent('content'); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/datatables.min.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script> -->
    <script src="<?php echo e(asset('bower_components/popper.js/dist/umd/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/chart.js/dist/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap-validator/dist/validator.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/dropzone/dist/dropzone.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('bower_components/editable-table/mindmup-editabletable.js')); ?>"></script> -->
    <!-- <script src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script> -->
    <!-- <script src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script> -->
    <script src="<?php echo e(asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/tether/dist/js/tether.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/slick-carousel/slick/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/util.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/alert.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/button.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/collapse.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/dropdown.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/modal.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/tab.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/tooltip.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap/js/dist/popover.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sticky-tabs.js')); ?>"></script>
    <script src="<?php echo e(asset('js/ois.js')); ?>"></script>
    <script src="<?php echo e(asset('js/function.js')); ?>"></script>
    <script src="<?php echo e(asset('js/select-list-option.js')); ?>"></script>
    <script src="<?php echo e(asset('js/confirm.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js?version=4.2.0')); ?>"></script>


    <?php echo $__env->make('layouts.select', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('modal'); ?>
    <?php echo $__env->yieldContent('script'); ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#motherBody').removeClass('pageLoading');
        });
    </script>
</body>
</html>
