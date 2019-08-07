<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Month</title>
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
  <br>
  <!-- Button trigger modal -->
  <div style="text-align:center;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      Add Month
    </button>
  </div>
<hr>
    <h3 style="text-align: center; margin-top: 3%">Month</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Month</th>
          <th scope="col">Year</th>
          <th scope="col">Money</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if($months){
        $count = 0;
      foreach ($months as $row) {
        $count++;
        ?>
        <tr>
          <th scope="row"><?php echo $count; ?></th>
          <td><?php echo $row['month']; ?></td>
          <td><?php echo $row['year']; ?></td>
          <td><?php echo $row['value']; ?></td>
          <td><a class="btn btn-info btn-sm" href="<?php echo base_url('Home/edit_month/'.$row['id']); ?>">Edit</a></td>
        </tr>
        <?php
      }
    }
    else{
      ?>
      <h3>No Month Added</h3>
      <?php
    }
        ?>
      </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Month</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form class="" action="<?php echo base_url('Home/save_month'); ?>" method="post">
              <?php
                echo form_error('month_year','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>',
                                '</div>');
                                ?>
              <div class="form-group">
                <label>Select Month</label>
                <select class="form-control" name="month">
                  <option value="">Select Month</option>
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
                 <label>Add Year</label>
               <input class="form-control" type="text" id="datepicker" name="year" placeholder="Select Year" />
               </div>
               <?php
                 echo form_error('year','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>',
                                 '</div>');
                                 ?>
              <div class="form-group">
                <label>Add Money</label>
                <input type="number" class="form-control" name="value" placeholder="Add Money">
            </div>
            <?php
              echo form_error('value','<div id="al" class="alert alert-danger">     <button type="button" class="close" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>',
                              '</div>');
                              ?>
            <button type="submit" class="btn btn-success">Save</button>
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
if(isset($modal) && $modal){
  ?>
  <script type='text/javascript'>

$('#myModal').modal('show');

  </script>
  <?php
}

?>
<script type="text/javascript">
$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
});
</script>
<script type="text/javascript">
$("#datepicker1").datepicker({
    format: "mm",
    viewMode: "months",
    minViewMode: "months"
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
