<?php
include_once('../include/connect_oop_db.php');

// echo print_r($_POST);

if(isset($_POST["arr_spare_use"])){         //ตรวจสอบว่ามีการส่งค่า

  //รับค่าจาก form ที่ส่งมา
  $repair_code = $_POST['arr_repair_code'];
  $spare_use = $_POST['arr_spare_use'];
  $spare_quantity = $_POST['arr_spare_quantity'];

// print_r($_POST);

  $sql = '';      //ประกาศตัวแปรไว้สำหรับรับค่าชุดคำสั่ง sql

  for($count=0; $count<count($spare_use); $count++){      //วนลูปคำสั่ง insert ว่ามีทั้งหมดกี่คำสั่ง

    $repair_code_clean = $mysqli->real_escape_string($repair_code[$count]);
    $spare_use_clean = $mysqli->real_escape_string($spare_use[$count]);
    $spare_quantity_clean = $mysqli->real_escape_string($spare_quantity[$count]);

  }

  $mysqli->autocommit(FALSE);

  if($pr_product_clean != ''){

    //Update tbl_repire_register
    $sql = "INSERT INTO tbl_job_spare_use(repair_code, spare_use, spare_quantity) VALUES ( '$repair_code_clean', '$spare_use_clean', '$spare_quantity_clean' )";

  }

  if($sql != ''){

      $result = $mysqli->multi_query($sql);
      // Commit transaction
        if (!$result) {
          // Rollback transaction
          $mysqli->rollback();
          echo "UPDATE_tbl_job_spare_use_FAILED";
          exit();
        }else{
          $mysqli->commit();
          echo "OK_INSERT";
        }

  }

    $mysqli->close();

}
// End If
 ?>
