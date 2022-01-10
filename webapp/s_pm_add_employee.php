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

include_once('../include/connectdb.php');

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
    <link rel="stylesheet" type="text/css" href="dist/css/jquery.datetimepicker.css"/>
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
          #page { width:50%; margin:0 auto; }
          small { font-size: 100%; }
        }

        #control_container_nav ,#control_container {
          display: flex;
          align-items: center;
          justify-content: space-around;
          /* background: #eeeeee; */
          /* height: 200px; */
        }

        .control_box_lr, .control_box_lr_nav {
          width: 350px;
          /* height: 50px;
          line-height: 50px; */
          text-align: center;
          /* background: #eeeeee; */
        }

        .control_box_c, .control_box_c_nav {
          width: 550px;
          /* height: 50px;
          line-height: 50px; */
          text-align: center;
          margin:auto;
        }

        .row { margin: -10px!important; }

    </style>

  </head>
  <body>

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
                <span class="badge badge-warning mx-auto"><strong>ระบบซ่อมบำรุง ปาล์มดีศรีนคร</strong></span>
              </div>

              <div class="control_box_lr" style="text-align:right;">
                <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
              </div>

          </div>

      <!-- End menu_bar -->

    <div id="page" class="mr-auto ml-auto">
      <div id="top" class="">
        <div class="col-xs col-sm text-center alert alert-info fade show" role="">
          <h4 class="lead mb-0">ลงทะเบียนพนักงานใหม่</h4>
        </div>
      </div>


      <form>

        <div id="body" class="card card-default">

          <div class="card-body">

                <h5 class="card-title">ข้อมูลส่วนตัว</h5>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="inputTitle">คำนำหน้า(ไทย)</label>
                    <input type="text" class="form-control" id="inputTitle" placeholder="ระบุคำนำหน้า">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="inputFirstname">ชื่อ(ไทย)</label>
                    <input type="text" class="form-control" id="inputFirstname" placeholder="ระบุชื่อ">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="inputLastname">นามสกุล(ไทย)</label>
                    <input type="text" class="form-control" id="inputLastname" placeholder="ระบุนามสกุล">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputId_card">หมายเลขบัตรประจำตัวประชาชน</label>
                    <input type="text" class="form-control" id="inputId_card" placeholder="ระบุหมายเลขบัตรประจำตัวประชาชน 13 หลัก">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputBirth_date">วัน เดือน ปีเกิด</label>
                    <input type="text" class="form-control" id="inputBirth_date" placeholder="">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputSex">เพศ</label>
                    <input type="text" class="form-control" id="inputSex" placeholder="เพศ">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAge">อายุ</label>
                    <input type="text" class="form-control" id="inputAge" placeholder="อายุ">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputNationality">เชื้อชาติ</label>
                    <input type="text" class="form-control" id="inputNationality" placeholder="เชื้อชาติ">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputReligion">ศาสนา</label>
                    <input type="text" class="form-control" id="inputReligion" placeholder="ศาสนา">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputTelephone">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="inputTelephone" placeholder="ระบุเบอร์โทรศัพท์ที่สามารถติดต่อได้">
                  </div>
                </div>
                <br/>

                <h5 class="card-title">ที่อยู่ที่สามารถติดต่อได้</h5>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputAddress_no">บ้านเลขที่</label>
                    <input type="text" class="form-control" id="inputAddress_no" placeholder="บ้านเลขที่">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputMoo">หมู่ที่</label>
                    <input type="text" class="form-control" id="inputMoo" placeholder="หมู่ที่">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputVillage">หมู่บ้าน/อาคาร/ชัน</label>
                    <input type="text" class="form-control" id="inputVillage" placeholder="หมู่ที่">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLane">ตรอก/ซอย</label>
                    <input type="text" class="form-control" id="inputLane" placeholder="หมู่บ้าน/อาคาร/ชัน">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputRoad">ถนน</label>
                    <input type="text" class="form-control" id="inputRoad" placeholder="ถนน">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputPost">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control" id="inputPost" placeholder="รหัสไปรษณีย์">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputDistrict">ตำบล/แขวง</label>
                    <input type="text" class="form-control" id="inputDistrict" placeholder="ตำบล/แขวง">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCounty">อำเภอ/เขต</label>
                    <input type="text" class="form-control" id="inputCounty" placeholder="อำเภอ/เขต">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputProvince">จังหวัด</label>
                    <input type="text" class="form-control" id="inputProvince" placeholder="จังหวัด">
                  </div>
                </div>
                <br/>

                <h5 class="card-title">ที่อยู่ตามทะเบียนบ้าน</h5>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      เหมือนที่อยู่ที่สามารถติดต่อได้
                    </label>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputAddress_no_2">บ้านเลขที่</label>
                    <input type="text" class="form-control" id="inputAddress_no_2" placeholder="บ้านเลขที่">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputMoo_2">หมู่ที่</label>
                    <input type="text" class="form-control" id="inputMoo_2" placeholder="หมู่ที่">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputVillage_2">หมู่บ้าน/อาคาร/ชัน</label>
                    <input type="text" class="form-control" id="inputVillage_2" placeholder="หมู่ที่">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLane_2">ตรอก/ซอย</label>
                    <input type="text" class="form-control" id="inputLane_2" placeholder="หมู่บ้าน/อาคาร/ชัน">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputRoad_2">ถนน</label>
                    <input type="text" class="form-control" id="inputRoad_2" placeholder="ถนน">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputPost_2">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control" id="inputPost_2" placeholder="รหัสไปรษณีย์">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputDistrict_2">ตำบล/แขวง</label>
                    <input type="text" class="form-control" id="inputDistrict_2" placeholder="ตำบล/แขวง">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCounty_2">อำเภอ/เขต</label>
                    <input type="text" class="form-control" id="inputCounty_2" placeholder="อำเภอ/เขต">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputProvince_2">จังหวัด</label>
                    <input type="text" class="form-control" id="inputProvince_2" placeholder="จังหวัด">
                  </div>
                </div>


          </div>

          <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="reset" class="btn btn-default">รีเซ็ต</button>
          </div>

        </div>

      </form>

