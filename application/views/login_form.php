<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>
.container{
		margin-top: 8%;
}
.form-control{
		border:none;
		border-bottom: 2px solid green;
		border-radius: 0px;
}
.form-control:focus {
border-color: deepskyblue;
box-shadow: none;
}
 .im1{
	text-align: center;
}
.img-responsive{
	height: 120px;
	color: deepskyblue;
}
@media only screen and (max-width:767px){
				.s2{
						display: none;
				}
		}
</style>

<body>
	<div class="container">
		<div class="row">
        <div class="col-md-5" style="margin : 0 auto; border: 1px solid deepskyblue; padding: 30px 30px;box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px deepskyblue;">
            <div class="im1">
	             <img class="img-responsive" src="<?php echo base_url(); ?>images/login.png">
	                <h5>Login</h5>
	                   <form method="post" action="<?php echo base_url('Login/user_login'); ?>">
	                      <h4 class="text-danger">
	                          <?php
		                            echo   $this->session->flashdata('failed');
	                           ?>
	                      </h4>
	                      <div class="form-group">
	                         <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo set_value('phone'); ?>">
	                      </div>
	                      <?php
	                        echo form_error('phone','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
	                                        <span aria-hidden="true">&times;</span>
	                                        </button>',
	                                        '</div>');
	                                        ?>
	                        <div class="form-group" >
	                            <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
	                        </div>
                          <?php
	                          echo form_error('password','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
	                                          <span aria-hidden="true">&times;</span>
	                                          </button>',
	                                          '</div>');
	                        ?>
	                      <div class="b1" style="text-align:center;">
	                          <button type="submit" class="btn btn-primary">Login</button>
	                      </div>
	          </div>
	        </div>
	    </div>
<script type="text/javascript">
   $(document).ready(function(){
   $("button").click(function(){
	 $(this).closest('#al').remove();
  });
});
</script>
</body>
</html>
