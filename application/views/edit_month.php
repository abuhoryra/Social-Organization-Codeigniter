<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit Month</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
</head>

<style>

</style>

<body>

<div class="main">
  <?php $this->load->view($side_bar); ?>
<h3 style="text-align: center; margin-top: 10px;">Edit Month</h3>
 <div class="container">
   <div class="col-md-5"  style="margin: 0 auto;">
     <form class="" action="<?php echo base_url('Home/update_month/'.$months['id']); ?>" method="post">
			 <?php
			 	echo form_error('month_year','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
			 									<span aria-hidden="true">&times;</span>
			 									</button>',
			 									'</div>');
			 									?>
												<div class="form-group">
								 				 <label>Select Month</label>
								 				 <select class="form-control" name="month">
								 					 <option value="<?php echo $months['month']; ?>"><?php echo $months['month']; ?></option>
								 					 <option value="January">January</option>
								 					 <option value="February">February</option>
								 					 <option value="March">March</option>
								 					 <option value="April">April</option>
								 					 <option value="May">May</option>
								 					 <option value="June">June</option>
								 					 <option value="July">July</option>
								 					 <option value="August">August</option>
								 					 <option value="September">September</option>
								 					 <option value="October">October</option>
								 					 <option value="November">November</option>
								 					 <option value="December">December</option>
								 				 </select>
								 				</div>
				<?php
					echo form_error('month','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>',
													'</div>');
													?>
													<div class="form-group">
							 						 <label>Select Year</label>
							 					 <input class="form-control" type="text" id="datepicker" name="year" value="<?php echo $months['year']; ?>" placeholder="Select Year" />
							 					 </div>
				<?php
	        echo form_error('year','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                        </button>',
	                        '</div>');
	                        ?>
       <div class="form-group">
         <label>Edit Money</label>
         <input type="number" class="form-control" name="value" value="<?php echo $months['value']; ?>" placeholder="Add Money">
     </div>
     <?php
       echo form_error('value','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                       </button>',
                       '</div>');
                       ?>
     <button type="submit" class="btn btn-success">Update</button>
     </form>

   </div>

 </div>

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
						$("#datepicker").datepicker({
						    format: "yyyy",
						    viewMode: "years",
						    minViewMode: "years"
						});
						</script>
</body>
</html>
