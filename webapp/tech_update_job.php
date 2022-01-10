<?php
include_once('../include/connect_oop_db.php');

// //สตริงที่ ถูก stringify จาก client มีการ escape \\ จึงแทนที่ด้วยค่าว่างเพื่อให้เป็นรูปแบบ JSON สตริงที่ถูกต้อง
$other_str = str_replace('\\','',$_POST['other_data']);
//ดีโค้ด JSON สตริงให้เป็นอะเรย์
$other_data = json_decode($other_str, true);

// echo print_r($_POST);
// echo $other_data['arr_job_code'][0];
// echo print_r($other_data['arr_spare_use']);
// echo $_POST['job_detail'];

$username = $mysqli->real_escape_string($_POST['username']);
$repair_code = $mysqli->real_escape_string($_POST['job_code']);
$spare_code = $mysqli->real_escape_string($_POST['spare_code']);
$event = $mysqli->real_escape_string($_POST['event']);
$ex_tech = $mysqli->real_escape_string($_POST['ex_tech']);

$msg = '';

$mysqli->autocommit(FALSE);

if($event == 'accept_job'){

  $msg = 'OK_ACCEPT';
  $status = 'In_progress';
  //Update tbl_repire_register
  $sql = "UPDATE tbl_repair_register
          SET tech_accept = '$username',
              tech_accept_date = NOW(),
              last_update = NOW(),
              status = '$status'
           WHERE repair_code = '$repair_code'
          ";

  $result = $mysqli->query($sql);
  // Commit transaction
    if (!$result) {
      // Rollback transaction
      $mysqli->rollback();
      echo "UPDATE_tech_accept_FAILED";
      exit();
    }else{
      //Update Status At tbl_sparepart
      $mysqli->commit();

    }
}

