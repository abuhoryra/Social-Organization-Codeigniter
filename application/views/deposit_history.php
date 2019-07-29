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


    <h3 style="text-align: center; margin-top: 3%">Deposit History</h3>
    <h5 style="text-align: center; color: deepskyblue;">Total Deposit: <?php echo $calulate_deposit.' Tk.'; ?></h5>

    <br>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Depositor Name</th>
          <th scope="col">Depositor Phone</th>
          <th scope="col">Recipent Name</th>
          <th scope="col">Recipent Phone</th>
          <th scope="col">Value</th>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $count = $this->uri->segment(3);
      foreach ($history as $row) {
        $count++;
        ?>
        <tr>
          <th scope="row"><?php echo $count; ?></th>
          <td><?php echo $row['depositor_name']; ?></td>
          <td><?php echo '0'.$row['depositor_phone']; ?></td>
          <td><?php echo $row['recipient_name']; ?></td>
          <td><?php echo '0'.$row['recipient_phone']; ?></td>
          <td><?php echo $row['value']; ?></td>
          <td><?php echo date("jS F, Y", $row['time']); ?></td>
          <td><?php echo date("g:iA", $row['time']); ?></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo base_url('Home/edit_deposit/'.$row['id']); ?>">Edit</a>
                <a class="dropdown-item" href="<?php echo base_url('Home/delete_deposit/'.$row['id']); ?>">Delete</a>
              </div>
           </div>
          </td>
        </tr>
        <?php
      }
        ?>
      </tbody>
    </table>
    <div class="pagination" style="margin-left: 45%; margin-top: 1%;">
 <?php echo $this->pagination->create_links(); ?>
  </div>
</div>
</body>
</html>
