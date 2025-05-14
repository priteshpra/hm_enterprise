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
  <meta name="description" content="SamarthGroup">
  <meta name="keywords" content="SamarthGroup">
  <title>Forgot Password</title>

  <!-- Favicons-->
  <link rel="icon" href="<?php echo $this->config->item('admin_assets'); ?>images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?php echo $this->config->item('admin_assets'); ?>images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="<?php echo $this->config->item('admin_assets'); ?>images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" /> 
	<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" /> 
	<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" /> 

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
      <form class="login-form z-depth-4 card-panel forgot-password-form" action="<?php echo site_url('admin-forgot-password'); ?>" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <h4 class="logo_header">Forgot Password</h4>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="UserID" type="hidden" name="UserID">
            <input id="email_id" type="text" name="email_id" maxlength="250">
            <label for="email_id">Email ID</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 center">
            <button id="forgot_button" name="forgot_button" type="button" class="forgot_password_submit_button btn waves-effect waves-light">Send Old Password</button>
          </div>
          <div class="input-field col s12">
            <p class="margin sign-up right"><a href="<?php echo site_url('admin-login'); ?>">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>


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
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/alertify.min.js"></script>
  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>

<script>
  setTimeout(function(){ 
          $('#email_id').focus();
          }, 1100);
      
  <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>    
  
    $('#forgot_button').click(function(){
    var email = $('#email_id').val();
    if (email == ''){
      alertify.error("<?php echo label('required_field'); ?>");
      return false;
    }
    else{
      $.ajax({
        url: "<?php echo base_url('admin/usersession/checkIfEmailIDIsRegistered')?>",
        type:'POST',
        data: {email_id: email},
        success: function(data){
          if(data != 0){
            $("#UserID").val(data.trim());
            $('.forgot-password-form').submit()
            return false;
          }
          else{
            alertify.error(email+" <?php echo label('email_not_registered'); ?>");
            return false;
          }
        }
      });
    } 
    });
     
</script>  

</body>

</html>