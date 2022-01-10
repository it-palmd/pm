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

$sp_code = "";

if(isset($_GET['sp_code'])){
  $sp_code = $_GET['sp_code'];
}


      include_once('../include/connect_oop_db.php');

      $sql = " SELECT * FROM tbl_sparepart WHERE spare_code = '$sp_code' ";
      $result = $mysqli->query($sql);
      $rs = $result->fetch_object();

      $status_pic = '';
      $status_name = '';
      $status_job = '';

      $status = $rs->status;

      if($status !== 'Inactive'){
        $status_pic = 'checked';
        $status_name = 'พร้อมใช้งาน';
        $btn_open_job_event = 'visible';
      }
      else{
        $status_pic = 'cancel';
        $status_name = 'ยกเลิกใช้งาน';
        $btn_open_job_event = 'invisible';
      }

      $sql1 = " SELECT count(repair_code) as job_count FROM tbl_repair_register WHERE repair_spare_code = '$sp_code' AND status != 'Active' ";
      $result1 = $mysqli->query($sql1);
      $rs1 = $result1->fetch_object();

      if($rs1->job_count > 0){
        $status_job = 'มีงานซ่อมที่ยังไม่ปิด '.$rs1->job_count.' งาน';
      }
      else{
        $status_job = '';
      }

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../images/icons/construction-and-tools.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="dist/for_report/css/daterangepicker.css" />

    <script src="dist/jquery2.2.0/jquery.min.js" type="text/javascript" ></script>
    <script src="dist/bootstrap.min.js" type="text/javascript" ></script>

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

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
          width: 100px;
          /* height: 50px;
          line-height: 50px; */
          /* background: #eeeeee; */
        }

        .control_box_c, .control_box_c_nav {
          width: 500px;
          /* height: 50px;
          line-height: 50px; */
          text-align: center;
          margin:auto;
        }

        .row { margin: -10px!important; }
        .form-group { margin: 0px!important; }
        h6 { color: #007ab7; }

        .mr-auto, .mx-auto {
            margin-right: auto !important;
        }
        .pl-3, .px-3 {
            padding-left: 1rem !important;
        }
        h6, .h6 {
            font-size: 14px;
        }


    </style>

  </head>
  <body>

   <div class="wrapper" style="display:none;">
     <?php include('nav.php'); ?>

   	<div id="content" class="" >

      <!-- Begin menu_bar -->

      <div id="control_container_nav" class="control_nav pb-1">

        <div class="control_box_lr_nav" style="text-align:left;">
          <button type="button" id="sidebarCollapse" class="btn btn-light sidebarCollapse">
       			<i class="fa fa-align-justify"></i> <span></span>
       		</button>
        </div>

          <div class="control_box_c_nav text-center">
            <span id="top-title" class="mx-auto"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></span>
          </div>

          <div class="control_box_lr_nav" style="text-align:right;">
            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </div>

      </div>

      <!-- End menu_bar -->

    <div id="page" class="mr-auto ml-auto" style="">

      <div id="top" class="">
        <div class="clearfix text-center">
            <div class="pb-2 pl-0 pr-0">
              <h4 class="alert alert-warning mb-1"><?php echo $sp_code ?></h4>
              <h6 style="margin-bottom:0px!important;"><?php echo $rs->spare_name_th; ?></h6>
              <p style="margin-bottom:0px!important;"><?php echo $rs->spare_name_en != '' ? '('.$rs->spare_name_en.')' : ''; ?></p>
            </div>
        </div>
      </div>

      <div id="body" class="text-center">

         <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item active">
            <a class="nav-link " id="home-tab" data-toggle="tab" href="#status" role="tab" aria-controls="home" aria-selected="true">สถานะ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#spare_desc" role="tab" aria-controls="profile" aria-selected="false">ข้อมูล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#spare_history" role="tab" aria-controls="contact" aria-selected="false">ประวัติซ่อม</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#plan_management" role="tab" aria-controls="contact" aria-selected="false">งาน PM</a>
          </li>
        </ul>


        <div class="tab-content" id="myTabContent">
<!-- Tab สถานะปัจจุบัน -->
          <div class="tab-pane active" id="status" role="tabpanel" aria-labelledby="home-tab">
            <div style="margin-top:20px;">
              <h4 class="">สถานะปัจจุบัน</h4>
            </div>

              <img src="../images/icons/<?php echo $status_pic; ?>.png" width="40%" alt="icons" style="margin:10% auto;">

            <h5 style=""><?php echo $status_name; ?></h5>
            <p style="margin-bottom: 10%;"><?php echo $status_job; ?></p>

            <?php
              if($u_level=='informer'){
             ?>
             <div id="body-bottom" style="position:fix;">
               <form action="open_job.php" method="post">
                 <input type="hidden" value="<?php echo $sp_code ?>" name="sp_code" />
                 <input type="hidden" value="<?php echo $rs->spare_name_th; ?>" name="sp_name" />
                 <button id="btn_open_job" type="submit" class="col-xs-12 col-md-12 btn btn-warning btn-lg <?php echo $btn_open_job_event ?>">แจ้งซ่อม</button>
              </form>
            </div>
            <?php
              }
            ?>
          </div>
<!-- Tab ข้อมูลอุปกรณ์ -->
          <div class="tab-pane fade" id="spare_desc" role="tabpanel" aria-labelledby="profile-tab">
            <div style="margin-top:20px;">
              <h4>ข้อมูลอุปกรณ์</h4>
              <p><img src="images/sparepart/<?php echo $rs->spare_pic; ?>" width="100%" alt="icons"></p>
              <div class="text-left">

              <form class="form-horizontal" >

                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">รหัส:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_code; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">ชื่อ[ไทย]:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_name_th; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">ชื่อ[En]:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_name_en; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">หมวด:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_category; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">รายละเอียด:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_description; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">จุดติดตั้ง:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_location; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">ยี่ห้อ:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_brand; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">รุ่น:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_model; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">ผู้จำหน่าย:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_dealer; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">ราคา:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_price; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">จำนวน:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_amount; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">วันที่ติดตั้ง:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_install_date; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">เริ่มใช้งาน:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_start_work; ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">ยกเลิกใช้งาน:</label>
                  <div class="col-sm-10">
                    <h6><?php echo $rs->spare_stop_work; ?></h6>
                  </div>
                </div>

              </form>

            </div>
              <br/>
              <br/>
            </div>
          </div>
          <?php
            $sql = "SELECT DATE_FORMAT(repair_date, '%Y-%m-%d') AS rp_date, repair_code, repair_symptom
                    FROM `tbl_repair_register`
                    WHERE `repair_spare_code` = '$sp_code'
                    ORDER BY repair_spare_code ASC";
            $result = $mysqli->query($sql);

            $i = 1; $data = "";

            if($result->num_rows > 0){
                while ($rs = $result->fetch_object()) {
                  $data .=  '<tr style="text-align:left;">
                              <td>'.$i.'</td>
                              <td>'.$rs->rp_date.'</td>
                              <td>'.$rs->repair_code.'</td>
                              <td>'.$rs->repair_symptom.'</td>
                              <td style="text-align:right;"><a href="job_info.php?job_code='.$rs->repair_code.'" ><button type="button" class="btn-info pt-0 pb-0"><i class="fa fa-info-circle" aria-hidden="true"></i></button></a></td>
                            </tr>
                          ';
                          $i++;
                }
              }else{
                $data = '<tr>
                          <td colspan="5">ไม่พบข้อมูล</td>
                        </tr>
                        ';
              }
          ?>
<!-- Tab ประวัติการซ่อม -->
          <div class="tab-pane fade" id="spare_history" role="tabpanel" aria-labelledby="contact-tab">
            <div class="text-right" style="margin-top:10px;">
              <a class="btn btn-info" id="btn_print" href="p_pm_machine_repair_history_report.php?sp_code=<?php echo $sp_code; ?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
            </div>
            <h4 style="margin-top:20px;">ประวัติการซ่อม</h4>
            <p>
              <table class="table">
                <tr>
                  <th>ครั้งที่</th>
                  <th>วันที่</th>
                  <th>รหัสงานซ่อม</th>
                  <th>อาการ</th>
                  <th></th>
                </tr>

                <?php echo $data; ?>

              </table>
            </p>
          </div>
<!-- Tab งาน PM -->
          <div class="tab-pane fade" id="plan_management" role="tabpanel" aria-labelledby="contact-tab">
            <h4 style="margin-top: 20px;">งาน PM</h4>
            <p>...</p>
          </div>

        </div>

         <?php
           $result->free();
           $mysqli->close();
         ?>
      </div>
   	</div>
</div>



   </div>


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

      $(".nav-tabs a").click(function(){
          $(this).tab('show');
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

		});

    function getCount(action_name){

      var username = '<?php echo $_SESSION["pm_emp_code"]; ?>';
      var level = '<?php echo $_SESSION["pm_level"]; ?>';

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
