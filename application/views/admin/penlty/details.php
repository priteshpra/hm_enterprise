<?php //pr($details);exit;
?>
<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/penlty"); ?>"><?php echo label('msg_lbl_penlty') ?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="candidate-details-box">
        <div class="card-panel">
          <div class="row">
            <div class="col s12 m12 l12">
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col s12">
                <div class="col s12" style="margin-top:10px;">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="active tabclick" href="#penlty" title="Penlty Employee" data-div="penlty">Penlty Employee</a></li>
                  </ul>
                </div>
              </div>
              <!-- Penlty Start -->
              <div id="penlty" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_300"><?php echo label('msg_lbl_title_employee') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_penlty') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_status'); ?></th>
                            <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="TableBody">
                        </tbody>
                      </table>
                    </div>
                    <div id="PaginationDiv" class="PaginationDiv"></div>
                  </div>

                </div>
              </div>
              <!-- Penlty End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CONTENT -->

<?php echo @$view_modal_popup; ?>