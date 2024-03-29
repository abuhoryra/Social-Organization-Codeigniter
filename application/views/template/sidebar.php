<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
#sideList{
  font-size: 15px;
  margin-left: 15%;
  color: deepskyblue;
}
#sideList:hover{
  color: white;
}
#sideList_2{
  font-size: 15px;
  margin-left: 15%;
  color: deepskyblue;
}
#sideList_2:hover{
  color: white;
}
</style>

<body>

<div class="sidenav">
  <a href="#" id="side">User</a>
  <div class="list" style="display: none;">
      <a id="sideList" href="<?php echo site_url('Home');?>">User List</a>
      <?php
      if(is_super()){
     ?>
     <a id="sideList" href="<?php echo site_url('Home/add_money');?>">Add Deposit</a>
     <a id="sideList" href="<?php echo site_url('Home/add_expense');?>">Add Expense</a>
     <a id="sideList" href="<?php echo site_url('Home/add_month');?>">Add Month</a>
     <?php
      }
   ?>

  </div>
  <a href="#" id="side_2">Deposit History</a>
  <div class="list_2" style="display: none;">
    <?php
       if(is_super()){
      ?>
      <a id="sideList_2" href="<?php echo site_url('Home/deposit_history');?>">All Deposit</a>
      <?php
       }
    ?>

      <a id="sideList_2" href="<?php echo site_url('Home/my_deposit');?>">My Deposit</a>
  </div>
  <a href="<?php echo site_url('Home/get_all_expense');?>">Expense History</a>
  <a href="<?php echo site_url('Home/get_my_profile');?>">My Profile</a>
  <a href="<?php echo site_url('Login/logout');?>">Logout</a>
</div>
<script>
$(document).ready(function(){
  $("#side").click(function(){
    $(".list").toggle();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#side_2").click(function(){
    $(".list_2").toggle();
  });
});
</script>
