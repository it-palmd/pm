<?php

$username = $_POST['username'];
$repair_code = $_POST['job_code'];
$repair_symptom = $_POST['repair_symptom'];

include_once('../include/connect_oop_db.php');

  $sql = "UPDATE tbl_repair_register
          SET inspector = '$username',
              repair_symptom = '$repair_symptom',
              last_update = NOW()
           WHERE repair_code = '$repair_code'
          ";


  $result = $mysqli->query($sql);

  echo "OK_UPDATE";

$result->free();
$mysqli->close();

 ?>
