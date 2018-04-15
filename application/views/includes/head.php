<!DOCTYPE html>
<html>
  <head>
    <title>CSMT - Dashboard </title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="csmt dashboard" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url(); ?>assets/favicon.png" rel="shortcut icon">
    <link href="<?php echo base_url(); ?>assets/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="<?php echo base_url(); ?>assets/https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/icon_fonts_assets/themefy/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  </head>
  <body>
    <div class="all-wrapper menu-side menu-top solid-bg-all">
      <div class="top-menu-secondary with-overflow color-scheme-dark">
        <!--------------------
        START - Messages Link in secondary top menu
        -------------------->
        <div class="logo-w menu-size">
          <a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png"><span>CSMT</span></a>
        </div>
        
        <!--------------------
        START - Top Menu Controls
        -------------------->
        <div class="top-menu-controls">
          <div class="element-search d-none d-xl-block">
            <input placeholder="Start typing to search..." type="text">
          </div>
          <div class="top-icon top-search d-xl-none">
            <i class="os-icon os-icon-ui-37"></i>
          </div>          
         
          <!--------------------
          START - Settings Link in secondary top menu
          -------------------->
          <div class="top-icon top-settings os-dropdown-trigger os-dropdown-center">
            <i class="os-icon os-icon-ui-46"></i>
            <div class="os-dropdown">
              <div class="icon-w">
                <i class="os-icon os-icon-ui-46"></i>
              </div>
              <ul>
                <li>
                  <a href="#"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                </li>
                <li>
                  <a href="#"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a>
                </li>
                <li>
                  <a href="#"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a>
                </li>
                <li>
                  <a href="#"><i class="os-icon os-icon-ui-15"></i><span>Deactivate Account</span></a>
                </li>
              </ul>
            </div>
          </div>
          <!--------------------
          END - Settings Link in secondary top menu
          --------------------><!--------------------
          START - User avatar and menu in secondary top menu
          -------------------->
          <div class="logged-user-w">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="<?php echo base_url(); ?>assets/img/avatar1.jpg">
              </div>
              <div class="logged-user-menu">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="<?php echo base_url(); ?>assets/img/avatar1.jpg">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                     <?php echo $active_user->username; ?>
                    </div>
                    <div class="logged-user-role">
                     <?php echo $active_user->username; ?>
                    </div>
                  </div>
                </div>
                <div class="bg-icon">
                  <i class="os-icon os-icon-wallet-loaded"></i>
                </div>
                <ul>
                  <li>
                    <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                  </li>
                  <li>
                    <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                  </li>
                  <li>
                    <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--------------------
          END - User avatar and menu in secondary top menu
          -------------------->
        </div>
        <!--------------------
        END - Top Menu Controls
        -------------------->
      </div>