<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["spare_code"];

  if(isset($_POST["spare_code"])){

    $check = 'SELECT spare_code FROM tbl_sparepart WHERE spare_code = "'.$_POST["spare_code"].'" ';
    $rs1 = mysqli_query($connect, $check) or die(mysqli_error());
    $num = mysqli_num_rows($rs1);

    if($num > 0)
    {

      echo "invalid_code";

    }else{

      $spare_code = strtoupper(mysqli_real_escape_string($connect, $_POST["spare_code"]));
      $spare_category = mysqli_real_escape_string($connect, $_POST["spare_category"]);
      $spare_name_th = mysqli_real_escape_string($connect, $_POST["spare_name_th"]);
      $spare_name_en = mysqli_real_escape_string($connect, $_POST["spare_name_en"]);
      $spare_description = mysqli_real_escape_string($connect, $_POST["spare_description"]);
      $spare_location = mysqli_real_escape_string($connect, $_POST["spare_location"]);
      $spare_brand = mysqli_real_escape_string($connect, $_POST["spare_brand"]);
      $spare_model = mysqli_real_escape_string($connect, $_POST["spare_model"]);
      $spare_dealer = mysqli_real_escape_string($connect, $_POST["spare_dealer"]);
      $spare_price = $_POST["spare_price"];
      $spare_pic = "";
      $spare_amount = $_POST["spare_amount"];
      $spare_min = $_POST["spare_min"];
      $spare_install_date = mysqli_real_escape_string($connect, $_POST["spare_install_date"]);
      $spare_start_work = mysqli_real_escape_string($connect, $_POST["spare_start_work"]);
      $spare_stop_work = mysqli_real_escape_string($connect, $_POST["spare_stop_work"]);
      $note = mysqli_real_escape_string($connect, $_POST["note"]);
      $status = mysqli_real_escape_string($connect, $_POST["status"]);

      if($_FILES['spare_pic']['name'] != '')
      {

      //แยกชื่อ และประเภทไฟล์ภาพ ออกจากกันเพื่อมาสร้างชื่อไฟล์ใหม่
         $type = strrchr($_FILES['spare_pic']['name'],".");

         if($type == ".jpg" || $type == ".jpeg"){
            // $d = date("Ymd");
            $numrand = (mt_rand());

            $new_name = $spare_code."_".$numrand.$type;
            $path = "C:/xampp/htdocs/pm/webapp/images/sparepart/" . $new_name;

            $spare_pic = $new_name;

            $sql = "INSERT INTO tbl_sparepart
                      ( spare_code,
                        spare_category,
                        spare_name_th,
                        spare_name_en,
                        spare_description,
                        spare_location,
                        spare_brand,
                        spare_model,
                        spare_dealer,
                        spare_price,
                        spare_pic,
                        spare_amount,
                        spare_min,
                        spare_install_date,
                        spare_start_work,
                        spare_stop_work,
                        note,
                        update_by,
                        last_update_date,
                        status
                      ) VALuES (
                        '$spare_code','$spare_category', '$spare_name_th', '$spare_name_en', '$spare_description', '$spare_location', '$spare_brand',
                         '$spare_model', '$spare_dealer', '$spare_price', '$spare_pic', '$spare_amount', '$spare_min',
                         '$spare_install_date', '$spare_start_work', '$spare_stop_work', '$note', '".$_SESSION["pm_user"]."', NOW(),'$status'
                      )";

            $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

            if($rs){

              move_uploaded_file($_FILES['spare_pic']['tmp_name'], $path); //ทำการ copy รูป

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

              echo 'ok';

            }else{
              echo $sql;
            }
            mysqli_close($connect);

          }else{
            echo "ชนิดของรูปผิดพลาด!";
            return false;
          }

      }//END if ตรวจสอบชื่อไฟล์รูปที่ส่งเข้ามา

    }//ENd Check Spare Code ซ้ำ

  }else{
    echo 'ไม่ได้สร้างรหัสเครื่องจักร';
  }//ENd Check ค่าว่าง Spare Code

  ?>
