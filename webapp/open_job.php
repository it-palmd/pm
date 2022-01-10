<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}
// date_default_timezone_set('Asia/Bangkok');

$page = $_SESSION['pm_ses_page'];
$u_level = $_SESSION["pm_level"];
$emp_code = $_SESSION["pm_emp_code"];

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../images/icons/construction-and-tools.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">

    <!-- <link rel="stylesheet" href="dist/css/beyond.min.css" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="dist/bootstrap.css" type="text/css" media="all"> -->
    <link href="dist/jquery.bootgrid.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/bootstrap-datepicker3.css" type="text/css" />
    <!-- <link rel="stylesheet" href="dist/css/main.css" type="text/css" /> -->

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

    @media screen and (max-width: 769px) {
      /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
      .table-responsive { font-size: 80%; }
      .control_box_c { width:800px!important; }
      .navbar { width:325px; margin:0 auto; }
      p { font-size: 80%; }
    }

    @media screen and (min-width: 769px) {
      #page { width:40%; margin:0 auto; }
      small { font-size: 100%; }
    }

      #control_container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* background: #eeeeee; */
        /* height: 200px; */
      }

      .control_box_lr {
        width: 250px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        /* background: #eeeeee; */
      }

      .control_box_c {
        width: 250px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        margin:auto;
      }

      input[type="file"]{
        display: none;
      }


    </style>


  </head>
  <body>

    <!-- Image loader -->
    <div id='loader' class="preLoad"></div>
    <!-- Image loader -->

   <div class="wrapper" style="display:none;">
     <?php include('nav.php'); ?>

   	<div id="content" class="">

      <!-- Begin menu_bar -->

          <div id="control_container" style="padding:10px; margin-bottom:10px;">

            <div class="control_box_lr" style="text-align:left;">
              <button type="button" id="sidebarCollapse" class="btn btn-light">
                <i class="fa fa-align-justify"></i> <span></span>
              </button>
            </div>

              <div class="control_box_c text-center">
                <span class="badge badge-warning mx-auto"><strong>แจ้งซ่อม</strong></span>
              </div>

              <div class="control_box_lr" style="text-align:right;">
                <a href="index.php" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
              </div>

          </div>

      <!-- End menu_bar -->

    <div id="page" class="mr-auto ml-auto" style="">
      <div id="top" class="">
        <div class="col-xs col-sm text-center alert alert-warning fade show" role="">
          <h4 class="lead mb-0"><?php echo $_POST['sp_code']; ?></h4>
          <p class="mb-0"><?php echo $_POST['sp_name']; ?></p>
        </div>
      </div>
      <div id="body" class="text-center">

        <form id="frm_open_job" method="post">

          <input type="hidden" name="spare_code" value="<?php echo $_POST['sp_code']; ?>" />
          <input type="hidden" name="username" value="<?php echo $emp_code; ?>" />

          <div class="text-center">
               <img id="imgAvatar" style="max-width:100%; height:auto;">
          </div>

          <div class="form-group">
            <label for="symptom_pic" class="label-file">
              <span class="glyphicon glyphicon-print"></span> &nbsp;&nbsp;รูปเครื่องจักร
            </label>
               <input type="file" name="symptom_pic" id="symptom_pic" onchange="showPreview(this)" />
               <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
          </div>

          <div class="form-group row mb-0">
            <div class="form-inline col-12"><span id="msg1"></span>
              <label for="job_code" class="form-control-sm col-form-label text-muted pl-0" style="justify-content: left;">เลขที่ใบแจ้งซ่อม: </label>
              <input type="text" name="job_code" id="job_code" class="form-control-lg col-7 form-control-plaintext font-weight-bold text-warning" value="JOB-0001" readonly>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-12 text-left">
              <label for="job_type" class="col-4 col-form-label text-muted pl-0">ประเภทงานซ่อม: <span class="text-danger">*</span></label>
            </div>
            <div class="col-12">
              <select class="form-control-lg form-control text-center" id="job_type" name="job_type" required>
                <option value="">ไม่ระบุ</option>
                <option value="ด่วนมาก">ด่วนมาก</option>
                <option value="ด่วนฉุกเฉิน">ด่วนฉุกเฉิน</option>
                <option value="ปานกลาง">ปานกลาง</option>
                <option value="ปกติ">ปกติ</option>
              </select>
            </div>
          </div>

          <div class="form-group text-left">
            <label for="job_symptom" class="text-muted">อาการเสีย: <span class="text-danger">*</span></label> <small></small>
            <textarea class="form-control-lg form-control" id="job_symptom" name="job_symptom" rows="5" placeholder="ระบุอาการและจุดที่เสีย" required></textarea>
          </div>



          <button type="button" id="save" class="btn btn-lg btn-warning my-3 w-100">บันทึกการแจ้งซ่อม</button>


        </form>



      </div>
      <div id="bottom" class="">

      </div>
   	</div>
