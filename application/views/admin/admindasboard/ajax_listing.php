<?php
if ($FilterType == "Daily") {
    $Str = "Today";
} else if ($FilterType == "Weekly") {
    $Str = "Current Week";
} else if ($FilterType == "Monthly") {
    $Str = "Current Month";
} else if ($FilterType == "Yearly") {
    $Str = "Current Year";
} else if ($FilterType == "Total") {
    $Str = "Total";
} else {
    $Str = "";
}

?>
<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  green white-text">
            <p class="card-stats-title"><i class="mdi-social-group-add"></i> Number Of Lead</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalLeads; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  green darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="Visitor" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content pink lighten-2 white-text">
            <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Total Customer</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalCustomers; ?></h4>
            <p class="card-stats-compare"><span class="deep-purple-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  pink darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="Booking" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  grey white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Site</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalSites; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  indigo white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Collection</p>
            <h4 class="card-stats-number"><?php echo number_format($Dashboard->TotalCollections, 2); ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  indigo darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="Assign Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/Assign/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>



<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  indigo lighten-3 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total HouseKeeping Collection</p>
            <h4 class="card-stats-number"><?php echo number_format($Dashboard->HouseKeepingCollections, 2); ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  teal white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Deep Cleaing Collection</p>
            <h4 class="card-stats-number"><?php echo number_format($Dashboard->DeepCleaingCollections, 2); ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content   brown lighten-1 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Sanetize Collection</p>
            <h4 class="card-stats-number"><?php echo number_format($Dashboard->SanetizeCollections, 2); ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content green darken-2 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Present</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalPresences; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content red lighten-1 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Absent</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalAbsents; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>


<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content orange lighten-1 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Half Day</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalHalfDays; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content  blue white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Half Over Time</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalHalfOverTimes; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l3">
    <div class="card">
        <div class="card-content deep-purple lighten-1 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Full Over Time</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalFullOverTimes; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2 hide">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>
<br><br>

