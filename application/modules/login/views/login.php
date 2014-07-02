

<section id="content">

    

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></a></li>

  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li>Login</li>

</ul>


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

                       required:"Please Enter your Username or Email"

                       

                   },

                   password:{

                       required:"Please Enter your Password"

                      

                   }

               }

            });

            

            

        });

    </script>

    

    <h2>

  <img src="<?php echo base_url(); ?>assets/frontend/images/user-icon.png"  alt="popular icon" />

  User Login

  </h2>

    <div class="row-fluid login">

        <div class="span6">
            <span>Already have an account? Please login below </span>&#9786;

            <form class="loginform form-horizontal" action="<?php echo site_url('login/logincheck'); ?>" method="post">

                <?php if(@$this->session->userdata('login_msg') != ''){ ?>

    <label class="error"><?php echo @$this->session->userdata('login_msg');  $this->session->unset_userdata(array('login_msg'=>''));}?></label>
    	
    <?php if (@$this->session->userdata('active_url') != ''){ ?>
    <label><a href="<?php echo $this->session->userdata('active_url'); ?>" target="_blank">Click here to activate your account.</a></label>
    <?php $this->session->unset_userdata(array('active_url'=>''));} ?>

     <?php if(@$this->session->userdata('pwd_changemsg') != '') { ?>

    <label class="error"><?php echo @$this->session->userdata('pwd_changemsg');  $this->session->unset_userdata(array('pwd_changemsg'=>'')); }?></label>

          <div class="control-group">

            <label class="control-label">Username or Email</label>

            <div class="controls">

                <input type="text" placeholder="Enter your Username" name="username" class="input-xlarge">

            </div>

          </div>

          <div class="control-group">

            <label class="control-label">Password</label>

            <div class="controls">

                <input type="password" placeholder="Enter your password" name="password" class="input-xlarge">

            </div>

          </div>

          <div class="control-group">

            <div class="controls">

              <button type="submit" class="btn buttonBlue">Login to your account</button>

              

              

            </div>

          </div>

          <a class="login-link" href="<?php echo site_url('forgotpassword');?>">Forgot your password?</a>

        </form>

        

        </div>

        <div class="span1">

            <span class="login-divider"><img src="<?php echo base_url(); ?>assets/frontend/images/login-divider.png" /></span>

        </div>

        <div class="span5 login-signup">

            <h5>Login using your Facebook account.</h5>

            <button class="btn-facebook" id="facebook"><img src="<?php echo base_url(); ?>assets/frontend/images/facebook-icon.png" alt="facebook gr8 escape" />Connect with Facebook</button>

        	

            	<div class="controls">

                    <h5>Not member yet?</h5>

                    <p>Sign up to become a member of Gr8 Escapes</p>

                    <a href="<?php echo site_url('register');?>"><button type="submit" class="btn buttonRed">Sign up for an account</button></a>

                </div>

        </div>

    </div>



  </div>

</section>



<script type="text/javascript">

  window.fbAsyncInit = function() {

	  //Initiallize the facebook using the facebook javascript sdk

     FB.init({ 

       appId:'<?php echo $this->config->item('appID'); ?>', // App ID 

	   cookie:true, // enable cookies to allow the server to access the session

           status:true, // check login status

	   xfbml:true, // parse XFBML

	   oauth : true //enable Oauth 

     });

   };

   //Read the baseurl from the config.php file

   (function(d){

           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];

           if (d.getElementById(id)) {return;}

           js = d.createElement('script'); js.id = id; js.async = true;

           js.src = "//connect.facebook.net/en_US/all.js";

           ref.parentNode.insertBefore(js, ref);

         }(document));

	//Onclick for fb login

 $('#facebook').click(function(e) {

    FB.login(function(response) {

	  if(response.authResponse) {

		  parent.location ='<?php echo site_url('login/fblogin');?>'; //redirect uri after closing the facebook popup

	  }

 },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook

});

</script>



