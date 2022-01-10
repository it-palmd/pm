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

date_default_timezone_set('Asia/Bangkok');

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/jquery.bootgrid.css"/>
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>
    <script src="dist/jquery.bootgrid.min.js"></script>

    <script src="dist/for_report/js/jquery.dataTables.js"></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js"></script>

    <style>

    @media screen and (max-width: 769px) {
      /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
      #content_body { font-size: 80%; }
      h4 { font-size: 100%; }
    }

      body{ background: #ffffff!important;}
      #p_data_length, #p_data_info { float: left; margin: 10px; }
      #p_data_filter, #p_data_paginate { float: right; margin: 10px; }
      .table-responsive{ overflow-x: hidden; }

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

      .row { margin: 0px!important; }

    </style>

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>
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

<!-- Begin Top Panel -->
    <div id="page" class="mr-auto ml-auto" style="">

      <div id="top" class="">

      </div>
<!-- End Top Panel -->
<!-- Begin Body Panel -->
      <div id="body">

        <div class="">
          <div class="col-xs col-sm text-center alert alert-warning mb-0" role="">
            <h4 class="mb-0">ตั้งค่าระบบ</h4>
          </div>

          <div id="content_body" class="row">

<?php if($u_level == 'administrator' || $u_level == 'assignment'){ ?>

            <div class="col-xs-6 col-md-3">
              <a href="s_pm_sparepart.php" class="thumbnail">
                <div class="glyphicon glyphicon-cog text-warning" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>จัดการข้อมูลเครื่องจักร</h4>
                  <small class="text-multe">เพิ่ม/แก้ไข ข้อมูลเครื่องจักร</small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="s_pm_sparepart_type.php" class="thumbnail">
                <div class="glyphicon glyphicon-cog text-warning" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>จัดการประเภทเครื่องจักร</h4>
                  <small class="text-multe">เพิ่ม/แก้ไข ประเภทเครื่องจักร</small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="s_pm_sparepart_sub.php" class="thumbnail">
                <div class="glyphicon glyphicon-cog text-warning" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>จัดการข้อมูลอะไหล่</h4>
                  <small class="text-multe">เพิ่ม/แก้ไข ข้อมูลอะไหล่</small>
                </div>
              </a>
            </div>

      <?php if($u_level == 'administrator') { ?>
            <div class="col-xs-6 col-md-3">
              <a href="s_pm_user.php" class="thumbnail">
                <div class="glyphicon glyphicon-cog text-warning" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>จัดการผู้ใช้งานระบบ</h4>
                  <small class="text-multe">เพิ่ม/แก้ไข จัดการผู้ใช้งานระบบ</small>
                </div>
              </a>
            </div>
      <?php } ?>
            <!-- <div class="col-xs-6 col-md-3">
              <a href="setting/p_pm_department_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-cog text-warning" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน แจ้งซ่อมแยกตามกลุ่มช่าง</h4>
                  <small class="text-multe">เรียกดูรายงานการแจ้งซ่อมแยกตามกลุ่มช่างนั้น </small>
                </div>
              </a>
            </div>  -->

<?php
      } else {

        echo '<p class="text-center">ขออภัย User ไม่ได้รับสิทธิ์การใช้เมนูนี้ กรุณาติดต่อผู้ดูแลระบบ(Administrator)</p>';
      }
?>


        </div>
        <!-- End content_body -->
      </div>

    </div>
<!-- End Body panel -->
<!-- Begin Bottom Panel -->
      <div id="bottom" style="">

      </div>
<!-- End Bottom Panel -->

   	</div>
</div>



   </div>


    <script>
	    $(document).ready(function(){

        $('#content_body').fadeOut(100).fadeIn('slow');

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


      $(document).on('click','a',function(){
        var strText = $(this).text();
        var arr = strText.split(' - ');

        $("#i_job_code").val(strText);
        $("#h_job_code").val(arr[0]);
        $("#show-list").html('');
      });


// $(".dataTables_length").hide();

		});



    function ckJOB_CODE(){
      var s_job_code = document.getElementById("s_job_code");
      var i_job_code = document.getElementById("i_job_code");

      if(i_job_code.value == '')
      {
        alert('ยังไม่ได้ระบุรหัสอะไหล่ที่ต้องการค้นหา!');
        document.getElementById("i_job_code").focus();
        return false;
      }else{
        return true;
      }

    }


    function getCount(action_name){

      var username = '<?php echo $_SESSION["pm_emp_code"]; ?>';
      var level = '<?php echo $_SESSION["pm_level"]; ?>';

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


    var dataTable = $('#repair_data').DataTable({
     "processing" : true,
     "serverSide" : true,
     "order" : [],
     "bFilter": true,
     "pageLength": 10, //-1
     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
     "columnDefs": [
                  { "width": "2%", "targets": 0 },
                  { "width": "10%", "targets": 1 },
                  { "width": "10%", "targets": 2 },
                  { "width": "10%", "targets": 3 },
                  { "width": "8%", "targets": 4 },
                  { "width": "20%", "targets": 5 },
                  { "width": "30%", "targets": 6 },
                  { "width": "10%", "targets": 7 }
                ],
     "ajax" : {
      url:"report/fetch_report.php",
      type:"POST"
     }

    });
    //End dataTable



  </script>




  </body>
</html>