<!-- bottom panel       -->
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
    <script src="dist/js/jquery.datetimepicker.js"></script>

    <script>
	    $(document).ready(function(){

        $('.wrapper').fadeIn('slow');
        
        getCount('count_my_job');
        getCount('count_today_job');
        getCount('count_month_job');
        getCount('count_no_action_job');

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



// technicain รับงานซ๋อมและส่งงาน
            $('.tech_save').click(function(){

              var working_day = $('#working_day');
              var job_detail = $('#job_detail');

              if(working_day.val() == '0000-00-00 00:00:00'){
                  alert('ยังไม่ได้ระบุวันที่และเวลา เข้าซ่อม!');
                  working_day.focus();
                  exit();
              }
              if(job_detail.val() == ''){
                  alert('ยังไม่ได้ระบุรายละเอียดการซ่อม!');
                  job_detail.focus();
                  exit();
              }

              // alert("continue");

                    $.ajax({
                      url: 'tech_update_job.php',
                      method: 'post',
                      data: $("#frm_tech_update_job").serialize(),
                      success:function(response){

                        // alert(response);

                        if(response=='OK_ACCEPT'){
                          alert("รับงานแล้ว");
                          window.history.back();
                        }
                        if(response=='OK_SAVE'){
                          alert("บันทึกเรียบร้อย");
                          window.history.back();
                        }
                        if(response=='OK_SEND'){
                          alert("ส่งงานแล้ว");
                          window.history.back();
                        }

                          // window.location.href = '../webapp/my_job.php'; //Will take you to Google.

                      }

                    });


            });


      // assigner มอบหมายงาน
            $('#assign_save').click(function(){

              var desired_date = $('#desired_date');
              var tech_group = $('#tech_group');
              var tech_leader = $('#tech_1');

              if(desired_date.val() == ''){

                alert("โปรดระบุวันที่ซ่อมเสร็จ!");
                desired_date.focus();

              }else if(tech_group.val() == ''){

                alert("โปรดระบุกลุ่มช่าง!");
                tech_group.focus();

              }else if(tech_group.val() != 'ว่าจ้างช่างนอก' && tech_leader.val() == ''){

                alert("ยังไม่ได้ระบุหัวหน้าช่าง");
                tech_leader.focus();

              }else{

                $.ajax({
                  url: 'assign_update_job.php',
                  method: 'post',
                  data: $("#frm_assign_update_job").serialize(),
                  success:function(response){
                    // alert(response);
                    if(response=='OK_UPDATE'){
                      alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                      window.location.href = '../webapp/my_job.php'; //Will take you to Google.
                    }else{
                      alert("ผิดพลาด");
                    }

                  }
                });

              }

            });


            // $('#job_symptom').on('blur',function(){
      			// 	$('#sidebar').toggleClass('active');
      			// });


      // infermer ตรวจงาน
            $('#inf_save').click(function(){

              var note = $('#note');
              var e = document.getElementById('event');

              if(e.value == 'reject' && note.val() == ''){

                alert("ระบุหมายเหตุก่อน !");
                note.focus();

              }else{

                var r = confirm("คุณต้องการปิดงานซ่อมนี้ ใช่หรือไม่!");
                if (r == true) {

                    $.ajax({
                      url: 'infor_update_job.php',
                      method: 'post',
                      data: $("#frm_inf_update_job").serialize(),
                      success:function(response){
                        // alert(response);
                        if(response=='OK_UPDATE'){
                          alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                          window.location.href = '../webapp/my_job.php'; //Will take you to Google.
                        }else{
                          alert("ผิดพลาด");
                        }

                      }
                    });

                }

              }

            });


            $('#working_day').datetimepicker({
              format:'Y-m-d H:i',
              mask:'9999-19-39 29:59',
              step:1
            });

            $('#breakdown_stop').datetimepicker({
              format:'Y-m-d H:i',
              mask:'9999-19-39 29:59',
              step:1
            });

            $('#breakdown_start').datetimepicker({
              format:'Y-m-d H:i',
              mask:'9999-19-39 29:59',
              step:1
            });

            $('#desired_date').datetimepicker({
              format:'Y-m-d',
              mask:'9999-19-39',
              timepicker:false
            });



		});

    function getChecked() {
      // Get the checkbox
      var breakdown = document.getElementById("breakdown");
      // Get the output text
      var breakdown_panel = document.getElementById("breakdown_panel");

      // If the checkbox is checked, display the output text
      if (breakdown.checked == true){
        breakdown_panel.style.display = "block";
      } else {
        breakdown_panel.style.display = "none";
      }
    }


    function check() {
      // Get the checkbox
      var wait_spair = document.frm_tech_update_job.wait_spair;
      var btn_tech_save = document.getElementById("tech_save");
      var e = document.getElementById('event');

      // If the checkbox is checked, display the output text
      for (var i=0; i < wait_spair.length; i++)
      {
        if (wait_spair[i].checked)
        {
           if (wait_spair[i].value == 'รอ'){
             e.value = 'save_job';
             btn_tech_save.innerHTML = 'บันทึก';
           } else {
             e.value = 'send_job';
             btn_tech_save.innerHTML = 'ส่งงาน';
           }
           // alert(e.value);
        }
      }



    }


    function check_tech_group() {

      var tech_group = document.getElementById("tech_group");
      var external_tech = document.getElementById("external_tech");
      var internal_tech = document.getElementById("internal_tech");

      // If the checkbox is checked, display the output text
        if(tech_group.value == ''){
          external_tech.style.display = "none";
          internal_tech.style.display = "none";
        }else if (tech_group.value == 'ว่าจ้างช่างนอก'){
          external_tech.style.display = "block";
          internal_tech.style.display = "none";
        } else {
          external_tech.style.display = "none";
          internal_tech.style.display = "block";
        }
    }


    function check_job(value) {

      var reject_panel = document.getElementById("reject_panel");
      var note = document.getElementById("note");

      document.getElementById('event').value = value;

      // If the checkbox is checked, display the output text
      if (value == 'reject'){
          reject_panel.style.display = "block";
          note.focus();
        } else {

          reject_panel.style.display = "none";
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

    function update_symptom(job_code){

      var username = $('.user').text();
      var repair_symptom = document.getElementById("job_symptom").value;
      // alert(username+ ' ' + repair_symptom.value);

      $.ajax({
        url: 'infor_update_symptom.php',
        method: 'post',
        data: {'job_code': job_code, 'username': username, 'repair_symptom': repair_symptom} ,
        success:function(response){
          // alert(response);
          if(response=='OK_UPDATE'){
            alert("บันทึกข้อมูลเรียบร้อยแล้ว");
            window.location.href = '../webapp/my_job.php'; //Will take you to Google.
          }else{
            alert("ผิดพลาด");
          }

        }
      });

    }


  </script>




  </body>
</html>
