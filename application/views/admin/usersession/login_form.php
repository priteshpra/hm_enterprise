<!DOCTYPE html>
<html lang="en">
<!--================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 2.1
  Author: GeeksLabs
  Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Login</title>

  <!-- Favicons-->
  <link rel="icon" href="<?php echo base_url(DEFAULT_WEBSITE_FAVICON);?>" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?php echo $this->config->item('admin_assets'); ?>images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="<?php echo $this->config->item('admin_assets'); ?>images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->
  <!-- For Alertify -->
  <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" /> 
  <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" /> 
  <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" /> 

  <!-- CORE CSS-->
  
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan login-page-cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
	
  <div id="login-page" class="row">
    <div class="">
      <form class="login-form z-depth-4 card-panel" action="<?php echo site_url('admin/usersession/postLogin'); ?>" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="<?php echo base_url(DEFAULT_WEBSITE_LOGO);?>" alt="" class="responsive-img valign profile-image-login">
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="email" type="email" name="email" class="empty_validation_class" maxlength="50">
            <label for="email" class="center-align"><?php echo label("msg_lbl_emailid");?></label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="password" class="empty_validation_class" maxlength="50">
            <label for="password"><?php echo label("msg_lbl_password");?></label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field text-center col s12">
            <button type="button" id="button_submit" name="button_submit"  type="submit" class="btn  waves-effect waves-light"><?php echo label("msg_lbl_login");?></button>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12">
              <p class="margin right-align medium-small"><a href="<?php echo site_url('admin-reset-password'); ?>"><?php echo label("msg_lbl_resetpassword");?></a></p>
          </div>          
        </div>

      </form>
    </div>
  </div>

<script>
       //alert("here");
        setTimeout(function(){ $('#email').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . addslashes($this->session->userdata['posterror']) . " ')}, 1000);"; } 
    ?>      
</script>

  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>

  <!--Alertify-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/alertify.min.js"></script>

    <!--Common JS-->
 <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/common_js.js"></script>

<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#email').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
</script>
<script>
 $('#button_submit').on('click', function (){
        var error = checkValidations();
        var Email = $('#email').val();
        var pPassword = $('#password').val();

        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{    
            alertify.success("Please wait");
            $('form').submit();
        }
        return false;
    });
$(document).keypress(function(e){
  if(e.which == 13 ){
    $("#button_submit").click();
    return false;
  }
});

</script>
</body>
</html>