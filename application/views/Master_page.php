<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header'); ?>
<?php
  //get session firstname
  $fname = $this->session->userdata('logged_in'); 
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('teacher/dashboard'); ?>" class="site_title"><i class="fa fa-paw"></i> <span>MAIA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets/img/img.jpg'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo($fname['firstname']); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('partials/sidebar');?>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('assets/img/img.jpg'); ?>" alt=""><?php echo($fname['firstname']); ?>
                    
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url('teacher/profile'); ?>"> Profile</a></li>
                    <li><a href="<?php echo base_url('teacher/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div> <!-- /top navigation -->

        <!-- *************************************************** -->
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- load view here-->
          <?php $this->load->view($view); ?>
        </div><!-- /page content -->
        <!-- *************************************************** -->

<?php $this->load->view('partials/footer'); ?>
        