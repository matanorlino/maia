
<div class="all-subject">
  <div class="page-title">
    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Subject List</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="row">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
            <div id="all-mod">
            </div> <!-- end of #all-mod !-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="module-les-mod">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h2><label id="mod-name-head"></label> <small id="lbl-weekday"></small></h2>
      </div>
      <div class="modal-body">
        <div class="lesson-connected">
          <table id="mod-les-tbl" class="table table-striped table-bordered table-responsive bulk_action txt-center">
            <thead>
              <tr>
                <th class="txt-center">Lesson Name</th>
                <th class="txt-center">Lesson Description</th>
                <th class="txt-center">Remove Lesson</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <p id="mod-dcreated-foot"></p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="edit-module-les-mod">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <label id="edit-mod-name-head"></label>
      </div>
      <div class="modal-body edit-mod-les-tbl">
        <div id="edit-module-main" class="no-display">
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="module-name">Module Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="edit-mod-name" name="module-name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="module-desc">Module Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="edit-mod-desc" name="module-desc" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lesson-desc">Day Schedule <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="edit-weekdays" class="select2 form-control col-md-12 col-xs-12" multiple="true">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
              </select>
            </div>
          </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Upload Module's Image* </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="edit-mod-img" name="module-img" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div><br>
          </form>
        </div>
        
        <div class="edit-current-lesson">
          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Current Lessons</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <table id="edit-mod-les-tbl" class="table table-striped table-bordered table-responsive bulk_action txt-center">
                        <thead>
                          <tr>
                            <th class="txt-center">Lesson Name</th>
                            <th class="txt-center">Lesson Description</th>
                            <th class="txt-center">Remove Lesson</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>        
        <div class="edit-add-more-lesson no-display">
        <div class="ln_solid"></div><br>
          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add More Lesson</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <table id="edit-tbl-allLesson" class="table table-striped table-bordered bulk_action txt-center">
                        <thead>
                          <tr>
                            <th class="txt-center">Check</th>
                            <th class="txt-center">Lesson Name</th>
                            <th class="txt-center">Lesson Description</th>
                            <th class="txt-center">Date Created</th>
                          </tr>
                        </thead>
                      </table>                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div><!--end of edit add more lesson!-->
      </div> <!--end of modal body!-->
      <div class="modal-footer">
      <p><a href="#" id="btn_save_changes" class="btn btn-success">Save changes to <span class="spn-edit-mod">*Insert New Subject Name Here*</span></a></p>
        <p id="mod-dcreated-foot"></p>
      </div>
    </div>
  </div>
</div>