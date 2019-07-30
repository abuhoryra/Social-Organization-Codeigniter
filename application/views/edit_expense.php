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
  <form method="post" action="<?php echo base_url('Home/update_expense/'.$expense['id']); ?>">
    <div class="form-group">
      <label>Reason of Expense</label>
      <textarea type="text" name="reason" class="form-control" placeholder="Enter Reason"><?php echo $expense['reason']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Money</label>
      <input type="number" name="value" class="form-control" value="<?php echo $expense['value']; ?>"  placeholder="Add Value">
    </div>

    <div class="" style="text-align: center;">
          <button type="submit" class="btn btn-success">Update</button>
    </div>

  </form>
   </div>
   </div>
  </div>
</div>

</body>
</html>
