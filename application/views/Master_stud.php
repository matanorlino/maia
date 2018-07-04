<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header'); ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('student/lessoncode'); ?>" class="site_title"><i class="fa fa-paw"></i> <span>MAIA</span></a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('partials/sidebar_stud');?>
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
        