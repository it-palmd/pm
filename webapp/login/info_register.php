<?php
//login.php
session_start();
if(!isset($_SESSION["reg_username"]))
{
 header('location:../login/login.php');
}
?>
<!DOCTYPE html>
<!-- saved from url=(0057)https://asardakani.info/envato/galaxy/reset_password.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PALMD - Register Infomation</title>
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
                    <div class="auth-text-top mb-0 text-center">
                        <h1>Register Infomation</h1>
                        <small class="text-success">การลงทะเบียนเสร็จสมบูรณ์แล้ว.</small>
                    </div>
                    <div class="text-center mb-3"><small class="text-secondary">*อีเมลจะใช้ในการส่งรายละเอียดของการขอเปลี่ยนรหัสผ่านของท่าน.</small></div>

                    <form id="frm_info_register" method="post">
                        <div class="table-responsive">
                             <table class="table table-bordered">
                                        <tr>
                                             <td width="30%" class="text-right"><label>Username: </label></td>
                                             <td width="70%"><label><?=$_SESSION['reg_username'];?></label></td>
                                        </tr>
                                        <tr>
                                             <td width="30%" class="text-right"><label>Email: </label></td>
                                             <td width="70%"><?=$_SESSION['reg_email'];?></td>
                                        </tr>
                                        <tr>
                                             <td width="30%" class="text-right"><label>level: </label></td>
                                             <td width="70%"><?=$_SESSION['reg_level'];?></td>
                                        </tr>
                                        <tr>
                                             <td width="30%" class="text-right"><label>Status: </label></td>
                                             <td width="70%"><label class="text-success"><?=($_SESSION['reg_status']=='T' ? 'Active' : 'Inactive'); ?></label></td>
                                        </tr>
                            </table>
                        </div>

                        <!-- <div class="text-center">
                          <progress value="0" max="10" id="progressBar"></progress>
                        </div> -->
                        <!-- นับย้อนหลังแล้วให้กลับไปหน้า login -->
                        <div class="row begin-countdown">
                          <div class="col-md-12 text-center">
                            <progress value="60" max="60" id="pageBeginCountdown" class="">60</progress>
                            <p> กำลังพาท่านกลับไปหน้า Login ในอีก <span id="pageBeginCountdownText" style="color:red;">60 </span> seconds</p>
                          </div>
                        </div>

                      <div class="auth-text-bottom">
                          <input type="hidden" name="username" value="<?=$_SESSION['reg_username'];?>" />
                          <input type="hidden" name="email" value="<?=$_SESSION['reg_email'];?>" />
                          <input type="hidden" name="password" value="<?=$_SESSION['reg_password'];?>" />
                          <button type="submit" id="btn_loginnow" class="btn btn-primary btn-block btn-c mt-2 mb-4" autofocus="">Login Now</button>
                          <p>Already have an account?<a id="link_loginpage" href="logout.php"> Login to Account</a></p>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 auth-right d-lg-flex d-none bg-gradient" id="particles">
            <div class="logo">
                <img src="img/pds-logo.png" width="100" alt="logo">
            </div>
            <div class="heading">
                <h3>Welcome to PALMD</h3>
            </div>
            <div class="shape"></div>
        <canvas class="particles-js-canvas-el" width="0" height="0" style="width: 100%; height: 100%;"></canvas></div>
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

  $('#body').fadeIn('slow');

  //นับถอยหลังแล้วกลับไปยังหน้า Login
  // var timeleft = 10;
  // var downloadTimer = setInterval(function(){
  //
  //   document.getElementById("progressBar").value = 10 - timeleft;
  //   //document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
  //   timeleft -= 1;
  //   if(timeleft <= 0)
  //     clearInterval(downloadTimer);
  // }, 1000);

  ProgressCountdown(60, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => window.location = 'logout.php' ); //$('#btn_loginnow').click(), alert(`Page has started: ${value}.`

    function ProgressCountdown(timeleft, bar, text) {
      return new Promise((resolve, reject) => {
        var countdownTimer = setInterval(() => {
          timeleft--;

          document.getElementById(bar).value = timeleft;
          document.getElementById(text).textContent = timeleft;

          if (timeleft <= 0) {
            clearInterval(countdownTimer);
            resolve(true);
          }
        }, 1000);
      });
    }


   $('#frm_info_register').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"check_login.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data){
      //alert(data);
      if(data == 1)
      {
        window.location = '../index.php';
      }
      else
      {
       $('#error_message').html(data);
      }
     }
    })
   });

});
</script>