</div>



   </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery/jquery-3.3.1.slim.js" integrity="" crossorigin="anonymous"></script>
    <script src="../js/jquery/popper.js" integrity="" crossorigin="anonymous"></script>
    <script src="../js/jquery/bootstrap.js" integrity="" crossorigin="anonymous"></script>

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/jquery-1.11.1.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>
    <script src="dist/jquery.bootgrid.min.js"></script>
    <script src="dist/js/bootstrap-datepicker.js"></script>

    <script>
	    $(document).ready(function(){

        $('.wrapper').fadeIn('slow');

        getCount('count_my_job');
        getCount('count_today_job');
        getCount('count_month_job');
        getCount('count_no_action_job');

        getJobCode();

			$('#sidebarCollapse').on('click',function(){
				$('#sidebar').toggleClass('active');
			});

      $('li').click(function(){
    		$('li').removeClass('active');
    		$(this).addClass('active');
    	});


      //ออกจากระบบ

              $(".logout").click(function(){

                                  $.ajax({
                                      type: "POST",
                                      url: "login/logout.php",
                                      success: function(result) {
                                          if (result == 0) // Success
                                          {
                                              //alert("OK");
                                              $('body').addClass('animated fadeOut');
                                              window.location.href = '../webapp/login/login.php'; //Will take you to Google.
                                          }
                                      }
                                  });
              });
      //ออกจากระบบ


      $('#save').click(function(){

        var job_code = $('#job_code').val();
        var symptom_pic = $('#symptom_pic');
        var job_type = $('#job_type');
        var job_symptom = $('#job_symptom');
        var formData = new FormData($('#frm_open_job')[0]);

        if(symptom_pic.val() == ''){
          alert('กรุณาเลือกรูปภาพเครื่องจักรที่เสีย');
          symptom_pic.focus();
          return false;
        }
        if(job_type.val() == ''){
          alert('กรุณาเลือกประเภทแจ้งซ่อม');
          job_type.focus();
          return false;
        }
        if(job_symptom.val() == ''){
          alert('กรุณาระบุรายละเอียด/อาการเครื่องจักรที่เสีย');
          job_symptom.focus();
          return false;
        }

        $.ajax({
          url: 'check_code.php',
          method: 'post',
          data: {repair_code: job_code},
          beforeSend: function(){
            //Show image container
            $("#loader").show();
            $("#wrapper").hide();
          },
           success: function(data, status){
              console.log(data);
              if(data == 'YES') {
                alert('ไม่สามารถบันทึกได้ เนื่องจากมีเลขที่แจ้งซ่อม '+job_code+' แล้วในระบบ!');
                location.reload();
                return false;
              }else{

                $.ajax({
                  url: 'create_repire_job.php',
                  method: 'post',
                  data: formData,
                  contentType: false,
                  cache: false,
                  processData: false,
                   success: function(data){
                    console.log(data);

                        if(data == 'INSERT_OK'){
                          alert('เปิดแจ้งซ่อมเรียบร้อย')
                          window.location.href = '../webapp/today_job.php'; //Will take you to Google.
                        }else{
                          alert('ERROR:: '+data);
                          window.location.href = '../webapp/index.php'; //Will take you to Google.
                        }
                   }
                });
                return true;
              }
           },
           complete:function(data){
            $("#loader").hide();
            $("#wrapper").show();
          },
          error : function (xhr, status, exception){ alert(status); }
        });

      });






		});
// END Main Jquery




    function showPreview(ele)
     {
         $('#imgAvatar').attr('src', ele.value); // for IE
               if (ele.files && ele.files[0]) {

                   var reader = new FileReader();

                   reader.onload = function (e) {
                       $('#imgAvatar').attr('src', e.target.result);
                   }

                   reader.readAsDataURL(ele.files[0]);
               }
     }

    function getCount(action_name){

      var username = $('.user').text();
      var level = $('.level').text();

      // alert(username.text()+' '+level.text());

        $.ajax({
          url: 'action.php',
          method: 'post',
          data: {'action':'get_'+action_name, 'username':username, 'level':level},
          success:function(response){
            $('#'+action_name).text(response);
          }
        });
    }

    function getJobCode(){
      $.ajax({
        url: 'gen_job_code.php',
        method: 'post',
        success:function(response){
          $('#job_code').val(response);
        }
      });
    }


    function autoTab(obj){
  /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
  หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
  4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
  รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
  หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
  ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
  */
    // alert(obj);
      var pattern=new String("__:__"); // กำหนดรูปแบบในนี้
      var pattern_ex=new String(":"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
      var returnText=new String("");
      var obj_l=obj.value.length;
      var obj_l2=obj_l-1;
      for(i=0;i<pattern.length;i++){
          if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
              returnText+=obj.value+pattern_ex;
              obj.value=returnText;
          }
      }
      if(obj_l>=pattern.length){
          obj.value=obj.value.substr(0,pattern.length);
      }
    }



  </script>




  </body>
</html>
