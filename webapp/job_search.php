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

//#### Begin Connect แบบ PDO

// $connect = new PDO("mysql:host=localhost;dbname=pr", "root", "");
// $connect->exec("set names utf8");

// $query = "SELECT DISTINCT tech_leader FROM tbl_repair_register ORDER BY tech_leader ASC";
// $stmt = $connect->prepare($query);
// $stmt->execute();
// $result = $stmt->fetchAll();

//#### End Connect แบบ PDO

include_once('../include/connectdb.php');

$techLeader = '';
$sql = '';

$sql = "SELECT DISTINCT tech_leader FROM tbl_repair_register ORDER BY tech_leader ASC";
$result = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

foreach($result as $row)
{
  if(!empty($row['tech_leader'])){
    $techLeader .= '<option value="'.$row['tech_leader'].'">'.$row['tech_leader'].'</option>';
  }
}

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
    <link rel="stylesheet" type="text/css" href="dist/for_report/css/daterangepicker.css" />


    <script src="dist/jquery2.2.0/jquery.min.js" type="text/javascript" ></script>
    <script src="dist/bootstrap.min.js" type="text/javascript" ></script>

    <script src="dist/for_report/js/jquery.dataTables.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/moment.min.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/daterangepicker.min.js" type="text/javascript" ></script>



    <style type="text/css" media="all">

