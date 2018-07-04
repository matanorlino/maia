            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url('teacher/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard </a></li>
                  <li><a href="<?php echo base_url('teacher/teachnow'); ?>"><i class="fa fa-area-chart"></i> Teach Now </a></li>
                  <li><a><i class="fa fa-briefcase"></i>Module <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('teacher/allsubject'); ?>">View All Module</a></li>
                      <li><a href="<?php echo base_url('teacher/newsubject'); ?>">Add New Module</a></li>
                      <li><a href="<?php echo base_url('teacher/restoremodule'); ?>">Restore Module</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-book "></i>Lesson <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('teacher/alllesson'); ?>">View All Lessons</a></li>
                      <li><a href="<?php echo base_url('teacher/newlesson'); ?>">Add New Lesson</a></li>
                      <li><a href="<?php echo base_url('teacher/restorelesson'); ?>">Restore Lesson</a></li>
                    </ul>
                  </li> 

                  <li><a id="btn-quiz" href="<?php echo base_url('teacher/quiz'); ?>"><i class="fa fa-check"></i>Quiz Answer Key</span></a>
                  </li>                
                  <li><a><i class="fa fa-wrench "></i>Tools <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="<?php echo base_url('teacher/calendar'); ?>"> Calendar</span></a></li> -->
                      <li><a href="<?php echo base_url('teacher/todo'); ?>"> To Do List </span></a></li>
                      <li><a href="<?php echo base_url('teacher/eboard'); ?>"> eBoard </span></a></li>
                      <li><a href="<?php echo base_url('teacher/calculator'); ?>"> Calculator </span></a></li>
                      <!-- <li><a href="<?php echo base_url('teacher/todo'); ?>"> Timer </span></a></li> -->
                    </ul>
                  </li> 
                  
                  <li><a href="<?php echo base_url('teacher/profile'); ?>"><i class="fa fa-user"></i> Profile </span></a>
                  </li>
                </ul>
              </div>
            </div>