if($event == 'save_job' || $event == 'send_job'){

  if($ex_tech == 'EX'){
    $external_company = $mysqli->real_escape_string($_POST['external_company']);
    $external_tech_leader = $mysqli->real_escape_string($_POST['external_tech_leader']);
    $external_phone = $mysqli->real_escape_string($_POST['external_phone']);
  }else{
    $external_company = '';
    $external_tech_leader = '';
    $external_phone = '';
  }
  $repair_detail = $mysqli->real_escape_string($_POST['job_detail']);
  $wait_sparepart = $mysqli->real_escape_string($_POST['wait_sparepart']);
  $pr_no = $mysqli->real_escape_string($_POST['pr_no']);

    if($_FILES['image_file']['name'] != ''){
      //แยกชื่อ และประเภทไฟล์ภาพ ออกจากกันเพื่อมาสร้างชื่อไฟล์ใหม่
         $type = strrchr($_FILES['image_file']['name'],".");

          $d = date("Ymd");
          $numrand = (mt_rand());

          $new_name = 'R_'.$d.'_'.$repair_code.$type;
          $path = "images/repair/" . $new_name;

    }

  if($event == 'save_job'){ //save job รับงาน

    $msg = 'OK_SAVE';
    $status = 'In_progress';
    $working_day = '0000-00-00 00:00';
    $working_day_stop = '0000-00-00 00:00';
    $repair_detail_pic = '';

  }else if($event == 'send_job'){ //save job ส่งงาน

    copy($_FILES['image_file']['tmp_name'], $path); //ทำการ copy รูป

    $size = getimagesize($path);
    // print_r($size);
    // $height = 600; //กำหนดขนาดความสูง
    $width = 800; //ขนาดความกว้่าง
    $height = round($width*$size[1]/$size[0]); //ขนาดความสูงคำนวนเพื่อความสมส่วนของรูป
    // $width = round($height*$size[0]/$size[1]); //ขนาดความกว้่างคำนวนเพื่อความสมส่วนของรูป
    if($size[2] == 1) {
    $images_orig = imagecreatefromgif($path); //resize รูปประเภท GIF
    } else if($size[2] == 2) {
    $images_orig = imagecreatefromjpeg($path); //resize รูปประเภท JPEG
    }
    $photoX = imagesx($images_orig);
    $photoY = imagesy($images_orig);
    $images_fin = imagecreatetruecolor($width, $height);
    imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
    imagejpeg($images_fin, $path); //ชื่อไฟล์ใหม่
    imagedestroy($images_orig);
    imagedestroy($images_fin);

    $msg = 'OK_SEND';
    $status = 'Wait_to_check';
    $working_day = $mysqli->real_escape_string($_POST['working_day']);
    $working_day_stop = $mysqli->real_escape_string($_POST['working_day_stop']);
    $repair_detail_pic = $new_name;

  }
  // end if send job

      //Update tbl_repire_register
      $sql = "UPDATE tbl_repair_register
              SET dispatcher = '$username',
                  repair_finished_date = NOW(),
                  repair_detail_pic = '$repair_detail_pic',
                  repair_detail = '$repair_detail',
                  wait_sparepart = '$wait_sparepart',
                  pr_no = '$pr_no',
                  working_day = '$working_day',
                  working_day_stop = '$working_day_stop',
                  last_update = NOW(),
                  status = '$status',
                  external_company = '$external_company',
                  external_tech_leader = '$external_tech_leader',
                  external_phone = '$external_phone'
                WHERE repair_code = '$repair_code' ";

                $result1 = $mysqli->query($sql);
      // Commit transaction
        if (!$result1) {
          // Rollback transaction
          $mysqli->rollback();
          $msg = "UPDATE_send_job_FAILED :: ". $sql;
          exit();
        }

if($other_data['arr_job_code'][0] != ''){         //ตรวจสอบว่ามีการส่งค่า array other_data

        //รับค่าจาก form ที่ส่งมา
        $arr_job_code = $other_data['arr_job_code'];
        $arr_spare_use = $other_data['arr_spare_use'];
        $arr_spare_quantity = $other_data['arr_spare_quantity'];
        $arr_unit_count = $other_data['arr_unit_count'];

      // print_r($_POST);

        $sql1 = '';      //ประกาศตัวแปรไว้สำหรับรับค่าชุดคำสั่ง sql

        for($count=0; $count<count($arr_job_code); $count++){      //วนลูปคำสั่ง insert ว่ามีทั้งหมดกี่คำสั่ง

          $job_code_clean = $mysqli->real_escape_string($arr_job_code[$count]);
          $spare_use_clean = $mysqli->real_escape_string($arr_spare_use[$count]);
          $spare_quantity_clean = $mysqli->real_escape_string($arr_spare_quantity[$count]);
          $unit_count_clean = $mysqli->real_escape_string($arr_unit_count[$count]);

          if($spare_use_clean != ''){
              //Insert tbl_job_spare_use
              $sql1 .= " INSERT INTO tbl_job_spare_use ( job_code, spare_use, spare_quantity, unit_count ) VALUES ( '$job_code_clean', '$spare_use_clean', '$spare_quantity_clean', '$unit_count_clean' ); ";
          }

        }
        // end if count $sql1 sql command
          // echo "SQL COMMAND:: ".$sql1;

        if($sql1 != ''){

            /* execute multi query */
            if ($result2 = $mysqli->multi_query($sql1)) {
                do {
                    /* store first result set */
                    // $msg = $sql1;
                } while ($mysqli->next_result());
            }

            // $result2 = $mysqli->multi_query($sql1);
            if (!$result2) {
                // Rollback transaction
                $mysqli->rollback();
                $msg = "UPDATE_tbl_job_spare_use_FAILED". $sql1;
                exit();
            }

        }
        // end if $sql

      }
      // End If $other_data

        if (($result1) && ($result2)) {
          // echo print_r($_POST);
          // $msg = 'OK_SEND';
          $mysqli->commit();
        }
          // end if $result

}
// End Save And Send Job

  echo $msg;

  // $mysqli->close();

 ?>
