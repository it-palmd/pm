
<?php
session_start();
//check_login.php
include_once('../../include/connectdb.php');

if(isset($_POST["username"]))
{

 $result = mysqli_query($connect, " SELECT * FROM tbl_users u
                                    INNER JOIN tbl_employee e
                                    ON u.emp_code = e.emp_code
                                    WHERE username = '".$_POST['username']."'
                                   ");

 $output = '';

 if(mysqli_num_rows($result) > 0)
 {
  foreach($result as $row)
  {
   if(password_verify($_POST["password"], $row["password"]))  //แปลง password โดย function password_verify(,) ที่ถูกเข้ารหัสโดย function password_hash(,)
   {
    //Remember Checked
    if(!empty($_POST["remember"])) {
        setcookie ("member_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
        if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
      //สร้าง session user login
      $_SESSION["pm_user"] = $row["username"];
      $_SESSION["pm_emp_code"] = $row["emp_code"];
      $_SESSION["pm_emp_fullname"] = $row["emp_title"].$row["emp_firstname"]." ".$row["emp_lastname"];
      $_SESSION["pm_level"] = $row["level"];
      $_SESSION['pm_ses_page'] = "MAIN";  //set Page

      //ทำลาย session ข้อมูล user login กรณีกดเข้าระบบจากปุ่มที่หน้า info_register
      unset($_SESSION["reg_username"]);
      unset($_SESSION["reg_email"]);
      unset($_SESSION["reg_password"]);
      unset($_SESSION["reg_level"]);
      unset($_SESSION["reg_status"]);
      session_write_close();

      // Update Last_Login
      $res_update_last_login = mysqli_query($connect, 'UPDATE tbl_users SET last_login = now()
                                WHERE username = "'.$_POST["username"].'" ')
                                or die(mysqli_error($connect));

      $output = 1;
   }
   else
   {
    $output = '<label class="text-danger">Username หรือ Password ผิด!</label>';
   }
  }
 }
 else
 {
  $output = '<label class="text-danger">Username นี้ไม่มีในระบบ!</label>';
 }

 echo $output;
}

?>
