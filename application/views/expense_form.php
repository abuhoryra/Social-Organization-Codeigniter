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

  <div class="container mt-5">
 <div class="row">
   <div class="col-md-7" style="margin: 0 auto;">
  <form method="post" action="<?php echo base_url('Home/save_expense'); ?>">
    <div class="form-group">
      <label>Reason of Expense</label>
      <textarea type="text" name="reason" class="form-control" placeholder="Enter Reason"></textarea>
    </div>
    <?php
      echo form_error('reason','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>',
                      '</div>');
                      ?>
    <div class="form-group">
      <label>Money</label>
      <input type="number" name="value" class="form-control"  placeholder="Add Value">
    </div>
    <?php
      echo form_error('value','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>',
                      '</div>');
                      ?>
    <div class="" style="text-align: center;">
          <button type="submit" class="btn btn-success">Save</button>
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
