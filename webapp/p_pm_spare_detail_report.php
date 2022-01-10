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

$code = $mysqli->real_escape_string($_GET['code']);

$query = "SELECT *
          FROM tbl_sparepart
          WHERE id = '$code'
        ";
$result = $mysqli->query($query);
$row = $result->fetch_object();

//print_r($row);

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
        .print_panel { border:0px!important; }

      }

      /* @page { size: landscape; } */

/* End for Print */

      body{ background: #ffffff!important;}
      #p_data_length, #p_data_info { float: left; margin: 10px; }
      #p_data_filter, #p_data_paginate { float: right; margin: 10px; text-align: right!important;}
      .table-responsive{ overflow-x: hidden; }
      .print_panel { margin: 0 auto; border: 1px solid #ccc; width: 1122.5px; height: 793.7px; }  /*793.7*/
      .print_bottom { margin: 0 auto; width: 1122.5px; }

      label {
          display: inline-block;
          max-width: 100%;
          margin-bottom: 0px!important;
          font-weight: 700;
      }

      td  {
            padding: 5px 1px 2px 5px;
            font-size: 11px;
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

      .title { font-weight: bold; }
      .title-body-2 { font-size: 10px; font-weight: bold; } /*color: #204a76;*/
      .text-body-2 { font-size: 10px; } /*color: #204a76;*/
      .blue { color: #204a76; }

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
                <img src="images/pds-logo-gray-bg.png" alt="pds-logo" width="130px;"/>
              </div>

                <div class="control_box_c text-center">
                  <h4>ทะเบียนเครื่องจักร</h4>
                  <div>(Register Machine)</div>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                    <h5></h5>
                    <h3 class="text-danger"></h3>
                </div>

            </div>
        <!-- begin ส่วนที่ 1 อุปกรณ์ -->
            <!-- <div class="text-center well well-sm mt-1 mb-1">ส่วนที่ 1 ผู้แจ้ง</div> -->
            <table class="mt-1" width="100%">
              <tr>
                <td width="150px" class="title">ชื่อเครื่องจักร/อุปกรณ์:</td><td colspan="5"><?=$row->spare_name_th?> (<?=$row->spare_name_en?>)</td>
              </tr>
              <tr>
                <td width="150px" class="title">รหัสเครื่องจักร:</td><td colspan="2"><?=$row->spare_code?></td>
                <td width="150px" class="title">สถานที่ติดตั้ง  :</td><td colspan="2"><?=$row->spare_location?></td>
              </tr>
              <tr>
                <td width="150px" class="title">ประเภท  :</td><td colspan="2"><?=$row->spare_category?></td>
                <td width="150px" class="title">เริ่มใช้งาน  :</td><td colspan="2"><?=$row->spare_start_work?></td>
              </tr>
            </table>
        <!-- end ส่วนที่ 1  -->

        <!-- begin ส่วนที่ 2 รายละเอียด -->
            <table class="table-bordered mt-1" width="100%">
              <tr>
                <td width="" class="title" colspan="4">รายละเอียด</td>
              </tr>
              <tr>
                <td width="150px" class="title">ยี่ห้อ  :</td><td><?=$row->spare_brand?></td>
                <td width="150px" class="title">รุ่น  :</td><td><?=$row->spare_model?></td>
              </tr>
              <tr>
                <td width="150px" class="title">ตำแทนจำหน่าย  :</td><td><?=$row->spare_dealer?></td>
                <td width="150px" class="title">ราคา  :</td><td><?=$row->spare_price?></td>
              </tr>
              <tr>
                <td width="150px" class="title">จำนวน  :</td><td><?=$row->spare_amount?></td>
                <td width="150px" class="title">สถานะ  :</td><td><?=$row->status?></td>
              </tr>
            </table>
        <!-- end ส่วนที่ 2 รายละเอียด -->

        <!-- begin ส่วนที่ 3 รายละเอียดจำเพาะ -->
            <table class="table-bordered mt-05" width="100%">
              <tr>
                <td width="" class="title" colspan="8">ข้อมูลจำเพาะ</td>
              </tr>
              <tr class="text-center">
                <td class="title" width="135px">ขนาด/ส่วนประกอบ</td><td class="title">รายละเอียด</td>
                <td class="title" width="105px">มอร์เตอร์ (Motor)</td><td class="title">รายละเอียด</td>
                <td class="title" width="130px">เกียร์ (Gear )</td><td class="title">รายละเอียด</td>
              </tr>
              <tr>
                <td class="title-body-2">โซ่ลำเลียง (Chain)</td><td class="text-body-2"><?=$row->compo_chain?></td>
                <td class="title-body-2">ยี่ห้อ (Barnd) </td><td class="text-body-2"><?=$row->motor_brand?></td>
                <td class="title-body-2">ยี่ห้อ (Barnd) </td><td class="text-body-2"><?=$row->gear_brand?></td>
              </tr>
              <tr>
                <td class="title-body-2">เฟืองโซ่ลำเลียง (Sporcket) </td><td class="text-body-2"><?=$row->compo_sporcket?></td>
                <td class="title-body-2">Ser. No </td><td class="text-body-2"><?=$row->motor_ser_no?></td>
                <td class="title-body-2">Ser. No </td><td class="text-body-2"><?=$row->gear_ser_no?></td>
              </tr>
              <tr>
                <td class="title-body-2">ขนาดเพลาขับ (Drive shaft) </td><td class="text-body-2"><?=$row->compo_drive_shaft?></td>
                <td class="title-body-2">Model / Type </td><td class="text-body-2"><?=$row->motor_model_type?></td>
                <td class="title-body-2">Model / Type </td><td class="text-body-2"><?=$row->gear_model_type?></td>
              </tr>
              <tr>
                <td class="title-body-2">ขนาดเพลาตาม (End Shaft) </td><td class="text-body-2"><?=$row->compo_end_shaft?></td>
                <td class="title-body-2">รอบ/นาที (rpm.) </td><td class="text-body-2"><?=$row->motor_rpm?></td>
                <td class="title-body-2">รอบขับ ( na ) rpm </td><td class="text-body-2"><?=$row->gear_na_rpm?></td>
              </tr>
              <tr>
                <td class="title-body-2">ลิ่ม (Key) </td><td class="text-body-2"><?=$row->compo_key?></td>
                <td class="title-body-2">แรงดันไฟฟ้า (Vot)  </td><td class="text-body-2"><?=$row->motor_vot?></td>
                <td class="title-body-2">รอบตาม (ne ) rpm  </td><td class="text-body-2"><?=$row->gear_ne_rpm?></td>
              </tr>
              <tr>
                <td class="title-body-2">เสื้อลูกปืนด้านขับ </td><td class="text-body-2"><?=$row->compo_driver_side_bearing?></td>
                <td class="title-body-2">กระแสไฟฟ้า(Amp.) </td><td class="text-body-2"><?=$row->motor_amp?></td>
                <td class="title-body-2">อัตราทด (i) </td><td class="text-body-2"><?=$row->gear_i?></td>
              </tr>
              <tr>
                <td class="title-body-2">เสื้อลูกปืนด้านตาม </td><td class="text-body-2"><?=$row->compo_side_bearing_shirt?></td>
                <td class="title-body-2">กำลังไฟฟ้า ( kW) </td><td class="text-body-2"><?=$row->motor_kw?></td>
                <td class="title-body-2">IM </td><td class="text-body-2"><?=$row->gear_im?></td>
              </tr>
              <tr>
                <td class="title-body-2">ลูกปืนด้านขับ </td><td class="text-body-2"><?=$row->compo_drive_side_bearing?></td>
                <td class="title-body-2">แรงม้า (HP) </td><td class="text-body-2"><?=$row->motor_hp?></td>
                <td class="title-body-2">ลูกปืน (Bearing) </td><td class="text-body-2"><?=$row->gear_bearing?></td>
              </tr>
              <tr>
                <td class="title-body-2">ลูกปืนด้านตาม </td><td class="text-body-2"><?=$row->compo_side_bearing?></td>
                <td class="title-body-2">ลูกปืน (Bearing) </td><td class="text-body-2"><?=$row->motor_bearing?></td>
                <td class="title-body-2">ความโต เพลาขับ/เพลาตาม </td><td class="text-body-2"><?=$row->gear_drive_shaft?></td>
              </tr>
              <tr>
                <td class="title-body-2">Liner </td><td class="text-body-2"><?=$row->compo_liner?></td>
                <td class="title-body-2">ความโต เพลาขับ </td><td class="text-body-2"><?=$row->motro_drive_shaft?></td>
                <td class="title-body-2">มูเล่ย์ (Pulley) </td><td class="text-body-2"><?=$row->gear_pulley?></td>
              </tr>
              <tr>
                <td class="title-body-2">กะพ้อ (Bucket) </td><td class="text-body-2"><?=$row->compo_liner?></td>
                <td class="title-body-2">มูเล่ย์ (Pulley) </td><td class="text-body-2"><?=$row->motor_pulley?></td>
                <td class="title-body-2">น้ำมันหล่อลื่น </td><td class="text-body-2"><?=$row->gear_lubrication?></td>
              </tr>
              <tr>
                <td class="title-body-2">ใบพา (Scraper bar) </td><td class="text-body-2"><?=$row->compo_scraper_bar?></td>
                <td class="title-body-2">คับปิง (Coupling) </td><td class="text-body-2"><?=$row->motor_coupling?></td>
                <td class="title-body-2"></td><td class="text-body-2"></td>
              </tr>
              <tr>
                <td class="title-body-2"></td><td class="text-body-2"></td>
                <td class="title-body-2">สายพาน (Belt) </td><td class="text-body-2"><?=$row->motor_belt?></td>
                <td class="title-body-2"></td><td class="text-body-2"></td>
              </tr>
            </table>
        <!-- end ส่วนที่ 3 รายละเอียดจำเพาะ -->

        <!-- begin ส่วนที่ 4 อุปกรณ์ไฟฟ้าควบคุม -->
            <table class="table-bordered mt-05" width="100%">
              <tr>
                <td width="150px" class="title">อุปกรณ์ไฟฟ้าควบคุม (Electricle Equipment)</td><td width="340px" class="title text-center">รายละเอียด</td>
                <td width="" class="text-body-2" rowspan="8" style="vertical-align: top;">หมายเหตุ  : <?=$row->note?> </td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Circuit beraker </td><td class="text-body-2"><?=$row->elec_circuit_beraker?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Magnetic contactor </td><td class="text-body-2"><?=$row->elec_magnetic_contactor?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Overload relay </td><td class="text-body-2" class="text-body-2"><?=$row->elec_overload_relay?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Relay </td><td class="text-body-2"><?=$row->elec_relay?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Miniature circuit beraker </td><td class="text-body-2"><?=$row->elec_miniature_circuit_beraker?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Timer relay </td><td class="text-body-2"><?=$row->elec_timer_relay?></td>
              </tr>
              <tr>
                <td width="150px" class="title-body-2">Current tranformer </td><td class="text-body-2"><?=$row->elec_current_tranformer?></td>
              </tr>
            </table>
        <!-- end ส่วนที่ 4 อุปกรณ์ไฟฟ้าควบคุม -->

          <!-- ส่วนของรหัส Form -->
          <div id="p_iso_start_use" class="print_bottom ">
              <div class="pull-left"><span>MT-FR-21</span></div>
              <div class="pull-right"><span>วันที่เริ่มใช้งาน 7 พ.ค. 2561</span></div>
          </div>

		    </div>
    <!-- end ส่วนข้อมูล -->

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


</script>