/* For Print */
      @media print {

        body{ background: #ffffff!important;}
        .print_panel { margin:0px; }

        #control_event, #p_data_length, #p_data_filter, #p_data_paginate, #p_data_info { display: none; }
        #report_logo { display: block!important; margin: 5px 0px 0px 0px; }
        #content { padding:0px!important; }
        .table-responsive { margin: 0px -10px; padding: 10px!important; }
        .pagination{ margin-bottom: 0px!important; }
        .control_nav { display: none!important; }

      }

      @page { size: landscape; }

/* End for Print */

      body{ background: #ffffff!important;}
      #p_data_length, #p_data_info { float: left; margin: 10px; }
      #p_data_filter, #p_data_paginate { float: right; margin: 10px; text-align: right!important;}
      .table-responsive{ overflow-x: hidden; }
      #report_logo { display: none; }
      #fix_control_container_nav { display: none!important; }

      @media screen and (max-width: 769px) {
        /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
        #fix_control_container_nav { display: block!important; }
        #control_container_nav { display: none!important; }
        .table-responsive { font-size: 80%; }
        .control_box_c { width:800px!important; }
        #control_event { margin-top: 50px; }
        p { font-size: 80%; }
      }

      @media screen and (min-width: 769px) {
        #control_event { width:60%; margin: 10px auto; }
        .display { width:40%; margin:0 auto; }
        .form-control { margin-bottom: 10px; }
        small { font-size: 100%; }
      }

      #control_container_nav ,  #control_container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* background: #eeeeee; */
        /* height: 200px; */
      }

      #fix_ontrol_container_nav {
        display: flex;
      }

      .fix_control_box_c_nav {
        width: 200px;
        margin-left: auto;
        margin-right: auto;
        height: 10px;
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

      <div id="control_container_nav" class="control_nav" style="padding:10px; margin-bottom:10px;">

        <div class="control_box_lr_nav" style="text-align:left;">
          <button type="button" id="sidebarCollapse" class="btn btn-light sidebarCollapse">
       			<i class="fa fa-align-justify"></i> <span></span>
       		</button>
        </div>

          <div class="control_box_c_nav text-center">
            <span class="badge badge-warning mx-auto"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></span>
          </div>

          <div class="control_box_lr_nav" style="text-align:right;">
            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </div>

      </div>

  <!-- End menu_bar -->

  <!-- Begin fix menu_bar -->

      <div id="fix_control_container_nav" class="fixed-top" style="padding: 10px;">

        <div class="" style="float: left;">
          <button type="button" id="sidebarCollapse" class="btn btn-light sidebarCollapse">
            <i class="fa fa-align-justify"></i> <span></span>
          </button>
        </div>

          <div class="fix_control_box_c_nav text-center">
            <div style="padding:10px;"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>
          </div>

          <div class="" style="float: right;">
            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </div>

      </div>

  <!-- End fix menu_bar -->

<div id="control_event" class="control_event">

      <div class="clearfix text-center panel panel-info">
          <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>เรียกดูข้อมูลใบแจ้งซ่อม</h4></div>
      </div>

  <!-- ส่วนข้อมูล set_department -->


            <div id="" class="border panel panel-default">

  <!-- Begin panel-body -->
              <div class="panel-body">
                <p class="text-center">ผู้ใช้สามารถระบุเงื่อนไขเพื่อเรียกดูข้อมูลใบแจ้งซ่อมในระบบได้ หากข้อมูลไหนที่ไม่ได้ระบุจะแสดงข้อมูลทั้งหมดแทน</p>

                <form method="post" id="frm_add" action="" class="form-inline text-center">

                  <input type="hidden" name="range" id="range" />

                    <div class="form-group" style="padding:15px;">

                        <div class="form-group text-left">
                          <small for="breakdown" class="text-muted">ระบุวันที่หรือช่วงที่ต้องการ </small>
                          <div class="form-inline">
                            <input type="text" class="form-control col-12 text-center mr-1" id="date_range" name="date_range">
                          </div>
                        </div>
                        <div class="form-group text-left">
                          <small for="breakdown" class="text-muted">กลุ่มช่าง</small>
                          <div class="form-inline">
                           <select name="filter_tech_group" id="filter_tech_group" class="form-control filter_form" onchange="get_job_search($('#range').val(), this.value, $('#filter_tech_leader').val(), $('#search').val())" >
                            <option value="all">ไม่ระบุ</option>
                            <option value="ช่างกล">ช่างกล</option>
                            <option value="ช่างผลิต">ช่างผลิต</option>
                            <option value="ช่างไฟ">ช่างไฟ</option>
                            <option value="">ยังไม่ได้มอบหมายงาน</option>
                           </select>
                         </div>
                        </div>
                        <div class="form-group text-left">
                          <small for="breakdown" class="text-muted">ชื่อช่าง</small>
                          <div class="form-inline">
                             <select name="filter_tech_leader" id="filter_tech_leader" class="form-control filter_form" onchange="get_job_search($('#range').val(), $('#filter_tech_group').val(), this.value, $('#search').val())" >
                              <option value="all">ไม่ระบุ</option>
                              <?php echo $techLeader; ?>
                             </select>
                           </div>
                        </div>

                        <div class="form-group text-left">
                          <small for="breakdown" class="text-muted">ระบุคำที่ต้องการ</small>
                          <div class="form-inline">
                            <input type="text" class="form-control col-12 text-center mr-1 filter_form" id="search" name="search" onkeyup="get_job_search($('#range').val(), $('#filter_tech_group').val(), $('#filter_tech_leader').val(), this.value)" />
                          </div>
                        </div>

                    </div>

                  </form>

              </div>
  <!-- End panel-body -->

              <div class="panel-footer text-center">
                <button type="button" id="btn_print" class="btn btn-default" onclick="clear_form();">
                    <span class="glyphicon glyphicon-remove"></span> ล้างข้อมูล
                </button>
                <!-- <button type="button" id="btn_print" class="btn btn-info" onclick="window.print()">
                    <span class="glyphicon glyphicon-print"></span> Print or Export PDF
                </button> -->
              </div>

            </div>

</div>
<!-- End control_event -->

          <div id="" class="print_panel clearfix" style="clear:both; display:none; margin:0px;">

            <div id="control_container" style="display:none;">

              <div class="control_box_lr" style="text-align:left;">
                <img src="images/PDS-Logo-03.jpg" alt="pds-logo" width="170px;" id="report_logo"/>
              </div>

                <div class="control_box_c text-center">
                  <h4>ทะเบียนใบแจ้งซ่อม</h4>
                  <p>จากวันที่ <span id="s_date"></span> ถึงวันที่ <span id="e_date"></span></p>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5></h5>
                </div>

            </div>

            <div class="display" style="position:relative; margin-top:-0px;">
              <small id="filter_repair_count" style="display:none;"></small>
              <div class="list-group" id="show-list">

              </div>
            </div>

		    </div>
<!-- end ส่วนข้อมูล set_department -->

    </div>

</div>



</body>
</html>



<script type="text/javascript">
$( document ).ready(function() {

  $('.wrapper').fadeIn('slow');
  
  getCount('count_my_job');
  getCount('count_today_job');
  getCount('count_month_job');
  getCount('count_no_action_job');


$('.sidebarCollapse').on('click',function(){
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

  $('.print_panel').fadeIn('slow');  //แสดงผลแบบ ค่อยๆแสดง ด้วย function fadeIn()

  $("#btn_logout_model").click(function() {
      $('#logout_model').modal('show');	//แสดงหน้าต่าง modal add_model
  });



  var now = new Date();
  var today = moment(now).format('YYYY-MM-DD');
  var dateStringLabel = moment(now).format('DD/MM/YYYY');
  var range = today+' - '+today;

  $('#search').attr('disabled', true);
  $('#filter_tech_group').attr('disabled', true);
  $('#filter_tech_leader').attr('disabled', true);

  // $('#range').val(range);
  $('#s_date').text(dateStringLabel);
  $('#e_date').text(dateStringLabel);

  // get_job_search(range, '');

           $(function() {

             $('input[name="date_range"]').daterangepicker({
                 autoUpdateInput: false,
                 showDropdowns: true,
                 opens: 'center',
                 autoApply: true,
                 showCustomRangeLabel: true,
                 ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'ย้อนหลัง 7 วัน': [moment().subtract(6, 'days'), moment()],
                    'ย้อนหลัง 30 วัน': [moment().subtract(29, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                 locale: {
                   applyLabel: 'ยืนยัน',
                   cancelLabel: 'ยกเลิก',
                   customRangeLabel: 'กำหนดเอง'
                 }
             });

              $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {

                  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));

                  var start_date = picker.startDate.format('YYYY-MM-DD');
                  var end_date = picker.endDate.format('YYYY-MM-DD');
                  var rang_date = start_date+' - '+ end_date;
                  // alert(start_date+' - '+ end_date);
                  get_job_search(rang_date, $('#filter_tech_group').val(), $('#filter_tech_leader').val(), $('#search').val());

                  $('#search').attr('disabled', false);
                  $('#filter_tech_group').attr('disabled', false);
                  $('#filter_tech_leader').attr('disabled', false);
                  $('#filter_tech_group').focus();

                  $('#range').val(start_date+' - '+ end_date);
                  $('#s_date').text(picker.startDate.format('DD/MM/YYYY'));
                  $('#e_date').text(picker.endDate.format('DD/MM/YYYY'));

                });

              $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                  $(this).val('');
              });

            });




});

