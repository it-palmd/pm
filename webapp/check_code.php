<?php
  include_once('../include/connect_oop_db.php');

  if(isset($_POST['repair_code'])){

    $repair_code = $_POST['repair_code'];

    $sql="SELECT repair_code FROM tbl_repair_register WHERE repair_code = '$repair_code' ";
    $result = $mysqli->query($sql);
    echo $result->num_rows > 0 ? 'YES' : 'NO';

  }
  $mysqli->close();

 ?>
