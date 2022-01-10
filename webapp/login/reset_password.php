<!DOCTYPE html>
<!-- saved from url=(0057)https://asardakani.info/envato/galaxy/reset_password.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PALMD - Reset Password</title>
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
                    <div class="auth-text-top mb-4 text-center">
                        <h1>Reset Password</h1>
                        <small>กรอกอีเมลของคุณ เราจะส่งรายละเอียดการเปลี่ยนรหัสผ่านให้คุณทางอีเมลนี้</small>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon">
                                <i class="mdi mdi-email"></i>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" autofocus="" required="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-c mt-4 mb-4">Reset Password</button>
                        <div class="auth-text-bottom">
                            <p>Already have an account? <a href="login.php"> Login to Account</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 auth-right d-lg-flex d-none bg-pds" id="particles">
            <div class="logo">
                <img src="img/pds-logo.png" width="100%" alt="logo">
            </div>
            <div class="heading">
                <!-- <h3>Welcome to PALMD</h3> -->
            </div>
            <div class="shape"></div>
        <!-- <canvas class="particles-js-canvas-el" width="0" height="0" style="width: 100%; height: 100%;"></canvas></div> -->
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

});
</script>
