<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header'); ?>
  <body class="login">

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Login</h1>
              <div>
                <input id="username" type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default" href="javascript:;" id="btn-login">Log in</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

<!--         <div id="register" class="animate form registration_form">
          <section class="login_content">
            <div id="error_register" class="alert alert-danger"></div>
            <form>
              <h1>Create Account</h1>
              <div>
                <input id="fname" type="text" class="form-control" placeholder="First Name" required="" />
              </div>
              <div>
                <input id="mname" type="text" class="form-control" placeholder="Middle Name" />
              </div>
              <div>
                <input id="lname" type="text" class="form-control" placeholder="Last Name" required="" />
              </div>
              <div>
                <input id="reg_username" type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input id="reg_password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input id="reg_cpassword" type="password" class="form-control" placeholder="Confirm Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="#signup" id="btn_register">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
            </form>
          </section>
        </div> -->
      </div>
    </div>
    <!-- jQuery -->
    <script type="text/javascript">
      var url = "<?php echo site_url();?>";
    </script>
    <!-- Sweetalert -->
    <script src=<?php echo base_url("vendors/sweetalert/sweetalert.min.js"); ?>></script>  
    <script src= <?php echo base_url("vendors/jquery/dist/jquery.min.js"); ?>></script>    
    <script src= <?php echo base_url("assets/js/custom.js"); ?>></script>
  </body>
</html>