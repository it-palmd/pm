<?php
include_once('../include/connect_oop_db.php');

$event = $_POST['select_job'];

$username = $_POST['username'];
$repair_code = $_POST['job_code'];
$spare_code = $_POST['spare_code'];
$note = $_POST['note'];

$breakdown_stop = $_POST['breakdown_stop'];
$breakdown_start = $_POST['breakdown_start'];

$now_time1=strtotime(date($breakdown_stop));
$now_time2=strtotime(date($breakdown_start));

$time_diff=abs($now_time2-$now_time1);
$time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
$time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
$time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน

$breakdown_time = $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s. " วินาที ";

  $event == "accept" ? $status = 'Active' : $status = 'In_progress';

  $mysqli->autocommit(FALSE);

  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET repair_breakdown_start = '$breakdown_start',
              repair_breakdown_stop = '$breakdown_stop',
              repair_breakdown_time = '$breakdown_time',
              repair_breakdown_time_h = '$time_diff_h',
              repair_breakdown_time_m = '$time_diff_m',
              repair_breakdown_time_s = '$time_diff_s',
              note = '$note',
              inspector = '$username',
              close_job_date = NOW(),
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";

  $result = $mysqli->query($sql);
  // Commit transaction
    if (!$result) {
      // Rollback transaction
      $mysqli->rollback();
      echo "UPDATE_inspector_FAILED";
      exit();
    }

  //Update Status At tbl_sparepart
  $sql1 = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
  $result1 = $mysqli->query($sql1);
  // Commit transaction
    if (!$result1) {
      // Rollback transaction
      $mysqli->rollback();
      echo "UPDATE_status_tbl_sparepart_FAILED";
      exit();
    }

  // Commit transaction
  if (($result) && ($result1)) {
    // echo print_r($_POST);
    //Update Status At tbl_sparepart
    $mysqli->commit();
    echo "OK_UPDATE";

  }

  $result-free();
  $mysqli->close();

 ?>
