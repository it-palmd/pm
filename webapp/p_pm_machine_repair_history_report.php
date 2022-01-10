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

        body{ background: #ffffff!important;}
        .print_panel { margin:0px; }

        #control_event, #p_data_length, #p_data_filter, #p_data_paginate, #p_data_info { display: none; }
        #p_iso_start_use { display: block; margin: 5px 0px 0px 0px; }
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


      @media screen and (max-width: 769px) {
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
            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </div>

      </div>

  <!-- End menu_bar -->

<div id="control_event" class="control_event">

      <div class="clearfix text-center panel panel-info">
          <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>รายงาน ประวัติซ่อมบำรุงเครื่องจักร</h4></div>
      </div>

  <!-- ส่วนข้อมูล set_department -->


            <div id="" class="text-center border panel panel-default">

  <!-- Begin panel-body -->
              <div class="panel-body">
                <button type="button" id="btn_print" class="btn btn-info" onclick="window.print()">
                    <span class="glyphicon glyphicon-print"></span> Print or Export PDF
                </button>
              </div>
  <!-- End panel-body -->

              <div class="panel-footer">

                <!-- <button type="submit" id="btn_gen_pdf" class="btn btn-danger">
                    <span class="glyphicon glyphicon-file"></span> Export To PDF
                </button> -->
              </div>

            </div>

</div>
<!-- End control_event -->

          <div id="" class="print_panel clearfix" style="clear:both;display:none; margin:0px;">

            <div id="control_container">

              <div class="control_box_lr" style="text-align:left;">
                <img src="images/PDS-Logo-03.jpg" alt="pds-logo" width="170px;"/>
              </div>

                <div class="control_box_c text-center">
                  <h4>ประวัติการซ่อมบำรุง</h4>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5>MT-FR-20</h5>
                </div>

            </div>

            <?php
              include_once('../include/connectdb.php');

              $sql = "SELECT
                        a.repair_spare_code, b.spare_name_th, b.spare_location,
                        CONCAT(b.spare_name_th,' ( ', b.spare_name_en,' )') AS repair_spare_name
                      FROM tbl_repair_register AS a
                      INNER JOIN tbl_sparepart AS b ON a.repair_spare_code = b.spare_code
                      WHERE a.repair_spare_code = '".$_GET['sp_code']."'
                      ";

              $result = mysqli_query($connect, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

             ?>

            <div class="control_box_c text-center" style="width:100%!important;">
              <h5 id="sparepart_name"><?php echo $_GET["sp_code"].' '.$row['repair_spare_name']; ?></h5>
              <p>จุดติดตั้ง: <span id=""><?php echo $row['spare_location']; ?></span></p>
            </div>

               <div class="table-responsive">
                <table id="p_data" class="table table-bordered table-striped" cellspacing="0" data-toggle="bootgrid" style="margin-bottom: 0px!important; width:100%!important;">
                 <thead>
                  <tr>
                   <th data-type="numeric" data-sortable="false">ลำดับ</th>
                   <th>วันที่/เวลา</th>
                   <th class="">เลขแจ้งซ่อม</th>
                   <th>รายการซ่อม</th>
                   <th>รายละเอียดการซ่อม</th>
                   <th>รายการอะไหล่ที่เปลี่ยน</th>
                   <th>ชั่วโมงงาน</th>
                   <th>ผู้ปฏิบัติ</th>
                  </tr>
                 </thead>
                </table>
               </div>

            <div id="p_iso_start_use" class="control_box_lr" style="text-align:left; width:350px!important;">
                <p>วันที่เริ่มใช้งาน: 1 พ.ย. 2563 แก้ไขครั้งที่: 01</p>
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


           fetch_data('yes', '<?php echo $_GET['sp_code']?>');

           function fetch_data(is_date_search, sp_code)
           {
             console.log(is_date_search, sp_code);

            var dataTable = $('#p_data').DataTable({
              "processing" : true,
              "serverSide" : true,
              "scrollX": false,
              "dom": '<lf<t>ip>',
              "paging":   true,
              "ordering": true,
              "stateSave": false, //เวลากด refresh หน้าเว็บจะค้างไว้ที่ page ที่เราเลือก
              "info":     true,
              "searching": false,
              "language": {
                   search: "ค้นหา:",
                   info: "แสดงข้อมูล _START_ ถึง _END_ จากข้อมูลที่ค้นพบ  _TOTAL_ รายการ ",
                   infoFiltered: "(จากข้อมูลทั้งหมด _MAX_ รายการ)",
                   processing: "กำลังดำเนินการ...",
                   lengthMenu: "แสดง _MENU_ รายการ/หน้า",
                   infoEmpty: "กรุณารอสักครู่...",
                   zeroRecords: "ไม่พบข้อมูล",
                   paginate: {
                        "first": "หน้าแรก",
                       "previous": "ก่อนหน้า", // เปลี่ยน ในส่วนของการ control page
                       "next": "ถัดไป",
                        "last": "หน้าสุดท้าย",
                    },
               },
              "pagingType": "full_numbers", //แสดงปุ่ม paginage แบบเต็ม
               "order" : [],
               "pageLength": -1, //-1 = All
               "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
               "columnDefs": [
                            { "width": "1%", "targets": 0, "class": "text-center" },
                            { "width": "8%", "targets": 1, "class": "text-center" },
                            { "width": "8%", "targets": 2, "class": "text-center" },
                            { "width": "%", "targets": 3 },
                            { "width": "%", "targets": 4 },
                            { "width": "15%", "targets": 5 },
                            { "width": "8%", "targets": 6, "class": "text-center" },
                            { "width": "10%", "targets": 7 }
                          ],
               "ajax" : {
                  url:"report/fetch_machine_repair_history_report.php",
                  type:"POST",
                  data:{ is_date_search:is_date_search, sp_code:sp_code }
               }

            });
            //End dataTable

           }
           //End fetch_data


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
