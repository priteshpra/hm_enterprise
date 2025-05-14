<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo label('msg_lbl_site_title_name'); ?>">
    <meta name="keywords" content="<?php echo label('msg_lbl_site_title_name'); ?>">
    <title><?php echo label('msg_lbl_site_title_name'); ?></title>

    <!-- Favicons-->
    <!-- <link rel="icon" href="<?php echo base_url(DEFAULT_WEBSITE_FAVICON); ?>" sizes="32x32"> -->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <!-- Favicons-->
    <!-- CORE CSS-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.clockpicker.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- CSS for full screen (Layout-2)-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- alertify CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/select2.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/pignose.calendar.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.css" />
    <!-- Custome CSS-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- jQuery Library -->
    <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>


</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">

                    <ul class="left">
                        <li class="no-hover"><a href="#" tabindex="997" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu"></i></a></li>
                        <li>
                            <h1 class="logo-wrapper"><a tabindex="998" href="<?php echo site_url('admin-dashboard'); ?>" class="brand-logo darken-1">
                                    <!--  <img class="img-responsive" src="<?php echo $this->config->item('admin_assets'); ?>img/logo_01.png"> -->
                                    <span class="logo-text"><?php echo label('msg_lbl_site_title_name'); ?></span>
                                </a></h1>
                        </li>
                    </ul>
                    <!-- <ul class="right hide-on-med-and-down">
                        <li><a tabindex='999' href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i title="Fullscreen" class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light chat-collapse" data-activates="chat-out"><i class="mdi-social-notifications"></i></a>
                        </li>
                    </ul> -->
                    <ul class="header-project-nav right hide-on-med-and-down">
                        <?php echo $this->CityCombobox; ?>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav leftside-navigation">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <h3 class="user-h3"><?php echo substr($this->session->userdata['FirstName'], 0, 1); ?></h3>
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="<?php echo site_url('my-profile'); ?>"><i class="mdi-action-face-unlock"></i>My Profile</a></li>
                                    <?php
                                    if ($this->UserRoleID == -2 || $this->UserRoleID == -1) { ?>
                                        <li><a href="<?php echo site_url('admin/role'); ?>"><i class="mdi-action-input"></i>Roles</a>
                                        </li>
                                    <?php } ?>
                                    <li><a href="<?php echo site_url('change-password'); ?>"><i class="mdi-communication-vpn-key"></i>Change Password</a>
                                    </li>
                                    <li><a href="<?php echo site_url('logout'); ?>"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    </li>
                                </ul>
                                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">
                                    <p class="wrap_content_header"><?php echo $this->session->userdata['FirstName']; ?></p><i class="mdi-navigation-arrow-drop-down right"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="bold">
                        <a href="<?php echo site_url('admin-dashboard'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-home"></i> Dashboard</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <?php if (in_array("1", $this->module_data)) { ?>
                                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-list"></i> Masters</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <?php
                                            if (in_array("17", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/banner'); ?>">
                                                        Banner
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("23", $this->module_data)) { ?>
                                                <li class="hide"><a class="wrap_content_header" href="<?php echo site_url('admin/masters/country'); ?>">
                                                        Country
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("25", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/city'); ?>">
                                                        City
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("4", $this->module_data)) { ?>
                                                <li class=""><a class="wrap_content_header" href="<?php echo site_url('admin/masters/cms'); ?>">
                                                        Content Management System
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("7", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/emailtemplate'); ?>">
                                                        Email Template
                                                    </a></li>
                                            <?php }
                                            if (in_array("8", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/message'); ?>">
                                                        Message
                                                    </a></li>
                                            <?php }
                                            if (in_array("9", $this->module_data)) { ?>
                                                <li> <a class="wrap_content_header" href="<?php echo site_url('admin/masters/page'); ?>">Page</a></li>
                                            <?php }
                                            if (in_array("20", $this->module_data)) { ?>
                                                <li> <a class="wrap_content_header" href="<?php echo site_url('admin/masters/reason'); ?>">Reason</a></li>
                                            <?php }
                                            if (in_array("46", $this->module_data)) { ?>
                                                <li> <a class="wrap_content_header" href="<?php echo site_url('admin/masters/question'); ?>">
                                                        Question
                                                    </a></li>
                                            <?php }
                                            if (in_array("47", $this->module_data)) { ?>
                                                <li> <a class="wrap_content_header" href="<?php echo site_url('admin/masters/question'); ?>">
                                                        Subject
                                                    </a></li>
                                            <?php }
                                            if (in_array("18", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/smstemplate'); ?>">
                                                        Sms Template
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("19", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/skill'); ?>">
                                                        Skill
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("28", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/service'); ?>">
                                                        Services
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("24", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/state'); ?>">
                                                        State
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("30", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/usertype'); ?>">
                                                        User Type
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("31", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/training'); ?>">
                                                        Training
                                                    </a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("32", $this->module_data)) { ?>
                                                <li><a class="wrap_content_header" href="<?php echo site_url('admin/masters/trainingdatetime'); ?>">
                                                        Training Date Time
                                                    </a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                                <?php if (in_array("22", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/employee'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-social-person"></i>Employees</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("29", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/visitor'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-social-person-add"></i> Lead</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("33", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/customer'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-social-group"></i> Customers</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("35", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/sites'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-store"></i> Sites</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("46", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/quotation'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-social-pages"></i> Quotation</a>
                                    </li>
                                <?php } ?>
                                <?php /* if (in_array("37", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/invoice'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-input"></i>Invoice</a>
                                    </li>
                                <?php } */ ?>
                                <?php if (in_array("43", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/payment'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-payment"></i>Payment</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("36", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/user/attendance/list'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-event"></i>Attendance</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("36", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/salary'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-perm-contact-cal"></i>Salary</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("38", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/inspection'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-done-all"></i>Inspections</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("39", $this->module_data)) { ?>
                                    <li class="bold">
                                        <a href="<?php echo site_url('admin/penlty'); ?>" class="waves-effect waves-cyan wrap_content_header"><i class="mdi-action-find-replace"></i>Penalties</a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if (in_array("40", $this->module_data)) { ?>
                                <li class="bold">
                                    <a class="collapsible-header  waves-effect waves-cyan" href="<?php echo site_url('admin/user/tickets'); ?>"><i class="mdi-notification-event-note"></i> Tickets
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-settings-applications"></i> Configuration</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <?php if (in_array("1", $this->module_data)) { ?>
                                            <li><a href="<?php echo site_url('admin/configuration/activitylog'); ?>">Admin Activity Log</a></li>
                                        <?php }
                                        if (in_array("1", $this->module_data)) { ?>
                                            <li><a href="<?php echo site_url('admin/configuration/config'); ?>">Configuration</a></li>
                                        <?php }
                                        if (in_array("1", $this->module_data)) { ?>
                                            <li><a href="<?php echo site_url('admin/configuration/errorlog'); ?>">Error Log</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                            <?php if (in_array("41", $this->module_data)) { ?>
                                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-notification-event-available"></i> Report</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <?php if (in_array("42", $this->module_data)) { ?>
                                                <li><a href="<?php echo site_url('admin/user/attendance/list'); ?>">Attendance</a></li>
                                            <?php }
                                            if (in_array("43", $this->module_data)) { ?>
                                                <li><a href="<?php echo site_url('admin/user/payment'); ?>">Payment</a></li>
                                            <?php }
                                            if (in_array("44", $this->module_data)) { ?>
                                                <li><a href="<?php echo site_url('admin/report/training'); ?>">Training</a></li>
                                            <?php } ?>
                                            <?php
                                            if (in_array("45", $this->module_data)) { ?>
                                                <li><a href="<?php echo site_url('admin/report/uniform'); ?>">Uniform</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- END LEFT SIDEBAR NAV-->