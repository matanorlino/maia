<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header'); ?>
  <body class="login">
		<div class="col-md-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2><i class="fa fa-cube"></i> eMC</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="choice col-md-6 col-xs-6 alert alert-danger" id="main1"><span>A</span></div>
                <div class="choice col-md-6 col-xs-6 alert alert-info" id="main2"><span>B</span></div>
                <div class="choice col-md-6 col-xs-6 alert alert-success" id="main3"><span>C</span></div>
                <div class="choice col-md-6 col-xs-6 alert alert-warning" id="main4"><span>D</span></div>
        
                <div class="col-md-12 col-xs-12 minified">
                  <div class="col-md-4 col-xs-4 alert " id="sub1"></div>
                  <div class="col-md-4 col-xs-4 alert " id="sub2"><span id="ltr2"></span></div>
                  <div class="col-md-4 col-xs-4 alert " id="sub3"><span id="ltr3"></span></div>
                </div>
              </div>
            </div>
          </div>  
    <!-- jQuery -->