function get_job_search(range, filter_tech_group, filter_tech_leader,  search){

// alert(range, search);

  var d = range.split(' - ');
  var start_date = d[0];
  var end_date = d[1];

    $.ajax({
      url: 'get_job_search_list.php',
      method: 'post',
      data: { 'start_date':start_date, 'end_date':end_date, 'filter_tech_group':filter_tech_group , 'filter_tech_leader':filter_tech_leader , 'search':search }, //start_date, 'end_date':end_date,
      success:function(response){

        var data = response.split('|');
        var msg = '';
        if(typeof data[1]=='undefined'){  //ชนิดของข้อมูล null = undefined
          msg = 0;
        }else{
          msg = data[1];
        }

        $('#control_container').fadeIn('slow');
        $('#filter_repair_count').html('ค้นพบข้อมูล '+msg+' รายการ').fadeIn('slow');
        $('#show-list').html(data[0]).fadeIn('slow');
      }
    });

}

function clear_form(){
  $('#date_range').val('');
  $('#search').val('');
  $('#range').val('');
  $('#s_date').text('');
  $('#e_date').text('');
  $("select#filter_tech_group")[0].selectedIndex = 0;
  $("select#filter_tech_leader")[0].selectedIndex = 0;
  $('.filter_form').attr('disabled', true);

  $('#control_container').fadeOut();
  $('#filter_repair_count').fadeOut();
  $('#show-list').fadeOut();
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
