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


    <div class="form-group">
    <label for="exampleFormControlSelect1">Edit Depositor Name</label>

    <select id="name" class="form-control" id="exampleFormControlSelect1" class="select" name="phone">
     <option value="<?php  echo $deposit['depositor_phone'];?>"><?php  echo $deposit['depositor_name'];?></option>
      <?php

       foreach ($member as $row) {

          ?>
          <option  value="<?php echo $row['phone'];?>">
            <?php
  echo $row['first_name'].' '.$row['last_name'];

            ?>
          </option>

          <?php

        }

      ?>
</select>

  </div>


  <div class="form-group">
      <label for="exampleInputPassword1">Edit Money</label>
      <input name="value" type="number" value="<?php echo $deposit['value']; ?>" class="form-control" placeholder="Tk.">
    </div>



<input type="hidden" name="recipient_phone" value="<?php echo $admin['phone'];?>">
<input type="hidden" name="recipient_name" value="<?php echo $admin['first_name'].' '.$admin['last_name'];?>">
<div style="text-align: center;">
  <button type="submit" class="btn btn-success">Save</button>
</div>

      </form>
  </div>
</div>
<script type="text/javascript">
var optionValues =[];
$('#name option').each(function(){
 if($.inArray(this.value, optionValues) >-1){
    $(this).remove()
 }else{
    optionValues.push(this.value);
 }
});
</script>
<script type="text/javascript">
$('#name').on('change', function() {
   var number = this.value;
  $("#phone").val(function() {
    return number;
});
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
