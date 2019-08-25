<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Profile Edit</title>
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
	<div style="text-align: center; margin-top: 3%;">
		<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#passModal">
		Change Password
	</button>
	</div>
	<br>
	<?php

	if($this->session->flashdata('passchange')){
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 25%; margin: 0 auto;">
		  <strong>Success</strong> <?php echo $this->session->flashdata('passchange');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
	}

	?>
  <div class="container" style="margin-top: 2%;">


    <div class="row">
      <div class="col-md-7">
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
		<div class="form-group">
	  <label>Select NID/Passport/Birth Certificate:</label>
	  <select class="form-control" name="id_type">
	    <option value="<?php echo $myprofile['id_type']; ?>"><?php echo $myprofile['id_type']; ?></option>
			<option value="NID">NID</option>
	    <option value="Passport">Passport</option>
	    <option value="Birth Certificate">Birth Certificate</option>
	  </select>
	</div>
	<?php
		echo form_error('id_type','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>',
										'</div>');
										?>
	<div>
		 <div class="form-group">
	<label>ID Number: </label>
	 <input type="text" class="form-control" name="id_number" value="<?php echo $myprofile['id_number']; ?>">
	 </div>
	 <?php
	 	echo form_error('id_number','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
	 									<span aria-hidden="true">&times;</span>
	 									</button>',
	 									'</div>');
	 									?>

	 <div class="form-group">
	 <label>Nominee Name: </label>
		<input type="text" class="form-control" name="nominee_name" value="<?php echo $myprofile['nominee_name']; ?>">
		</div>
		<?php
			echo form_error('nominee_name','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>',
											'</div>');
											?>
		<div class="form-group">
		<label>Relationship With Nominee:</label>
		<select class="form-control" name="rel_nominee">
			<option value="<?php echo $myprofile['rel_nominee']; ?>"><?php echo $myprofile['rel_nominee']; ?></option>
			<option value="Father">Father</option>
			<option value="Mother">Mother</option>
			<option value="Brother">Brother</option>
			<option value="Sister">Sister</option>
			<option value="Husband">Husband</option>
			<option value="Wife">Wife</option>
			<option value="Others">Others</option>
		</select>
		</div>
		<?php
			echo form_error('rel_nominee','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
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
<div class="col-md-5">
	<div class=""  style="margin-left: 35%; margin-top:30%;">
		<?php
		if(isset($error)){
			foreach ($error as $key) {
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> <?php echo $key; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
				<?php
			}
		}
		?>
		<h2 style="color: deepskyblue;">Update Your Image</h2>
		<img src="<?php echo base_url();?>upload/<?php echo $myprofile['photo'];?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>upload/default.png';" id="image" height="150" width="150">
		<br>
		 <label>Insert Your Image</label>
		 <br>
		 <form action="<?php echo base_url('Home/profile_image_upload'); ?>" method="post" enctype="multipart/form-data">
		 	<input name="image" onchange="showImage.call(this)" type="file"/>

			<button style="margin-top:10px;" type="submit" class="btn btn-success btn-sm">Save</button>
		 </form>
	</div>

</div>
</div>
<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password Change</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form  action="<?php echo base_url('Home/member_password_change'); ?>" method="post">
				<div class="form-group">
					<?php
				    echo form_error('password','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                    </button>',
				                    '</div>');
				                    ?>
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
				<div class="form-group">
					<?php
				    echo form_error('conf_password','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                    </button>',
				                    '</div>');
				                    ?>
          <label for="exampleInputPassword2">Confirm Password</label>
          <input type="password" name="conf_password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
        </div>
				<div style="text-align: center;">
          <button type="submit" class="btn btn-sm btn-success">Update</button>
				</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php
if(isset($show_modal) && $show_modal == 1){
	?>
	<script type="text/javascript">
		$('#passModal').modal('show');
	</script>
	<?php
}
?>
<script type="text/javascript">
   $(document).ready(function(){
   $("button").click(function(){
	 $(this).closest('#al').remove();
  });
});
</script>
<script type="text/javascript">
var map = {};
$('select option').each(function () {
if (map[this.value]) {
$(this).remove()
}
map[this.value] = true;
});
</script>
<script type="text/javascript">
 function showImage(){
		 if(this.files && this.files[0]){
				 var obj = new FileReader();
				 obj.onload = function(data){
						 var image = document.getElementById("image");
						 image.src = data.target.result;
						 image.style.display = "block";
				 }

				 obj.readAsDataURL(this.files[0]);
		 }
 }
 </script>
</body>
</html>
