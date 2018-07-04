<div class="col-md-12 col-sm-12">
  <div class="page-title">
    <div class="title_left">
      <h3 id="view-specific-lesson">**Name of the Lesson Here**</h3>
    </div>
  </div>

<!--   <div class="clearfix"></div> -->

  <div class="">
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">

        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Presentation</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Video</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">e-Board</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Activity</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Notes</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="board" id="eboard" style="width: auto; height: 500px;"></div>  
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                <p>Select your presentation here</p>
                <select id="cb-ppt" class="select2 form-control" style="width: 100%;">
                  <option disabled="true" selected=""></option>
                </select> 

                <div class="pull-left">
                  <br>
                  <button id="prev" class="btn btn-lg btn-success prevppt"><i class="fa fa-angle-left"></i></button>
                  <button id="next" class="btn btn-lg btn-success nextppt"><i class="fa fa-angle-right"></i></button>
                  <button class="btn btn-lg btn-success zoomout"><i class="fa fa-search-minus"></i></button>
                  <button class="btn btn-lg btn-success zoomin"><i class="fa fa-search-plus"></i></button>
                  &nbsp; &nbsp;
                  <span>Page: <span id="ppt_page_num"></span> / <span id="ppt_page_count"></span></span>
                  <br>
                </div>
                <div class="clearfix"></div>
                  <div class="txt-center">
                    <canvas id="can-ppt"></canvas>
                  </div>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab1">
                <p>Select your video here</p> <br>
                <select id="cb-vid" class="select2 form-control" style="width: 100%;">
                  <option disabled="true" selected=""></option>
                </select> <br><br>
                <div class="txt-center clearfix embed-responsive embed-responsive-16by9">
                  <video class="txt-center embed-responsive-item" controls></video>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade clearfix" id="tab_content3" aria-labelledby="profile-tab2">
              </div>
              
              <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab3">
                <p>Select your activity here
                  <select id="cb-pdf" class="select2 col-md-8" style="width: 100% !important;"></select>
                </p><br>
                
                <div>
                  <!-- <iframe id="pdf-obj" data="" type="application/pdf" class="col-md-12">
                    alt: <a href="" id="pdf-link">click here</a>
                  </iframe> -->
                  <div id="pdfpdf" style="height: auto;"></div>  
                  <div class="pull-left">
                    <button id="prev" class="btn btn-lg btn-success prevpdf"><i class="fa fa-angle-left"></i></button>
                    <button id="next" class="btn btn-lg btn-success nextpdf"><i class="fa fa-angle-right"></i></button>
                    <button class="btn btn-lg btn-success zoomout"><i class="fa fa-search-minus"></i></button>
                    <button class="btn btn-lg btn-success zoomin"><i class="fa fa-search-plus"></i></button>
                    &nbsp; &nbsp;
                    <span>Page: <span id="act_page_num"></span> / <span id="act_page_count"></span></span>
                    <br>
                  </div>
                  <div class="clearfix"></div>
                  <div class="txt-center">
                    <canvas id="can-pdf"></canvas>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab4">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_content">
                      <!-- <div id="alerts"></div> -->
                      <div id="notes"></div>
                      <br />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>