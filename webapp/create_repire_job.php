<?php
include_once('../include/connectdb.php');
date_default_timezone_set('Asia/Bangkok');  //DATE_FORMAT(NOW(), '%Y%m%d')

$repair_code =  mysqli_real_escape_string($connect, $_POST['job_code']);
$spare_code = strtoupper(mysqli_real_escape_string($connect, $_POST['spare_code']));
$repair_type = mysqli_real_escape_string($connect, $_POST['job_type']);
$repair_symptom = mysqli_real_escape_string($connect, $_POST['job_symptom']);
$repair_informer = mysqli_real_escape_string($connect, $_POST['username']);
$status = 'Wait_assignment';


mysqli_autocommit($connect, FALSE);

      if($_FILES['symptom_pic']['name'] != ''){

      //แยกชื่อ และประเภทไฟล์ภาพ ออกจากกันเพื่อมาสร้างชื่อไฟล์ใหม่
         $type = strrchr($_FILES['symptom_pic']['name'],".");

         if($type == ".jpg" || $type == ".jpeg"){
            // $d = date("Ymd");
            $numrand = (mt_rand());

            $new_name = "R_".$spare_code."_".$numrand.$type;
            $path = "C:/xampp/htdocs/pm/webapp/images/symptom/" . $new_name;

            $symptom_pic = $new_name;

            mysqli_query($connect, "INSERT INTO tbl_repair_register ( repair_date, repair_code, repair_spare_code, repair_type,
                                                                      repair_symptom, repair_symptom_pic, repair_informer, last_update, status
                                                                    ) values (
                                                                              NOW(), '$repair_code', '$spare_code', '$repair_type',
                                                                              '$repair_symptom', '$symptom_pic', '$repair_informer', NOW(), '$status'
                                                                              )
                        ");

            // Commit transaction
              if (!mysqli_commit($connect)) {

                echo "INSERT_FAILED";
                exit();

              }else{
                // echo print_r($_POST);

                move_uploaded_file($_FILES['symptom_pic']['tmp_name'], $path); //ทำการ copy รูป

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
                } else if($size[2] == 3) {
                  $images_orig = imagecreatefrompng($path);
                }
                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);
                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                imagejpeg($images_fin, $path); //ชื่อไฟล์ใหม่
                imagedestroy($images_orig);
                imagedestroy($images_fin);

                echo "INSERT_OK";

              }

              // Rollback transaction
              mysqli_rollback($connect);

              mysqli_close($connect);

          }else{
            echo "NO_PIC_FORMAT";
          }

        }

 ?>
