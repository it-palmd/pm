<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["username"];

    $check = 'SELECT username FROM tbl_users WHERE username = "'.$_POST["username"].'" ';
    $rs1 = mysqli_query($connect, $check) or die(mysqli_error());
    $num = mysqli_num_rows($rs1);

    if($num > 0)
    {

      echo "invalid_username";

    }else{

    $username = mysqli_real_escape_string($connect, $_POST["username"]);
    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $pass_generate = password_hash($_POST['password'], PASSWORD_DEFAULT); //Password ที่เข้าระหัสแล้ว
    $level = mysqli_real_escape_string($connect, $_POST["level"]);
    $system = mysqli_real_escape_string($connect, $_POST["system"]);
    $emp_code = mysqli_real_escape_string($connect, $_POST["emp_code"]);
    $status = mysqli_real_escape_string($connect, $_POST["status"]);

            $sql = "INSERT INTO tbl_users ( username, email, password, level, system, status, create_by, create_date_time, emp_code )
                    VALuES ( '$username','$email','$pass_generate', '$level', '$system', '$status', '".$_SESSION["pm_user"]."', NOW(), '$emp_code' )
                    ";

            $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

            if($rs){
              echo 'insert_ok';
            }else{
              echo $sql;
            }

      mysqli_close($connect);

  }

  ?>
