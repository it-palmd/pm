<?php
$username = @$_POST['username'];
$repair_code = @$_POST['repair_code'];
$spare_code = strtoupper(@$_POST['spare_code']);
$repair_detail = @$_POST['repair_detail'];
$sparepart = @$_POST['sparepart'];
$status = @$_POST['status']; //'In_progress';

include_once('../include/connectdb.php');

if($status=='In_progress'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET tech_accept = '$username',
              tech_accept_date = NOW(),
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";
}

if($status=='Wait_sparepart'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET repair_detail = '$repair_detail',
              wait_sparepart = '$sparepart',
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";
}

if($status=='Wait_to_check'){
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET repair_finished_date = NOW(),
              dispatcher = '$username',
              repair_detail = '$repair_detail',
              wait_sparepart = '$sparepart',
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";
}

  $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if($result==1){

  //Update Status At tbl_sparepart
  $sql1 = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
  $result1 = mysqli_query($con, $sql1) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql1");
  echo "OK_UPDATE";

}//end if

mysqli_close($con);
 ?>
