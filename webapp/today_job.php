<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

include_once('../include/connect_oop_db.php');

date_default_timezone_set('Asia/Bangkok');

$date = date('d-m-Y');
$page = $_SESSION['pm_ses_page'];
$u_level = $_SESSION["pm_level"];

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="dist/for_report/css/daterangepicker.css" />


    <script src="dist/jquery2.2.0/jquery.min.js" type="text/javascript" ></script>
    <script src="dist/bootstrap.min.js" type="text/javascript" ></script>

    <script src="dist/for_report/js/jquery.dataTables.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/moment.min.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/daterangepicker.min.js" type="text/javascript" ></script>

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

        @media screen and (max-width: 1300px) {
          .symptom_pic { display: none; }
        }

        @media screen and (max-width: 769px) {
          /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
          .table-responsive { font-size: 80%; }
          .control_box_c { width:800px!important; }
          .navbar {  width: 325px; margin:0 auto; padding: 10px 0px; }
          p { font-size: 80%; }
        }

        @media screen and (min-width: 769px) {
          #page { width:40%; margin:0 auto; }
          small { font-size: 100%; }
          #top-title { font-size: 18px; color: #195f42; }
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
        .search_control {
          text-align: left;
          max-width: 50%;
          float: left;
          width: 100%;
          padding: 0px 2px;
          margin-bottom: 10px;
        }

    </style>

  </head>
  <body onload="">

   <div class="wrapper" style="display:none;">
     <?php include('nav.php'); ?>

   	<div id="content" class="">

      <!-- Begin menu_bar -->

          <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">

         		<button type="button" id="sidebarCollapse" class="btn btn-light">
         			<i class="fa fa-align-justify"></i> <span></span>
         		</button>

            <div id="top-title" class="mx-auto px-3 py-1 mb-0"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>

            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </nav>

      <!-- End menu_bar -->

<!-- Begin Top Panel -->
    <div id="page" class="mr-auto ml-auto">

      <div id="top" class="">
        <div class="clearfix text-center panel panel-success">
            <div class="panel-heading">
              <h4 class="alert alert-success">งานซ่อมของวันนี้</h4>
              <h5 class="text-center text-success"><?php echo $date ?></h5>
            </div>
        </div>
      </div>

<!-- End Top Panel -->
<!-- Begin Body Panel -->
      <div id="body" class="text-center">

          <form method="post" action="">
            <input type="hidden" name="job_code" id="h_job_code">

              <div class="form-group text-left search_control">
                <small for="order_by" class="text-muted">เรียงตาม</small>
                  <select class="input-lg form-control text-center" id="order_by" name="order_by" onchange="get_today_job($('#where').val(), this.value)">
                    <option value="repair_code">เลขที่แจ้งซ่อม</option>
                    <option value="repair_date">วันที่แจ้งซ่อม</option>
                    <option value="status">สถานะ</option>
                  </select>
              </div>
              <div class="form-group search_control">
                <small for="where" class="text-muted">กลุ่มช่าง</small>
                  <select class="input-lg form-control text-center" id="where" name="where" onchange="get_today_job(this.value, $('#order_by').val())">
                    <option value="" selected="selected">ทั้งหมด</option>
                    <?php
                      $sql = "SELECT * FROM tbl_tech_type WHERE status = 'Active' ";
                      $result = $mysqli->query($sql);
                      while ($rs = $result->fetch_object()) {
                        echo "<option value='".$rs->tech_type_code."'>".$rs->tech_type_name."</option>";
                      }
                     ?>
                  </select>
              </div>

        </form>

      </div>
<!-- End Body panel -->
<!-- Begin Bottom Panel -->
      <div id="bottom" class="w-100 mr-auto ml-auto" style="clear:both;">
        <div class="" style="position:relative; margin-top:-0px;">
          <small id="filter_repair_count" style="display:none;"></small>
          <div class="list-group" id="show-list">

          </div>
        </div>
      </div>
<!-- End Bottom Panel -->

   	</div>
    <!-- End page -->
  </div>
  <!-- End content -->
</div>
<!-- End wraper -->

    <script>
	    $(document).ready(function(){

        $('.wrapper').fadeIn('slow');

        getCount('count_my_job');
        getCount('count_today_job');
        getCount('count_month_job');
        getCount('count_no_action_job');

        document.getElementById('where').selectedIndex = 0;
        get_today_job('', 'repair_code');

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




		});

    function get_today_job(where, order_by){

      var username = $('.user').text();
      var level = $('.level').text();

        $.ajax({
          url: 'get_today_job_list.php',
          method: 'post',
          data: {'username':username, 'level':level, 'where':where, 'order_by':order_by },
          success:function(response){

            var data = response.split('|');
            var msg = '';
            if(typeof data[1]=='undefined'){  //ชนิดของข้อมูล null = undefined
              msg = 0;
            }else{
              msg = data[1];
            }

            $('#filter_repair_count').html('ค้นพบข้อมูล '+msg+' รายการ').fadeIn('slow');
            $('#show-list').html(data[0]).fadeIn('slow');

          }
        });

    }


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




  </script>




  </body>
</html>
