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

if($u_level == 'administrator'){

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
    <link rel="stylesheet" href="dist/css/jquery.datetimepicker.css">

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>

    <script src="dist/for_report/js/jquery.dataTables.js"></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js"></script>
    <script src="dist/js/jquery.datetimepicker.js"></script>

    <style type="text/css" media="all">

/* For Print */
@media print {

  body{ background: #ffffff!important;}
  .print_panel { margin:0px; }

  #control_event, #p_data_length, #p_data_filter, #p_data_paginate, #p_data_info { display: none; }
  #p_iso_start_use { display: block; margin: 5px 0px 0px 0px; }
  #content { padding:0px!important; }
  .table-responsive { margin: 0px -10px; padding: 10px!important;}
  .pagination{ margin-bottom: 0px!important; }
  .control_nav { display: none!important; }
  .row { margin: -6px!important; }
  .table { width: 100%!important; }

}

@page { size: landscape; }

/* End for Print */

body{ background: #ffffff!important;}
#p_data_info, #p_data_length  { float: left; margin: 10px 0px; }
#p_data_filter, #p_data_paginate { float: right; margin: 10px 0px; text-align: right!important;}
.table-responsive{ overflow-x: hidden; }
.pagination { margin:0!important; }
.table { width:100%!important; }
/* table.dataTable thead tr { background-color: #337ab7; color: #ffffff; } */


@media screen and (max-width: 769px) {
  .control_box_lr, #p_iso_start_use { display: none!important; }
  .table-responsive { border: none; }
  /* #p_data_filter, #p_data_length { margin:0px; } */
}

@media screen and (max-width: 425px) {
  .control_box_lr, #p_iso_start_use { display: none!important; }
  #p_data_wrapper { font-size: 10px!important; }
  #p_data_paginate { text-align: center!important; padding: 0px; }
  .dataTables_info { padding-top: 10px; }
  .dataTables_paginate { padding: 10px; width: 100%; margin: 0px!important; }
  .col-sm-12 { overflow-x: scroll; width: 100%; }
  /* .table { width:500px!important; } */
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

      .row-normal { margin: 10px -15px; }
      .row { margin: -15px; }

      .lowercase {text-transform: lowercase; }
      .uppercase { text-transform: uppercase; }
      .capitalize { text-transform: capitalize; }

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
          <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>ประเภทเครื่องจักร</h4></div>
      </div>

  <!-- ส่วนข้อมูล set_department -->


            <div id="" class="text-center border panel panel-default">

  <!-- Begin panel-body -->
              <div class="panel-body">

                <p>สามารถระบุคำ เพื่อค้นหาผู้ใช้งานที่ต้องการได้ในช่องค้นหาด้านขวา</p>

                    <div>
                            <strong>แสดง/ซ่อน column:</strong>
                            <a href="#" class="toggle-vis" data-column="0"> ลำดับ</a> |
                            <a href="#"  class="toggle-vis" data-column="1">Username</a> |
                            <a href="#"  class="toggle-vis" data-column="2">Email</a> |
                            <a href="#"  class="toggle-vis" data-column="3">สิทธิ์การเข้าถึง</a> |
                            <a href="#"  class="toggle-vis" data-column="4">ระบบที่ใช้</a> |
                            <a href="#"  class="toggle-vis" data-column="5">ผู้ใช้งาน</a> |
                            <a href="#"  class="toggle-vis" data-column="6">สร้างโดย</a> |
                            <a href="#"  class="toggle-vis" data-column="7">วันที่สร้าง</a> |
                            <a href="#"  class="toggle-vis" data-column="8">Login ล่าสุด</a> |
                            <a href="#"  class="toggle-vis" data-column="9">สถานะ</a> |
                            <a href="#"  class="toggle-vis text-primary" data-column="10"><strong>จัดการ</strong></a>
                    </div>

              </div>
  <!-- End panel-body -->

              <div class="panel-footer">

                <button onclick="" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#addModal" data-whatever="">
                  <span class="glyphicon glyphicon-plus"></span> เพิ่มผู้ใช้งาน
                </button>

                <button type="button" id="btn_print" class="btn btn-info" onclick="window.print()">
                    <span class="glyphicon glyphicon-print"></span> Print or Export PDF
                </button>

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
                  <h4>รายการผู้ใช้งานระบบ</h4>
                  <p>(User List)</p>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5></h5>
                </div>

            </div>

               <div class="table-responsive">
                 <p></p>
                <table id="p_data" class="table table-bordered table-striped table-condensed table-hover" cellspacing="0" data-toggle="bootgrid" style="margin-bottom: 0px!important;">
                 <thead>
                  <tr>
                   <th class="bg-primary"data-type="numeric" data-sortable="true">ลำดับ</th>
                   <th class="bg-primary">Username</th>
                   <th class="bg-primary">Email</th>
                   <th class="bg-primary">สิทธิ์การเข้าถึง</th>
                   <th class="bg-primary">ระบบที่ใช้</th>
                   <th class="bg-primary">ผู้ใช้งาน</th>
                   <th class="bg-primary">สร้างโดย</th>
                   <th class="bg-primary">วันที่สร้าง</th>
                   <th class="bg-primary">Login ล่าสุด</th>
                   <th class="bg-primary">สถานะ</th>
                   <th class="bg-primary"></th>
                  </tr>
                 </thead>
                </table>
               </div>

            <div id="p_iso_start_use" class="control_box_lr" style="text-align:left; width:350px!important;">
                <p>วันที่เริ่มใช้งาน: 4 พฤษภาคม 2561 แก้ไขครั้งที่: 00</p>
            </div>


		    </div>
<!-- end ส่วนข้อมูล set_department -->

    </div>

</div>



</body>
</html>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content text-success">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-plus"></span> เพิ่มผู้ใช้งานระบบ</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='add_user' name='add_user'>

          <div class="form-group col-md-8">
            <label for="username" class="control-label">Username:</label>
            <input type="text" class="form-control lowercase" id="username" name="username" required>
          </div>
          <div class="form-group col-md-6">
            <label for="password" class="control-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="form-group col-md-6">
            <label for="re_password" class="control-label">Re Password:</label>
            <input type="password" class="form-control" id="re_password" name="re_password" required>
          </div>
          <div class="form-group col-md-12">
            <label for="email" class="control-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" >
          </div>
          <div class="form-group col-md-12">
            <label for="system" class="control-label">ใช้กับระบบ:</label><small for="system" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มในเมนูจัดการระดับการเข้าถึงก่อน</small>
            <select class="form-control" id="system>" name="system" onchange="selectLevel(this.value)" >
              <option value=""> ---- ระบุระบบที่ใช้ ---- </option>
              <option value="PM">ระบบแจ้งซ่อม (PM)</option>
              <option value="PR">ระบบติดตามการสั่งซื้อ (PR)</option>
              <option value="HR">ระบบจัดการทรัพยากรบุคคล (HR)</option>
              <option value="ALL">ทั้งหมด</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="level" class="control-label">ระดับการเข้าถึง:</label><small for="breakdown" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มก่อน</small>
            <select class="form-control vel_data" id="level" name="level">
              <option value=""> ---- ระบุระดับการเข้าถึง ---- </option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="emp_code" class="control-label">กำหนดผู้ใช้งาน:</label><small for="spare_category" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มในเมนูจัดการพนักงานก่อน</small>
            <select class="form-control" id="emp_code>" name="emp_code">
              <option value=""> ---- ระบุผู้ใช้งาน ---- </option>
              <?php
              // Connect DB
              $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
              mysqli_set_charset($connect, "utf8");

                $sql = "SELECT emp_code, CONCAT(emp_firstname,' ',emp_lastname) as emp_fullname FROM tbl_employee WHERE emp_status != 'Inactive' ORDER BY emp_firstname ASC";

                        $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

                        while ($r = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                          echo '<option value="'.$r['emp_code'].'">'.$r['emp_fullname'].'</option>';
                        }//end while
              ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="status" class="control-label">สถานะ:</label>
            <select class="form-control" id="status" name="status">
              <option value="Active" class="text-success">Active</option>
              <option value="Inactive" class="text-danger">Inactive</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-success" onclick="addUser()">บันทึก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Add Form -->

<!-- Add Edit Form -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content text-primary">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้งานระบบ</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='edit_user' name='edit_user'>

          <input type="hidden" id="user_id" name="user_id" >

          <div class="form-group col-md-8">
            <label for="username_edit" class="control-label">Username:</label>
            <input type="text" class="form-control lowercase" id="username_edit" name="username_edit" readonly>
          </div>
          <div class="form-group col-md-6">
            <label for="password_edit" class="control-label">Password:</label><small for="password_edit" class="text-danger">*ใส่ Password ใหม่</small>
            <input type="password" class="form-control" id="password_edit" name="password_edit" >
          </div>
          <div class="form-group col-md-6">
            <label for="re_password_edit" class="control-label">Re-Password:</label><small for="re_password_edit" class="text-danger">*ยืนยัน Password ใหม่อีกครั้ง</small>
            <input type="password" class="form-control" id="re_password_edit" name="re_password_edit" >
          </div>
          <div class="form-group col-md-12">
            <label for="email_edit" class="control-label">Email:</label>
            <input type="text" class="form-control" id="email_edit" name="email_edit" >
          </div>
          <div class="form-group col-md-12">
            <label for="system_edit" class="control-label">ใช้กับระบบ:</label><small for="system_edit" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มในเมนูจัดการระดับการเข้าถึงก่อน</small>
            <select class="form-control system_edit" id="system_edit>" name="system_edit" onchange="selectLevel(this.value)">
              <option value=""> ---- ระบุระบบที่ใช้ ---- </option>
              <option value="PM">ระบบแจ้งซ่อม (PM)</option>
              <option value="PR">ระบบติดตามการสั่งซื้อ (PR)</option>
              <option value="HR">ระบบจัดการทรัพยากรบุคคล (HR)</option>
              <option value="ALL">ทั้งหมด</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="level_edit" class="control-label">ระดับการเข้าถึง:</label><small for="level_edit" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มก่อน</small>
            <select class="form-control level_edit vel_data" id="level_edit>" name="level_edit">
              <option value=""> ---- ระบุระดับการเข้าถึง ---- </option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="emp_code_edit" class="control-label">กำหนดผู้ใช้งาน:</label><small for="emp_code_edit" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มในเมนูจัดการพนักงานก่อน</small>
            <select class="form-control emp_code_edit" id="emp_code_edit>" name="emp_code_edit">
              <option value=""> ---- ระบุผู้ใช้งาน ---- </option>
              <?php
              // Connect DB
              $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
              mysqli_set_charset($connect, "utf8");

                $sql = "SELECT emp_code, CONCAT(emp_firstname,' ',emp_lastname) as emp_fullname FROM tbl_employee WHERE emp_status != 'Inactive' ORDER BY emp_firstname ASC";

                        $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

                        while ($r = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                          echo '<option value="'.$r['emp_code'].'">'.$r['emp_fullname'].'</option>';
                        }//end while
              ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="status_edit" class="control-label">สถานะ:</label>
            <select class="form-control status_edit" id="status_edit" name="status_edit">
              <option value="Active" class="text-success">Active</option>
              <option value="Inactive" class="text-danger">Inactive</option>
            </select>
          </div>

          <div class="form-group col-md-12">
            <hr>
            <strong>ผู้สร้าง: </strong><br>
            <span id="create_by"></span>
          </div>
          <div class="form-group col-md-6">
            <strong>วันที่สร้าง: </strong><br>
            <span id="create_date_time"></span>
            <hr>
          </div><div class="form-group col-md-6">
            <strong>Login ล่าสุด: </strong><br>
            <span id="last_login"></span>
            <hr>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" onclick="editUser()">บันทึกการเปลี่ยนแปลง</button>
      </div>
    </div>
  </div>
</div>
<!-- End Edit Form -->

<?php
}else{
  header('location:../webapp/');
}
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


//Begin ออกจากระบบ

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
//End ออกจากระบบ

$(document).on('click','a',function(){
  var strText = $(this).text();
  var arr = strText.split(' - ');

  $("#i_job_code").val(strText);
  $("#h_job_code").val(arr[0]);
  $("#show-list").html('');
});

//Delete User on click
$(document).on('click','.delete',function(){

  console.log($(this).data("row-id"));

  var conf = confirm('ต้องการลบผู้ใช้ รายการที่ ' + $(this).data("row-id") + ' ใช่หรือไม่?');

  if(conf){
    //ส่งค่า jquery ajax แบบย่อ
    $.post('setting/user/delete.php', { id: $(this).data("row-id") },
    function(data){
      // when ajax returns (callback),

      alert("ลบผู้ใช้เรียบร้อย");
      $('#p_data').DataTable().draw();

    });
  }

});


// $(".dataTables_length").hide();

  $('.print_panel').fadeIn('slow');  //แสดงผลแบบ ค่อยๆแสดง ด้วย function fadeIn()

  $("#btn_logout_model").click(function() {
      $('#logout_model').modal('show');	//แสดงหน้าต่าง modal add_model
  });

  fetch_data();

  function fetch_data()
  {

    var dataTable = $('#p_data').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "setting/user/fetch_s_pm_user.php",
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        { "width": "2%", "targets": 0, "visible": true, "className": "text-center" },
                        { "width": "10%", "targets": 1, "visible": true, "className": "text-center", },
                        { "width": "18%", "targets": 2, "visible": true, "className": "text-left", },
                        { "width": "10%", "targets": 3, "visible": true, "className": "text-center", },
                        { "width": "5%", "targets": 4, "visible": true, "className": "text-center", },
                        { "width": "%", "targets": 5, "visible": true, "className": "text-center", },
                        { "width": "%", "targets": 6, "visible": true, "className": "text-center", },
                        { "width": "%", "targets": 9, "visible": true, "className": "text-center", },
                        { "width": "%", "targets": 10, "visible": false, }
                      ],
                      "pageLength": 10, //-1 = All
                      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
                      // "pagingType": 'full_numbers',
                      "language": {
                          "search": "ค้นหา ",
                          "lengthMenu": "แสดง _MENU_ รายการ/หน้า",
                          "zeroRecords": "ขออภัย! ไม่พบข้อมูล",
                          "info": "กำลังแสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
                          "infoEmpty": "ไม่มีข้อมูลในระบบ",
                          "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
                          "paginate": {
                            "first": "หน้าแรก",
                            "previous": "ก่อนหน้า",
                            "next": "ถัดไป",
                            "last": "หน้าสุดท้าย",
                          },
                          "aria": {
                              "paginate": {
                                  "first":    'First',
                                  "previous": 'Previous',
                                  "next":     'Next',
                                  "last":     'Last'
                              }
                          }
                      },
                  });

                  $('a.toggle-vis').on( 'click', function (e) {
                         e.preventDefault();

                         // Get the column API object
                         var column = dataTable.column( $(this).attr('data-column') );

                         // Toggle the visibility
                         column.visible( ! column.visible() );
                     } );

  }
  //End fetch_data function

  $('#addModal').on('hidden.bs.modal', function (e) {
      console.log('reset form');
      $("#add_user")[0].reset();
  });

  $('#addModal').on('shown.bs.modal', function () {
      console.log('input focus');
      $("#username").focus();
  });

  $('#editModal').on('hidden.bs.modal', function (e) {
      console.log('reset select edit form');
      // $('option:selected', 'select[name="level_edit"]').removeAttr('selected');  //remove selected one
      // $('option:selected', 'select[name="system_edit"]').removeAttr('selected');  //remove selected one
      // $('option:selected', 'select[name="emp_code_edit"]').removeAttr('selected');  //remove selected one

  });


  $('#editModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        // modal.find('.modal-body input').val(recipient)

        $('#user_id').val(id);

        $.ajax({
          url:"setting/user/select-data.php",
          method: "POST",
          data: { 'id':id },
          success:function(data){

            // console.log(data);

            var json = $.parseJSON(data);
            $("#username_edit").val(json[0].username);
            $("#email_edit").val(json[0].email);
            // $('select[name="level_edit"]').find('option[value="'+json[0].level+'"]').attr("selected",true);
            // $('select[name="system_edit"]').find('option[value="'+json[0].system+'"]').attr("selected",true);
            // $('select[name="emp_code_edit"]').find('option[value="'+json[0].emp_code+'"]').attr("selected",true);

            // $('.level_edit option').removeAttr('selected').filter('[value="'+json[0].level+'"]').attr('selected', true);
            // $('.system_edit option').removeAttr('selected').filter('[value="'+json[0].system+'"]').attr('selected', true);
            // $('.emp_code_edit option').removeAttr('selected').filter('[value="'+json[0].emp_code+'"]').attr('selected', true);
            // $("#status_edit").val(json[0].status);

            $.each($('.system_edit option'),function(a,b){
              // console.log($(this).val()+' '+json[0].level);
              if($(this).val() == json[0].system){
                  $(this).attr('selected',true);
                  selectLevel($(this).val());
              }else{
                  $(this).attr('selected',false);
              }
            });

            $.each($('.level_edit option'),function(a,b){
              // console.log($(this).val()+' '+json[0].level);
              if($(this).val() == json[0].level){
                  $(this).attr('selected',true);
              }else{
                  $(this).attr('selected',false);
              }
            });

            $.each($('.emp_code_edit option'),function(a,b){
              // console.log($(this).val()+' '+json[0].emp_code);
              if($(this).val() == json[0].emp_code){
                  $(this).attr('selected',true);
              }else{
                  $(this).attr('selected',false);
              }
            });

            $.each($('.status_edit option'),function(a,b){
              // console.log($(this).val()+' '+json[0].status);
              if($(this).val() == json[0].status){
                  $(this).attr('selected',true);
              }else{
                  $(this).attr('selected',false);
              }
            });

            $("#create_by").html(json[0].create_by);
            $("#create_date_time").html(json[0].create_date_time);
            $("#last_login").html(json[0].last_login);

            $("#email_edit").select();

          }
          // End Success
        });

  });
  // End myModal(Edit)



});

