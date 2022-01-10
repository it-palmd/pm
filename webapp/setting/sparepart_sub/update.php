<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["spare_id"];

  if(isset($_POST["spare_code_edit"]) && isset($_POST["spare_name_th_edit"])){

    $spare_code = $_POST["spare_code_edit"];
    $spare_category = mysqli_real_escape_string($connect, $_POST["spare_category_edit"]);
    $spare_name_th = mysqli_real_escape_string($connect, $_POST["spare_name_th_edit"]);
    $spare_name_en = mysqli_real_escape_string($connect, $_POST["spare_name_en_edit"]);
    $spare_description = mysqli_real_escape_string($connect, $_POST["spare_description_edit"]);
    $spare_location = mysqli_real_escape_string($connect, $_POST["spare_location_edit"]);
    $spare_brand = mysqli_real_escape_string($connect, $_POST["spare_brand_edit"]);
    $spare_model = mysqli_real_escape_string($connect, $_POST["spare_model_edit"]);
    $spare_dealer = mysqli_real_escape_string($connect, $_POST["spare_dealer_edit"]);
    $spare_install_date = mysqli_real_escape_string($connect, $_POST["spare_install_date_edit"]);
    $spare_start_work = mysqli_real_escape_string($connect, $_POST["spare_start_work_edit"]);
    $spare_stop_work = mysqli_real_escape_string($connect, $_POST["spare_stop_work_edit"]);
    $note = mysqli_real_escape_string($connect, $_POST["note_edit"]);
    $status = mysqli_real_escape_string($connect, $_POST["status_edit"]);

    if($spare_install_date == "" || $spare_install_date == "0000-00-00"){ $spare_install_date = "0000-00-00"; }
    if($spare_start_work == "" || $spare_start_work == "0000-00-00"){ $spare_start_work = "0000-00-00"; }
    if($spare_stop_work == "" || $spare_stop_work == "0000-00-00"){ $spare_stop_work = "0000-00-00"; }

    $spare_pic = "";

    if($_FILES['spare_pic_edit']['name'] == '')
    {

      $spare_pic = $_POST["spare_pic_old_edit"];

    }else{
      //แยกชื่อ และประเภทไฟล์ภาพ ออกจากกันเพื่อมาสร้างชื่อไฟล์ใหม่
         $type = strrchr($_FILES['spare_pic_edit']['name'],".");

         if($type == ".jpg" || $type == ".jpeg"){
            $d = date("Ymd");
            $numrand = (mt_rand());

            $new_name = $spare_code."_".$numrand.$type;
            $path = "C:/xampp/htdocs/pm/webapp/images/sparepart/" . $new_name; //New Path

            unlink("C:/xampp/htdocs/pm/webapp/images/sparepart/" . $_POST["spare_pic_old_edit"]);  //Old pic Delete

            $spare_pic = $new_name;

            move_uploaded_file($_FILES['spare_pic_edit']['tmp_name'], $path); //ทำการ copy รูป

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

          }else{
            echo "ชนิดของรูปผิดพลาด!";
            return false;
          }

    }//End Check ว่ามีการส่งไฟล์ภาพเข้ามาด้วยไหม

    //Update DB
    $sql = "UPDATE tbl_sparepart
            SET spare_category='".$spare_category."',
                spare_name_th='".$spare_name_th."',
                spare_name_en='".$spare_name_en."',
                spare_description='".$spare_description."',
                spare_location='".$spare_location."',
                spare_brand='".$spare_brand."',
                spare_model='".$spare_model."',
                spare_dealer='".$spare_dealer."',
                spare_price='".$_POST["spare_price_edit"]."',
                spare_pic='".$spare_pic."',
                spare_amount='".$_POST["spare_amount_edit"]."',
                spare_min='".$_POST["spare_min_edit"]."',
                spare_install_date='".$spare_install_date."',
                spare_start_work='".$spare_start_work."',
                spare_stop_work='".$spare_stop_work."',
                update_by='".$_SESSION["pm_user"]."',
                last_update_date=NOW(),
                note='".$note."',
                status='".$status."'
            WHERE id = ".$_POST["spare_id"];

    $rs = mysqli_query($connect, $sql);

    if($rs){
      echo 'ok';
    }else{
      echo $sql;
    }

    mysqli_close($connect);


  }else{
    echo 'ไม่มีการป้อนค่า รหัสและชื่อเครื่องจักร เข้ามา';
  }
 ?>
