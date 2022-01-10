<?php
include_once('../../../include/connect_oop_db.php');
  // echo $_POST["id"];
    $sql = "SELECT * FROM tbl_sparepart_sub WHERE id = ".$_POST["id"];
    $rs = $mysqli->query($sql) or die ($mysqli->error);
    while($row = $rs->fetch_object()){
      $arr[] = $row;
    }
    echo json_encode($arr);
    $rs->free();
    $mysqli->close();
 ?>