function selectLevel(system){

  console.log(system);
  var level_list = $('.vel_data').empty(); // ดึง Select Option มาทำค่างว่า

  if(system == ''){
    var opt = "<option value='' > ---- ระบุระดับการเข้าถึง ---- </option>"; // Create Element
    level_list.html(opt);
  }else{

    $.ajax({
      url: 'setting/user/select-level-data.php',
      method: 'post',
      datatype : 'json',
      data: { 'system': system },
      success:function(response){
        // console.log(response);

        var json = $.parseJSON(response);

  					$.each(json,function(key,val){ // วน Loop array json
  						opt += "<option value='"+val['level_name']+"'>"+val['level_name_th']+"</option>"; // เพิ่ม Option เข้าไปในตัวแปร
  					});
            // console.log(opt);
  					level_list.html(opt);
      }
    });

  }//End if empty(system)

}

function addUser(){

  var username = $('#username');
  var password = $('#password');
  var re_password = $('#re_password');

    if(username.val() == ''){
      alert('กรุณากรอก Username ก่อน!');
      username.focus();
      return false;
    }

  //Validation Password
    if(password.val() != ''){

      if(password.val().length < 3){
        alert('Password จะต้องมีอย่างน้อย 4 ตัว!');
        password.select();
        return false;
      }

      if(re_password.val() == ''){
        alert('คุณยังไม่ได้ใส่ Re-Password!');
        re_password.focus();
        return false;
      }

      if(re_password.val() != password.val()){
        alert('Password และ Re-Password จะต้องตรงกัน!');
        re_password.select();
        return false;
      }

    }else{
        alert('กรุณากรอก Password ก่อน!');
        password.focus();
        return false;
    }

  var formData = new FormData($('#add_user')[0]);

  console.log(formData);

      $.ajax({
        url:"setting/user/insert.php",
        method: "POST",
        data: formData , //$("#add_user").serialize()
        contentType: false,
        cache: false,
        processData: false
      }).done(function(data){
        // success:function(data){
          console.log(data);

          if(data == 'insert_ok'){
            alert("บันทึกเรียบร้อยแล้ว");
            $('#p_data').DataTable().draw();
            $('#addModal').modal('toggle');
          }else if(data == 'invalid_username'){
            alert(" Username นี้มีในระบบแล้ว กรุณาเปลี่ยนใหม่!");
            username.select();
            return false;
          }

      });

}

