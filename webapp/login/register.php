<?php
session_start();
//echo $_SESSION["user"];
if(!isset($_SESSION["user"]))
{
 header('location:login.php');
}
if(isset($_SESSION["user"]) && $_SESSION["level"] != 'administrator'){
  header('location:index.php');
}
$page = $_SESSION['ses_page'];
$u_level = $_SESSION["level"];


 ?>

<!DOCTYPE html>
<!-- saved from url=(0051)https://asardakani.info/envato/galaxy/register.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PALMD - Register</title>
    <link  rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.3.92/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/galaxy-style.css">
</head>
<body>
<div id="body" class="container-fluid" style="display:none">
    <div class="row">
        <div class="col-lg-4 auth-left">
            <div class="row auth-form mb-4">
                <div class="col-12 col-sm-12">
                    <div class="auth-text-top mb-4">
                        <h1>Create Account</h1>
                        <small>Already have an account? <a href="login.php">Login to Account</a></small>
                    </div>
                    <div id="error_message" class="text-center" style="display:none"></div>
                    <form id="frm_register" action="" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-icon">
                                <i class="mdi mdi-account"></i>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" autofocus="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon">
                                <i class="mdi mdi-email"></i>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required="">
                                <small class="text-secondary">อีเมลใช้ส่งรายละเอียดในการขอเปลี่ยนรหัสผ่าน.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-icon">
                                <i class="mdi mdi-lock"></i>
                                <span class="passtoggle mdi mdi-eye toggle-password"></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="level">Level</label>
                          <select class="form-control" id="level" name="level">
                            <option value="store">Store</option>
                            <option value="purchase">Purchase</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="administrator">Administrator</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status">
                            <option value="T">Active</option>
                            <option value="F">Inactive</option>
                          </select>
                        </div>
                        <!-- <div class="d-flex form-check">
                            <input type="checkbox" class="filter" id="remember" checked="">
                            <label for="remember">I Accept <a href="https://asardakani.info/envato/galaxy/register.html#">Terms and Conditions</a></label>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-block btn-c mt-4 mb-4">Create an account</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 auth-right d-lg-flex d-none bg-pds" id="particles">
            <div class="logo">
                <img src="img/pds-logo.png" width="100%" alt="logo">
            </div>
            <div class="heading text-secondary">
                <!-- <h3>ะบบจัดการโรงงานปาล์ม <span class="text-primary">บริษัท ปาล์มดีศรีนคร จำกัด</span></h3> -->
            </div>
            <div class="shape"></div>
        <!-- <canvas class="particles-js-canvas-el" width="1239" height="250" style="width: 100%; height: 100%;"></canvas> -->
      </div>
    </div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/particles.js"></script>
<script src="js/custom.js"></script>

</body>
</html>


<script>
$(document).ready(function(){

  $('#body').fadeIn('slow');  //แสดงผลแบบ ค่อยๆแสดง ด้วย function fadeIn()

  $('#frm_register')[0].reset();  //ล้างข้อมูลใน Input Text ทั้งหมด

   $('#frm_register').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"insert_register.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data){
      //alert(data);
      if(data == 1)
      {
        window.location = '../login/info_register.php';
      }
      else
      {
       $('#error_message').fadeIn().html(data);
      }
     }
    })
   });

});
</script>
