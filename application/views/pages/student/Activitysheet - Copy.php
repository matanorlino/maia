<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header'); ?>
  <body class="login">
		<div class="col-md-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2><i class="fa fa-bars"></i> Answer Sheet</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">


                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active epad-tab"><a href="#epad_tab_content" id="epad-tab" role="tab" data-toggle="tab" aria-expanded="true">ePad</a>
                    </li>
                    <li role="presentation" class=" eboard-tab"><a href="#eboard_tab_content" role="tab" id="eboard-tab" data-toggle="tab" aria-expanded="false">eBoard</a>
                    </li>
                    <li role="presentation" class=" emc-tab"><a href="#emc_tab_content" role="tab" id="emc-tab" data-toggle="tab" aria-expanded="false">eMC</a>
                    </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="epad_tab_content" aria-labelledby="epad-tab">
            						<table>
            							<tr class="tr">
            								<td>Name: &nbsp</td>
            								<td><input type="text" id="name"></td>
            							</tr>
            							<tr><td>&nbsp</td></tr>
            							<tr class="tr">
            								<td>Section: &nbsp</td>
            								<td><input type="text" id="section"></td>
            							</tr>
            							<tr><td>&nbsp</td></tr>
            						</table>
                      <div id="setItem">
                        <p>Enter Number of Items: <input type="number" id="item">
                           <input type="submit" id="itemSubmit">  
                        </p>
                      </div>
                      <div id="answer_sheet">
                        <label>Answer Sheet</label>
					            </div>
                      <div id="checking_sheet">
                    	 <label>Checking Sheet</label>
                      	<div class="scoring">
            							<table>
            								<tr class="tr">
            									<td><label>Score: &nbsp</label></td>
            									<td><span class="score-style" id="score"></span></td>
            								</tr>
            								<tr><td>&nbsp</td></tr>
            								<tr class="tr">
            									<td><label>Rate: &nbsp</label></td>
            									<td><span class="score-style" id="rate"></span></td>
            								</tr>
            								<tr><td>&nbsp</td></tr>
            							</table>
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="eboard_tab_content" aria-labelledby="eboard-tab">
                      112312312
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="emc_tab_content" aria-labelledby="emc-tab">
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

              </div>
            </div>
          </div>  
    <!-- jQuery -->