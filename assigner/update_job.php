<?php
$username = @$_POST['username'];
$repair_code = @$_POST['repair_code'];
$spare_code = strtoupper(@$_POST['spare_code']);
$desired_date = @$_POST['desired_date'];
$tech_leader = @$_POST['tech_leader'];
$tech_2 = @$_POST['tech_2'];
$tech_3 = @$_POST['tech_3'];
$tech_4 = @$_POST['tech_4'];
$tech_5 = @$_POST['tech_5'];
$tech_group = @$_POST['tech_group'];
$external_company = @$_POST['external_company'];
$external_leader = @$_POST['external_leader'];
$status = 'Wait_technician';

// $arr  = explode(" - ",$tech_leader);
// $leader = $arr[0];

if($tech_2 == 'ช่าง'){ $tech_2 = ''; }
if($tech_3 == 'ช่าง'){ $tech_3 = ''; }
if($tech_4 == 'ช่าง'){ $tech_4 = ''; }
if($tech_5 == 'ช่าง'){ $tech_5 = ''; }

// $username = 'test';
// $repair_code = 'JOB-0005';
// $spare_code = 'PRD0001';
// $desired_date = '2019-12-16 15:12:05';
// $tech_leader = 'พี่เขียว';
// $tech_group = 'ช่างกล';
// $external_company = '';
// $external_leader = '';
//
// //technician
// $arrTech = array($tech_leader, 'long', 'mckub', 'along', 'alongka');

include_once('../include/connectdb.php');

$sql2 = "";

  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET assigner = '$username',
              assign_date = NOW(),
              desired_date = '$desired_date',
              tech_leader = '$tech_leader',
              tech_group = '$tech_group',
              tech_2 = '$tech_2',
              tech_3 = '$tech_3',
              tech_4 = '$tech_4',
              tech_5 = '$tech_5',
          ";

if($tech_group=='ว่าจ้างช่างนอก'){
  $sql .= "   external_company = '$external_company',
              external_leader = '$external_leader',
          ";
}
  $sql .= "
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";

  $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if($result==1){

  //Update Status At tbl_sparepart
  $sql1 = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
  $result1 = mysqli_query($con, $sql1) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql1");
  echo "OK_UPDATE";

}//end if

mysqli_close($con);
 ?>
