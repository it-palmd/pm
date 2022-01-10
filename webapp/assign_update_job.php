<?php
include_once('../include/connect_oop_db.php');


$username = $_POST['username'];
$repair_code = $_POST['job_code'];
$spare_code = strtoupper($_POST['spare_code']);
$desired_date = $_POST['desired_date'];
$tech_leader = $_POST['tech_leader'];
(isset($_POST['tech_2'])?$tech_2 = $_POST['tech_2']:$tech_2 = '');
(isset($_POST['tech_3'])?$tech_3 = $_POST['tech_3']:$tech_3 = '');
(isset($_POST['tech_4'])?$tech_4 = $_POST['tech_4']:$tech_4 = '');
(isset($_POST['tech_5'])?$tech_5 = $_POST['tech_5']:$tech_5 = '');
// $tech_3 = $_POST['tech_3'];
// $tech_4 = $_POST['tech_4'];
// $tech_5 = $_POST['tech_5'];
$tech_group = $_POST['tech_group'];
$repair_type_by = $_POST['repair_type_by'];
$status = 'Wait_technician';

// $arr  = explode(" - ",$tech_leader);
// $leader = $arr[0];

// print_r($_POST);

$mysqli->autocommit(FALSE);

  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET assigner = '$username',
              assign_date = NOW(),
              desired_date = '$desired_date',
              tech_group = '$tech_group',
              repair_type_by = '$repair_type_by',
              tech_leader = '$tech_leader',
              tech_2 = '$tech_2',
              tech_3 = '$tech_3',
              tech_4 = '$tech_4',
              tech_5 = '$tech_5',
              last_update = NOW(),
              status = '$status'
          WHERE repair_code = '$repair_code'
        ";

      $result = $mysqli->query($sql);
      // Commit transaction
        if (!$result) {
          // Rollback transaction
          $mysqli->rollback();
          echo "UPDATE_tbl_repair_register_FAILED";
          exit();
        }

      $sql1 = "UPDATE tbl_sparepart SET status = '$status' WHERE spare_code = '$spare_code' ";
      $result1 = $mysqli->query($sql1);

      // Commit transaction
        if (!$result1) {
          // Rollback transaction
          $mysqli->rollback();
          echo "UPDATE_tbl_sparepart_FAILED";
          exit();
        }

        // Commit transaction
          if (($result) && ($result1)) {

            // echo print_r($_POST);
            //Update Status At tbl_sparepart
            $mysqli->commit();
            echo "OK_UPDATE";

          }

    $mysqli->close();


 ?>
