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
  font-size: 25px;
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
  font-size: 18px;
  margin-left: 15%;
  color: deepskyblue;
}
#sideList:hover{
  color: white;
}
</style>
</head>
<body>

<div class="sidenav">
  <a href="#" id="side">Admin</a>
  <div class="list" style="display: none;">
      <a id="sideList" href="<?php echo site_url('Home');?>">Admin List</a>
      <a id="sideList" href="<?php echo site_url('Home/add_money');?>">Add Money</a>
  </div>
  <a href="<?php echo site_url('Home/deposit_history');?>">History</a>
  <a href="<?php echo site_url('Login/logout');?>">Logout</a>
</div>
<script>
$(document).ready(function(){
  $("#side").click(function(){
    $(".list").toggle();
  });
});
</script>