function editUser(){

  var formData = new FormData($('#edit_user')[0]);
  var password = $('#password_edit');
  var re_password = $('#re_password_edit');

  // console.log(password.val()+' '+re_password.val());

//Validation Password
  if(password.val() != ''){

    if(password.val().length < 3){
      alert('Password จะต้องมีอย่างน้อย 4 ตัว!');
      password.select();
      return false;
    }

    if(re_password.val() == ''){
      alert('คุณยังไม่ได้ใส่ Re-Password!');
      re_password.focus();
      return false;
    }

    if(re_password.val() != password.val()){
      alert('Password และ Re-Password จะต้องตรงกัน!');
      re_password.select();
      return false;
    }

  }

      $.ajax({
        url:"setting/user/update.php",
        method: "POST",
        data: formData , //$("#add_user").serialize()
        contentType: false,
        cache: false,
        processData: false
      }).done(function(data){

          console.log(data);

          if(data == 'update_ok'){
            alert("บันทึกการเปลี่ยนแปลงเรียบร้อย");

            $('.vel_data').empty(); // ดึง Select Option มาทำค่างว่า
            var opt = "<option value='' > ---- ระบุระดับการเข้าถึง ---- </option>"; // Create Element
            $('.vel_data').html(opt);
            password.val('');
            re_password.val('');
            $('#p_data').DataTable().draw();
            $('#editModal').modal('toggle');
          }else{
            alert("การส่งค่าไม่สำเร็จ");
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
