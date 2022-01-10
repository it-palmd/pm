<?php

$username = @$_POST['username'];
$repair_code = @$_POST['repair_code'];
$spare_code = @$_POST['spare_code'];
$status = @$_POST['status']; //'In_progress';

// $username = 'test2';
// $repair_code = 'JOB-0002';
// $spare_code = 'PDG-011';
// $status = 'Wait_to_check';

include_once('../include/connectdb.php');

if($status=='In_progress'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";
}

if($status=='accept'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET inspector = '$username',
              close_job_date = NOW(),
              last_update = NOW(),
              status = 'Active'
           WHERE repair_code = '$repair_code'
          ";
}

if($status=='reject'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET inspector = '$username',
              last_update = NOW(),
              status = 'In_progress'
           WHERE repair_code = '$repair_code'
          ";
}

  $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if($result==1){

  if($status == 'accept'){
    $status = 'Active';
  }else if($status == 'reject'){
    $status = 'In_progress';
  }

  //Update Status At tbl_sparepart
  $sql1 = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
  $result1 = mysqli_query($con, $sql1) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql1");
  echo "OK_FINISH";

}//end if

mysqli_close($con);
 ?>
