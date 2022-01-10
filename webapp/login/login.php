<?php
//login.php
session_start();

if(isset($_SESSION["pm_user"]))
{
 header('location:../index.php');
}
?>
<!DOCTYPE html>
<!-- saved from url=(0049)https://asardakani.info/envato/galaxy/login.html# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/icons/construction-and-tools.png" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - PALMD SYSTEMS</title>
    <link  rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.3.92/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/galaxy-style.css">
</head>
<body>
<div id="body" class="container-fluid" style="display:none">
    <div class="row">
        <div class="col-lg-4 auth-left">
            <div class="row auth-form">
                <div class="col-12 col-sm-12">
                    <div class="auth-text-top">
                        <img src="../../images/icons/construction-and-tools.png" width="150" alt="pic">
                        <h1 class="my-0">ระบบซ่อมบำรุง</h1>
                        <p class="text-muted">บริษัท ปาล์มดีศรีนคร จำกัด</p>
                        <small>Please login to your account</small> <!--  or <a href="register.php">Create Account</a> -->
                    </div>
                    <div class="text-center"><span id="error_message" style="display:none"></span></div>
                    <form action="" method="POST" id="login_form">
                        <!-- <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon">
                                <i class="mdi mdi-email"></i>
                                <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_COOKIE['member_login'])){ echo $_COOKIE['member_login']; } ?>" placeholder="Enter Your Email" autofocus="" required="">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-icon">
                                <i class="mdi mdi-account"></i>
                                <input type="text" class="form-control" id="username" name="username" value="" placeholder="Enter Your Username" autofocus="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-icon">
                                <i class="mdi mdi-lock"></i>
                                <span class="passtoggle mdi mdi-eye toggle-password"></span>
                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter Your Password" required="">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-c mt-4 mb-4" id="submit">Login</button>
                    </form>
                    <!-- <p class="divider">Or</p>
                    <div class="btn-social mb-4">
                        <button class="btn bg-primary"><i class="mdi mdi-facebook"></i></button>
                        <button class="btn bg-danger"><i class="mdi mdi-google"></i></button>
                        <button class="btn bg-dark"><i class="mdi mdi-github-circle"></i></button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-lg-8 auth-right d-lg-flex d-none bg-pds" id="particles">
            <div class="logo">
                <img src="img/pds-logo.png" width="100%" alt="palmd logo">
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

  $('#username').focus();

   $('#login_form').on('submit', function(event){

    console.log($(this).serialize());

    event.preventDefault();
    $.ajax({
     url:"check_login.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data){
      console.log(data);
      if(data == 1)
      {
        window.location = '../index.php';
      }
      else
      {
       $('#error_message').fadeIn('slow').html(data);
      }
     }
    })
   });

});
</script>
