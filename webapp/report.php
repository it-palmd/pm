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

      .glyphicon {
          position: relative;
          top: 1px;
          display: inline-block;
          font-family: 'Glyphicons Halflings';
          font-style: normal;
          font-weight: 400;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          font-size: 100px;
          padding: 20px 0 0;
      }

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

          <div class="col-xs col-sm text-center alert alert-info mb-1" role="">
            <h4 class="mb-0">รายงาน</h4>
          </div>

          <div id="content_body" class="row">

            <div class="col-xs-6 col-md-3">
              <a href="p_pm_kpi_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงานสรุปใบแจ้งซ่อมรายปี</h4>
                  <small class="text-multe">รายงาน KPI รวมทั้งหมด รายปี</small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="p_pm_kpi_month_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงานสรุปใบแจ้งซ่อมรายเดือน(KPI)</h4>
                  <small class="text-multe">รายงาน KPI รายเดือนแยกตามแผนก</small>
                </div>
              </a>
            </div>

            <div class="col-xs-6 col-md-3">
              <a href="p_pm_monthly_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน แจ้งซ่อมรายเดือน</h4>
                  <small class="text-multe">เรียกดูรายงานการแจ้งซ่อมของแต่ละเดือน</small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="p_pm_between_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน แจ้งซ่อมตามช่วง</h4>
                  <small class="text-multe">เรียกดูรายงานการแจ้งซ่อมตามช่วงวัน เดือน ปี </small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="p_pm_not_finished_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน แจ้งซ่อมค้าง</h4>
                  <small class="text-multe">เรียกดูรายงานการแจ้งซ่อมที่ยังซ่อมไม่เสร็จ </small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="p_pm_department_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน แจ้งซ่อมแยกตามกลุ่มช่าง</h4>
                  <small class="text-multe">เรียกดูรายงานการแจ้งซ่อมแยกตามกลุ่มช่างนั้น </small>
                </div>
              </a>
            </div>
            <div class="col-xs-6 col-md-3">
              <a href="p_pm_repair_notification_frequency_report.php" class="thumbnail">
                <div class="glyphicon glyphicon-file text-info" style="font-size:100px; padding:20px 0 0;"></div>
                <div class="caption">
                  <h4>รายงาน ความถี่การแจ้งซ่อมของเครื่องจักร</h4>
                  <small class="text-multe">เรียกดูรายงานความถี่การแจ้งซ่อมของเครื่องจักร </small>
                </div>
              </a>
            </div>

        </div>

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
