<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

$connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
mysqli_set_charset($connect, "utf8");

  // echo $_POST["user_id"];
    $password = $_POST["password_edit"];
    $email_edit = $_POST["email_edit"];
    $level_edit = mysqli_real_escape_string($connect, $_POST["level_edit"]);
    $system_edit = mysqli_real_escape_string($connect, $_POST["system_edit"]);
    $emp_code_edit = mysqli_real_escape_string($connect, $_POST["emp_code_edit"]);
    $status_edit = mysqli_real_escape_string($connect, $_POST["status_edit"]);

    $sql = "UPDATE tbl_users
            SET email='".$email_edit."',
                level='".$level_edit."',
                system='".$system_edit."',
                emp_code='".$emp_code_edit."', ";

  if(isset($password)){
    //เข้ารหัสด้วย function password_hash
    $pass_generate = password_hash($password, PASSWORD_DEFAULT);
    $sql .= "   password='".$pass_generate."',";
  }

    $sql .= "
                status='".$status_edit."'
            WHERE id = ".$_POST["user_id"];

    $rs = mysqli_query($connect, $sql);

    if($rs){
      echo 'update_ok';
    }else{
      echo $sql;
    }

    mysqli_close($connect);

 ?>
