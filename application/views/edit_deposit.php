<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit Deposit</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>

</style>

<body>
	<div class="container">
    <div class="main">
<?php $this->load->view($side_bar); ?>

    <h3 style="text-align: center; margin-top: 10%;">Edit Deposit</h3>
<form class="" action="<?php echo base_url('Home/update_deposit/'.$deposit['id']); ?>" method="post">
	<?php

	if($this->session->flashdata('message')){
		?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>Sorry!</strong> <?php echo $this->session->flashdata('message');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
	}

	?>
    <div class="form-group">
    <label for="exampleFormControlSelect1">Edit Depositor Name</label>

    <select class="form-control something"  name="phone">
    <option value="<?php  echo $deposit['depositor_phone'];?>"><?php  echo $deposit['depositor_name'];?></option>
      <?php

       foreach ($member as $row) {
          ?>

					<option value="<?php echo $row['phone'];?>"><?php  echo $row['first_name'].' '.$row['last_name'];?></option>
          <?php

        }

      ?>
</select>

  </div>


	<div class="form-group">
	<label for="exampleFormControlSelect1">Edit Month</label>

	<select id="month" class="form-control"  name="month">
		<option value="<?php echo $deposit['month'].' '.$deposit['year']; ?>"><?php echo $deposit['month'].' '.$deposit['year']; ?></option>
		<?php

			foreach ($months as $row) {

				?>
				<option value="<?php echo $row['month'].' '.$row['year']; ?>"><?php echo $row['month'].' '.$row['year']; ?></option>

				<?php

			}

		?>
</select>
</div>

<input id="money" name="id" type="hidden" class="form-control" value="<?php echo $deposit['depositor_id']; ?>">

<input type="hidden" name="recipient_phone" value="<?php echo $admin['phone'];?>">
<input type="hidden" name="recipient_name" value="<?php echo $admin['first_name'].' '.$admin['last_name'];?>">
<div style="text-align: center;">
  <button type="submit" class="btn btn-success">Update</button>
</div>

      </form>
  </div>
</div>
<script type="text/javascript">
var optionValues =[];
$('.something option').each(function(){
   if($.inArray(this.value, optionValues) >-1){
      $(this).remove()
   }else{
      optionValues.push(this.value);
   }
});
</script>

<script type="text/javascript">
   $(document).ready(function(){
   $("button").click(function(){
	 $(this).closest('#al').remove();
  });
});
</script>



</body>
</html>
