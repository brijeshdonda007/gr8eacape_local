<section id="content">

    

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></a></li>

  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li>Sign In</li>

</ul>

<h2>

  <img src="<?php echo base_url(); ?>assets/frontend/images/user-icon.png"  alt="popular icon" />

  User Login

  </h2>

    <script>

        $(document).ready(function(){

            

            

            $(".loginform").validate({

               rules:{

                   username:{

                       required:true

                       

                   },

                   password:{

                       required:true

                      

                       

                   }

               } ,

               messages:{

                   username:{

                       required:"Please Enter your Username"

                       

                   },

                   password:{

                       required:"Please Enter your Password"

                      

                   }

               }

            });

            

            

        });

    </script>

    

    

<div class="row">

	<div class="span6">

            <form class="loginform form-horizontal" action="<?php echo site_url('login/logincheck'); ?>" method="post">

                <?php if(@$this->session->userdata('login_msg') != ''){ ?>

    <label class="error"><?php echo @$this->session->userdata('login_msg');  $this->session->unset_userdata(array('login_msg'=>''));}?></label>

     <?php if(@$this->session->userdata('pwd_changemsg') != '') { ?>

    <label class="error"><?php echo @$this->session->userdata('pwd_changemsg');  $this->session->unset_userdata(array('pwd_changemsg'=>'')); }?></label>

          <div class="control-group">

            <label class="control-label">User Name</label>

            <div class="controls">

                <input type="text" placeholder="Enter user name" name="username" class="input-large">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Password</label>

            <div class="controls">

                <input type="password" placeholder="Enter password" name="password" class="input-large">

            </div>

          </div>

          <div class="control-group">

            <div class="controls">

              <button type="submit" class="btn buttonBlue">Login to Account</button>

              OR

              <button type="submit" class="btn-facebook"><img src="<?php echo base_url(); ?>assets/frontend/images/facebook-icon.png" alt="facebook gr8 escape" /> | Login with facebook</button>

            </div>

          </div>

        </form>

        <a class="login-link" href="<?php echo site_url('forgotpassword');?>">Forgot your password?</a>

        <h1 class="login-divider"><img src="<?php echo base_url(); ?>assets/frontend/images/login-divider.png" /></h1>

        <div class="form-horizontal login-signup">

        	<div class="control-group">

            	<div class="controls">

                    <a href="<?php echo site_url('register');?>"><button type="submit" class="btn buttonRed">Signup for Account</button></a>

                </div>

            </div>

        </div>

    </div>

</div>

  </div>

  

</div>

</section>



