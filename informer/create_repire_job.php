<?php

date_default_timezone_set('Asia/Bangkok');

$date = date('Y-m-d H:i:s');
$repair_code = @$_POST['repair_code'];
$spare_code = strtoupper(@$_POST['spare_code']);
$repair_type = @$_POST['repair_type'];
$breakdown_start = @$_POST['breakdown_start'];
$breakdown_stop = @$_POST['breakdown_stop'];
$repair_symptom = @$_POST['repair_symptom'];
$repair_informer = @$_POST['repair_informer'];
$status = @$_POST['status'];

// $repair_code = 'JOB-0001';
// $spare_code = 'PRD0001';
// $repair_type = 'ccc';
// $breakdown_start = '';
// $breakdown_stop = '';
// $repair_symptom = 'ddd';
// $repair_informer = 'eee';
// $status = 'xxx';

include_once('../include/connectdb.php');

$sql = "INSERT INTO tbl_repair_register (
                                        repair_date,
                                        repair_code,
                                        repair_spare_code,
                                        repair_type,
                                        repair_breakdown_start,
                                        repair_breakdown_stop,
                                        repair_symptom,
                                        repair_informer,
                                        last_update,
                                        status
                                      )
        values (
                '$date',
                '$repair_code',
                '$spare_code',
                '$repair_type',
                '$breakdown_start',
                '$breakdown_stop',
                '$repair_symptom',
                '$repair_informer',
                '$date',
                '$status'
               )";

$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if($result==1){
  //Update Status Sparepart
  $update_status_sparepart = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
  $result1 = mysqli_query($con, $update_status_sparepart) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$update_status_sparepart");

  if($result1==1){
    echo "INSERT_OK";
  }

}

mysqli_close($con);

 ?>
