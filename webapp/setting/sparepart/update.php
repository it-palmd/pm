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


    // ข้อมูลขนาดและส่วนประกอบ
    $compo_chain = mysqli_real_escape_string($connect, $_POST["compo_chain_edit"]);
    $compo_sporcket = mysqli_real_escape_string($connect, $_POST["compo_sporcket_edit"]);
    $compo_drive_shaft = mysqli_real_escape_string($connect, $_POST["compo_drive_shaft_edit"]);
    $compo_end_shaft = mysqli_real_escape_string($connect, $_POST["compo_end_shaft_edit"]);
    $compo_key = mysqli_real_escape_string($connect, $_POST["compo_key_edit"]);
    $compo_driver_side_bearing = mysqli_real_escape_string($connect, $_POST["compo_driver_side_bearing_edit"]);
    $compo_side_bearing_shirt = mysqli_real_escape_string($connect, $_POST["compo_side_bearing_shirt_edit"]);
    $compo_drive_side_bearing = mysqli_real_escape_string($connect, $_POST["compo_drive_side_bearing_edit"]);
    $compo_side_bearing = mysqli_real_escape_string($connect, $_POST["compo_side_bearing_edit"]);
    $compo_liner = mysqli_real_escape_string($connect, $_POST["compo_liner_edit"]);
    $compo_bucket = mysqli_real_escape_string($connect, $_POST["compo_bucket_edit"]);
    $compo_scraper_bar = mysqli_real_escape_string($connect, $_POST["compo_scraper_bar_edit"]);

    // ข้อมูลมอเตอร์
    $motor_brand = mysqli_real_escape_string($connect, $_POST["motor_brand_edit"]);
    $motor_ser_no = mysqli_real_escape_string($connect, $_POST["motor_ser_no_edit"]);
    $motor_model_type = mysqli_real_escape_string($connect, $_POST["motor_model_type_edit"]);
    $motor_rpm = mysqli_real_escape_string($connect, $_POST["motor_rpm_edit"]);
    $motor_vot = mysqli_real_escape_string($connect, $_POST["motor_vot_edit"]);
    $motor_amp = mysqli_real_escape_string($connect, $_POST["motor_amp_edit"]);
    $motor_kw = mysqli_real_escape_string($connect, $_POST["motor_kw_edit"]);
    $motor_hp = mysqli_real_escape_string($connect, $_POST["motor_hp_edit"]);
    $motor_bearing = mysqli_real_escape_string($connect, $_POST["motor_bearing_edit"]);
    $motro_drive_shaft = mysqli_real_escape_string($connect, $_POST["motro_drive_shaft_edit"]);
    $motor_pulley = mysqli_real_escape_string($connect, $_POST["motor_pulley_edit"]);
    $motor_coupling = mysqli_real_escape_string($connect, $_POST["motor_coupling_edit"]);
    $motor_belt = mysqli_real_escape_string($connect, $_POST["motor_belt_edit"]);

    // ข้อมูลเกียร์
    $gear_brand = mysqli_real_escape_string($connect, $_POST["gear_brand_edit"]);
    $gear_ser_no = mysqli_real_escape_string($connect, $_POST["gear_ser_no_edit"]);
    $gear_model_type = mysqli_real_escape_string($connect, $_POST["gear_model_type_edit"]);
    $gear_na_rpm = mysqli_real_escape_string($connect, $_POST["gear_na_rpm_edit"]);
    $gear_ne_rpm = mysqli_real_escape_string($connect, $_POST["gear_ne_rpm_edit"]);
    $gear_i = mysqli_real_escape_string($connect, $_POST["gear_i_edit"]);
    $gear_im = mysqli_real_escape_string($connect, $_POST["gear_im_edit"]);
    $gear_bearing = mysqli_real_escape_string($connect, $_POST["gear_bearing_edit"]);
    $gear_drive_shaft = mysqli_real_escape_string($connect, $_POST["gear_drive_shaft_edit"]);
    $gear_pulley = mysqli_real_escape_string($connect, $_POST["gear_pulley_edit"]);
    $gear_lubrication = mysqli_real_escape_string($connect, $_POST["gear_lubrication_edit"]);

    // ข้อมูลอุอุปกรณ์ไฟฟ้าควบคุม
    $elec_circuit_beraker = mysqli_real_escape_string($connect, $_POST["elec_circuit_beraker_edit"]);
    $elec_magnetic_contactor = mysqli_real_escape_string($connect, $_POST["elec_magnetic_contactor_edit"]);
    $elec_overload_relay = mysqli_real_escape_string($connect, $_POST["elec_overload_relay_edit"]);
    $elec_relay = mysqli_real_escape_string($connect, $_POST["elec_relay_edit"]);
    $elec_miniature_circuit_beraker = mysqli_real_escape_string($connect, $_POST["elec_miniature_circuit_beraker_edit"]);
    $elec_timer_relay = mysqli_real_escape_string($connect, $_POST["elec_timer_relay_edit"]);
    $elec_current_tranformer = mysqli_real_escape_string($connect, $_POST["elec_current_tranformer_edit"]);

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
                compo_chain='".$compo_chain."',
                compo_sporcket='".$compo_sporcket."',
                compo_drive_shaft='".$compo_drive_shaft."',
                compo_end_shaft='".$compo_end_shaft."',
                compo_key='".$compo_key."',
                compo_driver_side_bearing='".$compo_driver_side_bearing."',
                compo_side_bearing_shirt='".$compo_side_bearing_shirt."',
                compo_drive_side_bearing='".$compo_drive_side_bearing."',
                compo_side_bearing='".$compo_side_bearing."',
                compo_liner='".$compo_liner."',
                compo_bucket='".$compo_bucket."',
                compo_scraper_bar='".$compo_scraper_bar."',
                motor_brand='".$motor_brand."',
                motor_ser_no='".$motor_ser_no."',
                motor_model_type='".$motor_model_type."',
                motor_rpm='".$motor_rpm."',
                motor_vot='".$motor_vot."',
                motor_amp='".$motor_amp."',
                motor_kw='".$motor_kw."',
                motor_hp='".$motor_hp."',
                motor_bearing='".$motor_bearing."',
                motro_drive_shaft='".$motro_drive_shaft."',
                motor_pulley='".$motor_pulley."',
                motor_coupling='".$motor_coupling."',
                motor_belt='".$motor_belt."',
                gear_brand='".$gear_brand."',
                gear_ser_no='".$gear_ser_no."',
                gear_model_type='".$gear_model_type."',
                gear_na_rpm='".$gear_na_rpm."',
                gear_ne_rpm='".$gear_ne_rpm."',
                gear_i='".$gear_i."',
                gear_im='".$gear_im."',
                gear_bearing='".$gear_bearing."',
                gear_drive_shaft='".$gear_drive_shaft."',
                gear_pulley='".$gear_pulley."',
                gear_lubrication='".$gear_lubrication."',
                elec_circuit_beraker='".$elec_circuit_beraker."',
                elec_magnetic_contactor='".$elec_magnetic_contactor."',
                elec_overload_relay='".$elec_overload_relay."',
                elec_relay='".$elec_relay."',
                elec_miniature_circuit_beraker='".$elec_miniature_circuit_beraker."',
                elec_timer_relay='".$elec_timer_relay."',
                elec_current_tranformer='".$elec_current_tranformer."',
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
