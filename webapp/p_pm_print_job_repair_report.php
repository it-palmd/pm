<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}
// date_default_timezone_set('Asia/Bangkok');
date_default_timezone_set('Asia/Bangkok');

include_once('../include/connect_oop_db.php');

$page = $_SESSION['pm_ses_page'];
$u_level = $_SESSION["pm_level"];

$r_code = $mysqli->real_escape_string($_GET['repair_code']);

$query = "SELECT
            a.*, b.spare_name_th, a.tech_group, b.spare_location,
            CONCAT(b.spare_name_th,' (', b.spare_name_en,')') AS repair_spare_name,
            (SELECT tech_type_name FROM tbl_tech_type  WHERE tech_type_code = a.tech_group ) AS tech_group,
             (SELECT CONCAT(e.emp_firstname,' ',e.emp_lastname)  FROM tbl_employee e WHERE e.emp_code = a.repair_informer) as informer_name,
             (SELECT CONCAT(e.emp_firstname,' ',e.emp_lastname)  FROM tbl_employee e WHERE e.emp_code = a.assigner) as assigner_name,
             (SELECT CONCAT(e.emp_firstname,' ',e.emp_lastname)  FROM tbl_employee e WHERE e.emp_code = a.dispatcher) as dispatcher_name,
             (SELECT CONCAT(e.emp_firstname,' ',e.emp_lastname)  FROM tbl_employee e WHERE e.emp_code = a.inspector) as inspecter_name,
             (SELECT CONCAT(e.emp_firstname,' ',e.emp_lastname)  FROM tbl_employee e WHERE e.emp_code = a.tech_accept) as tech_accept_name

          FROM tbl_repair_register AS a
          INNER JOIN tbl_sparepart AS b ON a.repair_spare_code = b.spare_code
          WHERE a.repair_code = '$r_code'
        ";
$result = $mysqli->query($query);
$row = $result->fetch_object();

// print_r($row);

$repair_type_by_txt = "";
$repair_type_by = $row->repair_type_by;
//ช่างภายใน หรือ ช่างภายนอก
if($repair_type_by == 'IN'){ $repair_type_by_txt = 'ซ่อมได้'; }else{ $repair_type_by_txt = 'ซ่อมไม่ได้'; }

$repair_check_txt = "";
if($row->close_job_date != '0000-00-00 00:00:00'){
  $repair_check_txt = $row->note;
}else{
  $repair_check_txt = '';
  $row->close_job_date = '';
}


if($row->assign_date == '0000-00-00 00:00:00'){ $row->assign_date = ''; }
if($row->desired_date == '0000-00-00 00:00:00'){ $row->desired_date = ''; }
if($row->repair_finished_date == '0000-00-00 00:00:00'){ $row->repair_finished_date = ''; }
if($row->tech_accept_date == '0000-00-00 00:00:00'){ $row->tech_accept_date = ''; }
if($row->working_day == '0000-00-00 00:00:00'){ $row->working_day = ''; }
if($row->working_day_stop == '0000-00-00 00:00:00'){ $row->working_day_stop = ''; }


?>

<!doctype html>
<html lang="en">
  <head>
    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>

    <script src="dist/for_report/js/jquery.dataTables.js"></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js"></script>


    <style type="text/css" media="all">

