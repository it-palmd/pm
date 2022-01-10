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

  if(isset($_POST["spare_type_code_edit"]) && isset($_POST["spare_type_name_edit"])){

    $spare_type_code_edit = $_POST["spare_type_code_edit"];
    $spare_type_name_edit = mysqli_real_escape_string($connect, $_POST["spare_type_name_edit"]);
    $status_edit = mysqli_real_escape_string($connect, $_POST["status_edit"]);

    $sql = "UPDATE tbl_sparepart_type
            SET spare_type_name='".$spare_type_name_edit."',
                status='".$status_edit."',
                create_by='".$_SESSION["user"]."',
                create_date= NOW()
            WHERE id = ".$_POST["spare_type_id"];

    $rs = mysqli_query($connect, $sql);

    if($rs){
      echo 'update_ok';
    }else{
      echo $sql;
    }

    mysqli_close($connect);

  }else{
    echo 'error';
  }
 ?>
