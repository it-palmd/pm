<?php
//fetch.php
include_once('../include/connect_oop_db.php');
// print_r($_POST);
//Job Application Data
$table = $mysqli->real_escape_string($_POST["table"]);
$id = $mysqli->real_escape_string($_POST["data_id"]);

        //Turn autocommit off
        $mysqli->autocommit(FALSE);

        $mysqli->query(" DELETE FROM $table WHERE id = '$id' ");

        // Commit transaction
        if (!$mysqli->commit()) {
          $mysqli->rollback();
          echo "บันทึกลงฐานข้อมูลไม่ได้!". $mysqli->error;
          exit();
        }else{
          // echo print_r($_POST);
          echo "delete_ok";
        }

        // Rollback transaction

        $mysqli->close();

  ?>