/* For Print */
      @media print {

        body{ background: #ffffff!important; font-size: 8px!important;}
        /* .print_panel { margin:0px; border: 1px solid #ccc; width: 793px; } */

        #control_event, #p_data_length, #p_data_filter, #p_data_paginate, #p_data_info, #sidebar { display: none; }
        #p_iso_start_use { display: block; margin: 5px 0px 0px 0px; }
        #content { padding:0px!important; }
        .table-responsive { margin: 0 auto; padding: 10px!important; }
        .pagination{ margin-bottom: 0px!important; }
        .control_nav { display: none!important; }

        .form-inline-custom .form-control-custom {
            display: inline-block;
            width: auto;
        }
        .input-sm, .form-group-sm .form-control {
            font-size: 12px!important;
            border-bottom: 1px solid #ccc!important;
            border-radius: 1px!important;
            border-top: 0!important;
            border-right: 0!important;
            border-left: 0!important;
        }

        .input-textarea-sm {
            font-size: 12px!important;
        }

        .well { background-color: #ddd!important; }


      }

      /* @page { size: landscape; } */

/* End for Print */

      body{ background: #ffffff!important;}
      #p_data_length, #p_data_info { float: left; margin: 10px; }
      #p_data_filter, #p_data_paginate { float: right; margin: 10px; text-align: right!important;}
      .table-responsive{ overflow-x: hidden; }
      .print_panel { margin: 0 auto; border: 1px solid #ccc; width: 793px; }
      .print_bottom { margin: 0 auto; width: 793px; }

      label {
          display: inline-block;
          max-width: 100%;
          margin-bottom: 0px!important;
          font-weight: 700;
      }

      @media screen and (max-width: 768px) {
        .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; }
      }

      #control_container_nav ,#control_container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* background: #eeeeee; */
        /* height: 200px; */
      }

      .control_box_lr, .control_box_lr_nav {
        width: 250px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        /* background: #eeeeee; */
      }

      .control_box_c, .control_box_c_nav {
        width: 250px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        margin:auto;
      }

      .row { margin: -15px!important; }

      .form-inline-custom .form-control-custom {
          display: inline-block;
          width: auto;
      }

      .input-sm, .form-group-sm .form-control {
          height: 20px;
          padding: 0px 10px;
          font-size: 13px;
          line-height: 1.5;
          border-radius: 0px;
          border-bottom: 1px solid #ccc;
          border-top: 0;
          border-right: 0;
          border-left: 0;
          color: #8a642a;
      }

      .input-textarea-sm {
          height: 30px;
          padding: 5px 10px;
          font-size: 13px;
          border-radius: 3px;
          line-height: 1.5;
          color: #8a642a;
      }


      .clearfix {
        content: "";
        clear: both;
        display: table;
      }

      .w-100 { width: 100px!important; }
      .w-150 { width: 150px!important; }
      .w-200 { width: 200px!important; }
      .w-250 { width: 250px!important; }
      .w-300 { width: 300px!important; }
      .w-400 { width: 400px!important; }
      .w-450 { width: 450px!important; }
      .w-500 { width: 500px!important; }
      .w-600 { width: 600px!important; }

      .w-100p { width: 100%!important; }
      .w-50p { width: 50%!important; }

      .font-10 { font-size: 10.5px; }

    </style>

  </head>
  <body>

   <div class="wrapper" style="display:none;">
     <?php include('nav.php'); ?>

   	<div id="content" class="">

  <!-- Begin menu_bar -->

      <div id="control_container_nav" class="control_nav" style="padding:10px; margin-bottom:10px;">

        <div class="control_box_lr_nav" style="text-align:left;">
          <button type="button" id="sidebarCollapse" class="btn btn-light">
       			<i class="fa fa-align-justify"></i> <span></span>
       		</button>
        </div>

          <div class="control_box_c_nav text-center">
            <span class="badge badge-warning mx-auto"><strong>ระบบซ่อมบำรุง ปาล์มดีศรีนคร</strong></span>
          </div>

          <div class="control_box_lr_nav" style="text-align:right;">
            <a href="#" onclick="window.close(); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">ปิดหน้าต่าง</span></a>
          </div>

      </div>

  <!-- End menu_bar -->

      <!-- End control_event -->

          <div id="" class="container print_panel clearfix" style="display:none;">

            <div id="control_container">

              <div class="control_box_lr" style="text-align:left;">
                <img src="images/pds-logo-gray-bg.png" alt="pds-logo" width="170px;"/>
              </div>

                <div class="control_box_c text-center">
                  <h3>ใบแจ้งซ่อมบำรุง</h3>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                    <h5>ใบแจ้งซ่อมเลขที่</h5>
                    <h3 class="text-danger"><?=$row->repair_code;?></h3>
                </div>

            </div>
            <!-- ส่วนที่ 1 ผู้แจ้ง -->
            <div class="text-center well well-sm mt-1 mb-1">ส่วนที่ 1 ผู้แจ้ง</div>

            <div class="form-inline-custom pull-right">
             <label>วันที่/เวลา แจ้ง :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->repair_date;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix ">
             <label>แผนก :</label>
             <input type="text" class="form-control-custom input-sm w-250 text-center" value="<?=$row->spare_location;?>" readonly>
            </div>

            <div class="form-inline-custom clearfix pull-left pt-1">
             <label>รหัส :</label>
             <input type="text" class="form-control-custom input-sm w-100 text-center" value="<?=$row->repair_spare_code;?>" readonly>
            </div>
            <div class="form-inline-custom pull-left pl-2 pt-1">
             <label>ชื่อเครื่องจักร :</label>
             <input type="text" class="form-control-custom input-sm w-450" value="<?=$row->repair_spare_name;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left pt-1">
             <label>ประเภทงานซ่อม :</label>
             <input type="text" class="form-control-custom input-sm w-150 text-center" value="งานแจ้งซ่อมทั่วไป" readonly>
            </div>
            <div class="form-inline-custom pull-left pl-2 pt-1">
             <label>ความสำคัญในการซ่อม :</label>
             <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->repair_type;?>" readonly>
            </div>
            <div class="form-group-custom clearfix pull-left pl-0 pt-1">
              <label>รายละเอียดที่ต้องทำการซ่อมบำรุง / รายการชำรุด :</label>
              <textarea type="text" class="form-control input-textarea-sm" cols="250" rows="5" readonly><?=$row->repair_symptom;?></textarea>
            </div>
            <div class="form-inline-custom pull-right pt-1 mb-1">
             <label>ผู้แจ้ง :</label>
             <input type="text" class="form-control-custom input-sm w-200 text-center" value="<?=$row->informer_name;?>" readonly>
            </div>

            <!-- จบส่วนที่ 1 ผู้แจ้ง -->

            <!-- ส่วนที่ 2 ผู้รับแจ้ง -->
            <div class="text-center clearfix well well-sm mb-1 w-100p">ส่วนที่ 2 ผู้รับแจ้ง (PM ผู้มอบหมายงาน)</div>

            <div class="form-inline-custom pull-right pl-0">
             <label>วันที่/เวลา รับแจ้ง :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->assign_date;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left">
             <label>กำหนดวันที่ซ่อมเสร็จ :</label>
             <input type="text" class="form-control-custom input-sm w-100 text-center" value="<?=$row->desired_date;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left pt-1">
             <label>ความาสามารถในการซ่อมบำรุง :</label>
             <input type="text" class="form-control-custom input-sm w-100 text-center" value="<?=$repair_type_by_txt;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left pt-1">
             <label>ซ่อมโดย :</label>
             <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
            </div>

          <?php
          if($repair_type_by == 'IN'){
          ?>
              <div class="internal_tech">
                <div class="form-group pull-left pl-2 pt-1 mb-0">
                 <label class="">ช่างที่รับผิดชอบ :</label>
                 <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_leader.' (หัวหน้าชุด)';?>" readonly>
                </div>
                <div class="form-inline-custom clearfix pull-left invisible">
                 <label>ซ่อมโดย :</label>
                 <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
                </div>
                <div class="form-group pull-left pl-2 mb-0">
                 <label class="invisible">ช่างที่รับผิดชอบ :</label>
                 <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_2;?>" readonly>
                </div>
                <div class="form-inline-custom clearfix pull-left invisible">
                 <label>ซ่อมโดย :</label>
                 <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
                </div>
                <div class="form-group pull-left pl-2 mb-0">
                 <label class="invisible">ช่างที่รับผิดชอบ :</label>
                 <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_3;?>" readonly>
                </div>
                <div class="form-inline-custom clearfix pull-left invisible">
                 <label>ซ่อมโดย :</label>
                 <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
                </div>
                <div class="form-group pull-left pl-2 mb-0">
                 <label class="invisible">ช่างที่รับผิดชอบ :</label>
                 <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_4;?>" readonly>
                </div>
                <div class="form-inline-custom clearfix pull-left invisible">
                 <label>ซ่อมโดย :</label>
                 <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
                </div>
                <div class="form-group pull-left pl-2 mb-0">
                 <label class="invisible">ช่างที่รับผิดชอบ :</label>
                 <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_5;?>" readonly>
                </div>

              </div>

          <?php }else if($repair_type_by == 'EX'){  ?>

            <div class="form-group pull-left pl-2 pt-1 mb-0">
             <label class="">ผู้รับผิดชอบงาน :</label>
             <input type="text" class="form-control-custom input-sm w-300 text-left" value="<?=$row->tech_leader;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left invisible">
             <label>ซ่อมโดย :</label>
             <input type="text" class="form-control-custom input-sm w-150 text-center" value="<?=$row->tech_group;?>" readonly>
            </div>

          <?php } ?>

            <div class="form-inline-custom clearfix pull-right pt-1 mb-1">
             <label>ผู้รับแจ้ง :</label>
             <input type="text" class="form-control-custom input-sm w-200 text-center" value="<?=$row->assigner_name;?>" readonly>
            </div>

            <!-- จบส่วนที่ 2 ผู้รับแจ้ง -->

            <!-- ส่วนที่ 3 ช่างที่รับผิดชอบงาน -->
            <div class="text-center clearfix well well-sm mt-2 mb-1 w-100p">ส่วนที่ 3 ส่วนงานช่างซ่อมบำรุง (ช่างที่รับผิดชอบงาน)</div>

            <div class="form-inline-custom pull-right">
             <label>วันที่/เวลา รับงาน :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->tech_accept_date;?>" readonly>
            </div>

            <?php
            if($repair_type_by == 'EX'){
            ?>

              <div class="form-inline-custom clearfix pull-left ">
               <label>ชื่อบริษัท/ร้านซ่อม :</label>
               <input type="text" class="form-control-custom input-sm text-center w-400" value="<?=$row->external_company;?>" readonly>
              </div>
              <div class="form-inline-custom pull-left pt-1">
               <label>หัวหน้างาน/ช่างซ่อม :</label>
               <input type="text" class="form-control-custom input-sm text-center w-250" value="<?=$row->external_tech_leader;?>" readonly>
              </div>
              <div class="form-inline-custom pull-left pt-1">
               <label>เบอร์ติดต่อ :</label>
               <input type="text" class="form-control-custom input-sm text-center w-200" value="<?=$row->external_phone;?>" readonly>
              </div>

            <?php } ?>

            <div class="form-group-custom clearfix pull-left pt-1 w-50p">
              <label>รายละเอียดการซ่อมบำรุง :</label>
              <textarea type="text" class="form-control input-textarea-sm" cols="" rows="8" readonly><?=$row->repair_detail;?></textarea>
            </div>
            <div class="form-group-custom  pull-left pt-1 w-50p">
              <label>รายการอะไหล่ที่เปลี่ยน :</label>
              <textarea type="text" class="form-control input-textarea-sm font-10" id="spare_use" cols="" rows="10" readonly></textarea>
            </div>
            <div class="form-inline-custom clearfix pull-left pt-1">
             <label>เริ่มซ่อม :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->working_day;?>" readonly>
            </div>
            <div class="form-inline-custom  pull-left pl-2 pt-1">
             <label>ซ่อมเสร็จ :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->working_day_stop;?>" readonly>
            </div>

            <?php

              //------------------------------ การใช้งาน
              $h = ''; $m = '';
              $t1 = $row->working_day;
              $t2 = $row->working_day_stop;

              if($t2 != ''){

                $time=dateDiv($t1,$t2);
                // print_r($time);
                if($time['H'] != '0') { $h = $time['H'].' ชั่วโมง '; }
                if($time['M'] != '0') { $m = $time['M'].' นาที '; }

              }else{
                $h = ''; $m = '';
              }

            ?>
            <div class="form-inline-custom  pull-left pl-2 pt-1">
             <label>เวลาในการซ่อม :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$h.$m;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-right pt-1 mb-1">
             <label>ผู้รับงาน / ส่งงาน :</label>
             <input type="text" class="form-control-custom input-sm w-200 text-center" value="<?=$row->tech_accept_name;?>" readonly>
            </div>

            <!-- จบสวนที่ 3 -->

            <!-- ส่วนที่ 4 ตรวจรับงาน -->
            <div class="text-center clearfix well well-sm mb-1 w-100p">ส่วนที่ 4 ส่วนของการตรวจรับงาน (ปิดงานซ่อม)</div>

            <div class="form-inline-custom clearfix pull-left">
             <label>วันที่/เวลา ส่งงาน:</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->repair_finished_date;?>" readonly>
            </div>
            <div class="form-inline-custom pull-left pt-1">
             <label>ผลการซ่อมบำรุง / แก้ไข :<label>
             <input type="text" class="form-control-custom input-sm w-600" value="<?=$repair_check_txt;?>" readonly>
            </div>
            <div class="form-inline-custom clearfix pull-left pt-1 mb-1">
             <label>ผู้ตรวจสอบ / ปิดงานซ่อม :</label>
             <input type="text" class="form-control-custom input-sm w-200 text-center" value="<?=$row->inspecter_name;?>" readonly>
            </div>
            <div class="form-inline-custom  pull-right pt-1 mb-1">
             <label>เวลาปิดงานซ่อม :</label>
             <input type="text" class="form-control-custom input-sm text-center" value="<?=$row->close_job_date?>" readonly>
            </div>

            <!-- จบสวนที่ 4 -->

		    </div>
    <!-- end ส่วนข้อมูล -->
        <!-- ส่วนของรหัส Form -->
        <div id="p_iso_start_use" class="print_bottom ">
            <div class="pull-left"><span>MT-FR-01 Rev.06</span></div>
            <div class="pull-right"><span>วันที่เริ่มใช้งาน 1 พ.ย. 2563</span></div>
        </div>

        <div id="control_event" class="print_bottom pt-2 pb-4 text-center">
          <button type="button" id="btn_print" class="btn btn-info btn-bg" onclick="window.print()">
              <span class="glyphicon glyphicon-print"></span> Print or Export PDF
          </button>
        </div>


    </div>
    <!-- End content -->
</div>



</body>
</html>

<?php
//Function All Time Repair
    function dateDiv($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

      $t1Arr=splitTime($t1);
      $t2Arr=splitTime($t2);

      $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
      $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
     $TimeDiv=abs($Time2-$Time1);

      $Time["D"]=intval($TimeDiv/86400); // จำนวนวัน
      $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
      $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
      $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที
     return $Time;
    }

    function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
      $timeArr["Y"]= substr($time,2,2);
      $timeArr["M"]= substr($time,5,2);
      $timeArr["D"]= substr($time,8,2);
      $timeArr["h"]= substr($time,11,2);
      $timeArr["m"]= substr($time,14,2);
      $timeArr["s"]= substr($time,17,2);
      return $timeArr;
    }
 //End Function All Time Repair

$result->free();

?>





<script type="text/javascript">
$( document ).ready(function() {

  $('.wrapper').fadeIn('slow');

  getCount('count_my_job');
  getCount('count_today_job');
  getCount('count_month_job');
  getCount('count_no_action_job');

  getSpareUse('<?=$_GET['repair_code']?>');

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


  $('.print_panel').fadeIn('slow');  //แสดงผลแบบ ค่อยๆแสดง ด้วย function fadeIn()

  $("#btn_logout_model").click(function() {
      $('#logout_model').modal('show');	//แสดงหน้าต่าง modal add_model
  });






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

function getSpareUse(code){

  $.ajax({
    url: 'get_job_spare_use.php',
    method: 'post',
    data: { 'repair_code':code },
    success:function(response){
      $('#spare_use').html(response);
    }
  });
}

</script>
