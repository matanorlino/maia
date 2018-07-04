
<div class="row create-lesson">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 class="edit-les-name-head">Edit Lesson <input type="hidden" id="edit-id"> <input type="hidden" id="edit-head-name" class="edit-les-name-head"></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lesson-name">Lesson Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="edit-lesson-name" name="lesson-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lesson-desc">Lesson Description <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="edit-lesson-desc" name="lesson-desc" required="required" class="form-control col-md-7 col-xs-12 edit-lesson-name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lesson-desc">Lesson Code <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="edit-lesson-code" name="lesson-desc" required="required" class="form-control col-md-7 col-xs-12 edit-lesson-name">
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Upload Lesson Image <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" id="edit-lesson-img" name="lesson-img" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
        </form>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Lecture</h2>
                      <h2><small>Upload your file here</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <form action="#" class="dropzone" id="edit-dzppt" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="1" />
                        <div class="fallback">
                          <input name="file" type="file" multiple />
                        </div>
                      </form>
                    </div>
                  </div>
                </div> <!-- end of main dz div!-->

                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Activity</h2>
                      <h2><small>Upload your files here</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <form action="#" class="dropzone" id="edit-dzpdf" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="1" />
                        <div class="fallback">
                          <input name="file" type="file" multiple />
                        </div>
                      </form>
                    </div>
                  </div>
                </div> <!-- end of main dz div!-->

                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Videos</h2>
                      <h2><small>Upload your videos here</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <form action="#" class="dropzone" id="edit-dzvid" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="1" />
                        <div class="fallback">
                          <input name="file" type="file" multiple />
                        </div>
                      </form>
                    </div>
                  </div>
                </div> <!-- end of main dz div!-->
              </div>
            </div>                        
          </div>
            <div class="clearfix"></div>                                          
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <button class="btn btn-primary" type="button" onclick="location.reload();">Cancel</button>
                <button id="btn-reset-fields" class="btn btn-primary" type="reset">Reset</button>
                <button id="btn-save-lesson" type="submit" class="btn btn-success">Save</button>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<div class="row no-display add-mod-to-lesson">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <br />
        <div class="x_panel">
          <div class="x_title">
            <h2>Connect <span class="con-les-name"></span> To Modules</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Just check the module you wish to connect to your newly created lesson.
            </p>
            <table id="tbl-all-lesson" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th></th>
                  <th>Module Name</th>
                  <th>Module Description</th>
                </tr>
              </thead>
            </table>
            <p><a href="#" id="btn-con-lesson" class="btn btn-success">Connect To <span class="con-les-name"></span></a></p>
            <!-- <p><a href="new_module.html">Didn't found the lesson?</a></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>