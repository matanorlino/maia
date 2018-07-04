<div class="dashboards">
<?php 
$ip = getHostByName(getHostName());;
// echo '<br><label>'.$ip . '/maia/s</label>';
?>
  <div class="row top_tiles">
<!--     <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
        <div class="count" id="newsubj">17</div>
        <h3>Connected</h3>
      </div>
    </div> -->
<!--     <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-paperclip"></i></div>
        <div class="count" id="newlesson">179</div>
        <h3>New Lessons</h3>
      </div>
    </div> -->
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-briefcase"></i></div>
        <div class="count" id="totsubj"></div>
        <h3>Total Module</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-book"></i></div>
        <div class="count" id="totlesson"></div>
        <h3>Total Lessons</h3>
      </div>
    </div>
  </div>
</div> <!--dashboards -->

<!-- Start to do list -->
<div class="col-md-6 col-sm-12 col-xs-12 cls-to-do">
  <div class="x_panel">
    <div class="x_title">
      <h2>To-Do List </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="<?php echo site_url().'teacher/todo';?>" class="dropdown-toggle"  role="button" aria-expanded="false"><i class="fa fa-plus"></i></a>
        </li>                  
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div id="to_do">
        <ul id="to_do_dash" class="to_do">
        </ul>
      </div>
    </div>
  </div>
</div><!-- End to do list -->
<!-- Start to do list -->
<div class="col-md-6 col-sm-12 col-xs-12 cls-to-do">
  <div class="x_panel">
    <div class="x_title">
      <h2>Student Side Instruction </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="<?php echo site_url().'teacher/todo';?>" class="dropdown-toggle"  role="button" aria-expanded="false"><i class="fa fa-plus"></i></a>
        </li>                  
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <p>Step 1: Ask the students to open Google Chrome in their device.</p>
      <p>Step 2: In the URL Bar, type the following <code><?= $ip?>/maia/s </code></p>
    </div>
  </div>
</div><!-- End to do list -->

<!--Start of Calendar
<div class="col-md-8 col-sm-12">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Calendar Events <small>Click to add/edit events</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div id='calendar'></div> 

        </div>
      </div>
    </div>
  </div>
</div> End of Calendar -->
<div class="clearfix"></div> 