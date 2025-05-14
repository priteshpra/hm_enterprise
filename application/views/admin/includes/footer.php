<!-- START RIGHT SIDEBAR NAV-->
<aside id="right-sidebar-nav">
  <ul id="chat-out" class="side-nav rightside-navigation" style="height: 100%!important;padding:0px!important">
    <li class="li-hover">
      <ul class="chat-collapsible" data-collapsible="expandable">
        <li>
          <div class="collapsible-header teal white-text active indigo darken-2">
            <i class="mdi-social-notifications"></i>
            Recent Appointment
          </div>
          <div class="collapsible-body recent-activity">
          </div>
        </li>
      </ul>
    </li>
  </ul>
</aside>
<!-- END RIGHT SIDEBAR NAV-->
</div>
</div>
<!-- START FOOTER -->
<!-- <footer class="page-footer m-t-0">
   <div class="footer-copyright">
     <div class="container">
       <span>Copyright © 2018 <a class="grey-text text-lighten-4" href="#">Masters</a> All rights reserved.</span>
       </div>
   </div>
 </footer> -->
<!-- END FOOTER -->

<!-- ================================================
Scripts
================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>
<!--materialize js-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.clockpicker.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- chartist -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartjs/chart.min.js"></script>
<!-- sparkline -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/sparkline-script.js"></script>

<!-- morris -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>

<!-- aleryfy.min.js - Some Specific JS codes for Plugin Settings -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/alertify.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/drag-arrange.js"></script>


<script src="<?php echo $this->config->item('admin_assets'); ?>js/moment.latest.min.js"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>js/pignose.calendar.js"></script>

<!-- common.js -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/common_js.js?v=<?= date('YmW'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/select2/select2.min.js"></script>
<script>

$('.datepicker').on('mousedown',function(event){
  event.preventDefault();
})

$('.datepickerval').on('mousedown',function(event){
  event.preventDefault();
})

$('.timepicker').on('mousedown',function(event){
  event.preventDefault();
})

  //For date picker 
  $('.datepicker').pickadate({
    format: 'dd-mm-yyyy',
    onSet: function(arg) {
      if ('select' in arg) {
        this.close();
      }
    },
    onClose: function() {
      $('#header').focus();
      $('#header').trigger('blur')
      $(this).focus();
    }
  })
  $('.datepicker_future').pickadate({
    format: 'dd-mm-yyyy',
    min: new Date(),
    onSet: function(arg) {
      if ('select' in arg) {
        this.close();
      }
    }
  })
  $('.datepicker_past').pickadate({
    format: 'mm-dd-yyyy',
    max: new Date(),
    onSet: function(arg) {
      if ('select' in arg) {
        this.close();
      }
    }
  })
  $('.timepicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    autoclose: true,
    twelvehour: false,
    afterDone: function() {
      $(this).parent().find('label').addClass('active');
    }
  });
  //For select 2
  $('select.select2_class').select2();
  var base_url = "<?php echo site_url(); ?>";
  var active_status_icon_class = "active_status_icon";
  var inactive_status_icon_class = "inactive_status_icon";
  var loading_status_icon_class = "loading_status_icon";

  $(document).ready(function() {
    $("#CityID").on('change', function() {
      var CityID = $("#CityID").val();
      $.ajax({
        type: "post",
        url: base_url + "common/SetCitySession",
        data: {
          CityID: CityID
        },
        success: function(data) {
          if (typeof common_ajax === "function") {
            window.common_ajax(PageSize, CurrentPage);
          }
          if (typeof ajax_listing === "function") {
            window.ajax_listing(PageSize, CurrentPage);
          }
        }
      });
    })
  })
</script>


<?php echo @$page_level_js; ?>

</script>
</body>

</html>