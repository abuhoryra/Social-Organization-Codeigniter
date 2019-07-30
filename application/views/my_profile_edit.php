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

</style>

<body>

<?php $this->load->view($side_bar); ?>
<div class="main">
  <div class="container" style="margin-top: 5%;">
    <div class="row">
      <div class="col-md-7" style="margin: 0 auto;">
  <form method="post" action="<?php echo base_url('Home/update_my_profile'); ?>">
    <div class="form-group">
      <label>First Name:</label>
      <input type="text" class="form-control" name="first_name" value="<?php echo $myprofile['first_name']; ?>">
    </div>
    <div class="form-group">
      <label>Last Name:</label>
      <input type="text" class="form-control" name="last_name" value="<?php echo $myprofile['last_name']; ?>">
    </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="<?php echo $myprofile['email']; ?>">
  </div>
  <?php
    echo form_error('email','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>',
                    '</div>');
                    ?>
  <div class="form-group">
    <label>Phone</label>
    <input type="number" class="form-control" name="phone" value="<?php echo $myprofile['phone']; ?>">
  </div>
  <?php
    echo form_error('phone','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>',
                    '</div>');
                    ?>
  <div style="text-align: center;">
      <button type="submit" class="btn btn-success">Update</button>
  </div>

</form>
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
