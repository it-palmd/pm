<?php

session_start();

//include connection file
include_once("../connection.php");

$db = new dbObj();
$connString =  $db->getConnstring();

    // Insert admin_login Data
    if(isset($_POST['username'])) {

      $output = '';

      // Check Email
      $sql_user = "SELECT * FROM `tbl_users` WHERE username = '".$_POST["username"]."' ";
      $q = mysqli_query($connString, $sql_user);

        if(mysqli_num_rows($q) >= 1){

            echo '<label class="text-danger">ชื่อผู้ใช้ '.$_POST['username'].' มีอยู่แล้วในระบบ! กรุณาใช้ชื่อใหม่</label>';

        }else{
          //เข้ารหัสด้วย function password_hash
          $pass_generate = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $sql = "INSERT INTO `tbl_users` (username, email, password, level, status, last_login, create_by, create_date_time)
                  VALUES(
                    '" . mysqli_real_escape_string($connString, $_POST["username"]) . "',
                    '" . mysqli_real_escape_string($connString, $_POST["email"]) . "',
                    '" . $pass_generate . "',
                    '" . mysqli_real_escape_string($connString, $_POST["level"]) . "',
                    '" . mysqli_real_escape_string($connString, $_POST["status"]) . "', now(),
                    '" . mysqli_real_escape_string($connString, $_POST["username"]) . "', now()
                  ); ";
          //echo $sql;
          mysqli_query($connString, $sql) or die("error to insert users data".mysqli_error($connString));

          $_SESSION['reg_username'] = $_POST["username"];
          $_SESSION['reg_email'] = $_POST["email"];
          $_SESSION['reg_password'] = $_POST["password"];
          $_SESSION['reg_level'] = $_POST["level"];
          $_SESSION['reg_status'] = $_POST["status"];
          session_write_close();

          echo $output = 1;

        }

    }else{
          echo '<label class="text-danger">Register Fail</label>';
    }

 ?>
