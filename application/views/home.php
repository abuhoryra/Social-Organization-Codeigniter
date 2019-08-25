<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    .alert{
      font-size: 15px !important;
    }
  </style>
</head>
  <body>
    <?php $this->load->view($side_bar); ?>
    <div class="main">
      <!-- Button trigger modal -->
			<?php
			if ($super['is_super'] == 1) {
				?>
				<div class="ModalBtn" style="text-align: center; margin-top:2%;">
	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	          Add User
	        </button>
	      </div>
				<?php
			}

			?>
<hr>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form" action="<?php echo base_url('Home/add_admin'); ?>">
          <div class="form-group">
            <h6>First Name:</h6>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo set_value('first_name'); ?>">
          </div>
          <?php
            echo form_error('first_name','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>',
                            '</div>');
                            ?>
          <div class="form-group">
            <h6>Last Name:</h6>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
          </div>
          <?php
            echo form_error('last_name','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>',
                            '</div>');
                            ?>
        <div class="form-group">
           <h6>Email address:</h6>
           <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
        </div>
        <?php
          echo form_error('email','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>',
                          '</div>');
                          ?>
       <div class="form-group">
          <h6>Password:</h6>
          <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <?php
        echo form_error('password','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>',
                        '</div>');
                        ?>
      <div class="form-group">
         <h6>Phone Number:</h6>
         <input type="number" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
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
<div class="form-group">
	 <h6>ID Number:</h6>
	 <input type="text" name="id_number" class="form-control" placeholder="ID Number" value="<?php echo set_value('id_number'); ?>">
</div>
<?php
	echo form_error('id_number','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>',
									'</div>');
									?>
<div class="form-group">
	 <h6>Nominee Name:</h6>
	 <input type="text" name="nominee_name" class="form-control" placeholder="Nominee Name" value="<?php echo set_value('nominee_name'); ?>">
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
      <div class="checkbox">
         <h6><input type="checkbox" name="is_super" value="0"> Super Admin</h6>
      </div>
      <button type="submit"  class="btn btn-primary">Submit</button>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<br>
<h5 style="text-align: center;">User List</h5>
<br>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
			<th scope="col">Image</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
			<th scope="col">
			<?php

			if($super['is_super']==1){

				echo 'Super Admin';

			}

			?>
</th>
			<?php
			if($super['is_super']==1){
				?>
				<th scope="col">Action</th>
				<?php
			}
			?>

    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
  foreach ($admin as $row) {
    $count++;
    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
			<td><img style="border-radius: 100%;" src="<?php echo base_url();?>upload/<?php echo $row['photo'];?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>upload/default.png';" id="image" height="50" width="50"></td>
      <td><?php echo $row['first_name']; ?></td>
      <td><?php echo $row['last_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo '0'.$row['phone']; ?></td>
      <?php

				if($super['is_super']==1){

			 if($row['is_super'] == 1){
        ?>
				<td>Yes</td>
				<?php
      }
      else{
        ?>
				<td>No</td>
				<?php
      }
		}
    ?>


      <td>
				<div class="dropdown">
					<?php
					$user_phone = $this->session->userdata['phone'];
         if($super['is_super']==1){
					 ?>
					 <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						Action
 					</button>
					 <?php
				}
					?>

					<div class="dropdown-menu" style="text-align: center;" aria-labelledby="dropdownMenuButton">
						<?php
							 $user_phone = $this->session->userdata['phone'];
							 if($super['is_super']==1){

							 if($row['is_super'] == 0) {
								 ?>
								 <a class="btn btn-warning btn-sm" href="<?php echo base_url('Home/make_super_admin/'.$row['id'].'/'.'1'); ?>">Make Super</a><br>
								 <?php
							 }
							 if($row['is_super'] == 1 ){


								 ?>

								<a class="btn btn-secondary btn-sm" href="<?php echo base_url('Home/make_super_admin/'.$row['id'].'/'.'0'); ?>">Remove Super</a><br>
								<?php

							 }

						 }

						 ?>
						 <a class="btn btn-danger btn-sm disabled" style="margin-top: 5px;" href="<?php echo base_url('Home/delete_admin/'.$row['id']); ?>">Delete User</a><br>
						 <a class="btn btn-primary btn-sm" style="margin-top: 5px;" href="<?php echo base_url('Home/get_user_profile/'.$row['id']); ?>">Edit User</a><br>
						 <a class="btn btn-primary btn-sm" style="margin-top: 5px;" href="<?php echo base_url('Home/get_user_deposit_history/'.$row['id']); ?>">Deposit History</a>
						  <a class="btn btn-primary btn-sm" style="margin-top: 5px;" href="<?php echo base_url('Home/reset_password_bySuperAdmin/'.$row['id']); ?>">Reset Password</a>
		        <?php

						?>

					</div>
			 </div>


			</td>
    </tr>
    <?php
  }
    ?>


  </tbody>
</table>

    </div>

    <?php
    if(validation_errors()){
      ?>
      <script type='text/javascript'>

    $('#myModal').modal('show');

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


  </body>
</html>
