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

if($u_level == 'administrator' || $u_level == 'assignment'){

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

                <p>สามารถระบุคำ เพื่อค้นหาเครื่องจักรที่ต้องการได้ในช่องค้นหาด้านขวา</p>

                    <div>
                            <strong>แสดง/ซ่อน column:</strong>
                            <a href="#" class="toggle-vis" data-column="0"> ลำดับ</a> |
                            <a href="#"  class="toggle-vis" data-column="1">รหัส</a> |
                            <a href="#"  class="toggle-vis" data-column="2">ชื่อประเภท</a> |
                            <a href="#"  class="toggle-vis" data-column="3">สถานะ</a> |
                            <a href="#"  class="toggle-vis text-primary" data-column="4"><strong>จัดการ</strong></a>
                    </div>

              </div>
  <!-- End panel-body -->

              <div class="panel-footer">

                <button onclick="" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#addModal" data-whatever="">
                  <span class="glyphicon glyphicon-plus"></span> เพิ่มประเภท
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
                  <h4>ประเภทเครื่องจักร</h4>
                  <p>(Machine Type List)</p>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5>MT-FR-18</h5>
                </div>

            </div>

               <div class="table-responsive">
                 <p></p>
                <table id="p_data" class="table table-bordered table-striped table-condensed table-hover" cellspacing="0" data-toggle="bootgrid" style="margin-bottom: 0px!important;">
                 <thead>
                  <tr>
                   <th class="bg-primary"data-type="numeric" data-sortable="true">ลำดับ</th>
                   <th class="bg-primary">รหัส</th>
                   <th class="bg-primary">ชื่อประเภท</th>
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
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-plus"></span> เพิ่มเครื่องจักรใหม่</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='add_spare_type' name='add_spare_type'>

          <div class="form-group col-md-6">
            <label for="spare_type_code" class="control-label">รหัส:</label>
            <input type="text" class="form-control uppercase" id="spare_type_code" name="spare_type_code">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_type_name" class="control-label">ชื่อประเภท:</label>
            <input type="text" class="form-control" id="spare_type_name" name="spare_type_name">
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
        <button type="button" class="btn btn-success" onclick="addSpareType()">บันทึก</button>
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
        <h4 class="modal-title" id="exampleModalLabel">แก้ไขประเภทเครื่องจักร</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='edit_spare_type' name='edit_spare_type'>

          <input type="hidden" id="spare_type_id" name="spare_type_id" >

          <div class="form-group col-md-6">
            <label for="spare_type_code_edit" class="control-label">รหัส:</label>
            <input type="text" class="form-control" id="spare_type_code_edit" name="spare_type_code_edit" readonly>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_type_name_edit" class="control-label">ชื่อประเภท:</label>
            <input type="text" class="form-control" id="spare_type_name_edit" name="spare_type_name_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="status_edit" class="control-label">สถานะ:</label>
            <select class="form-control" id="status_edit" name="status_edit">
              <option value="Active" class="text-success">Active</option>
              <option value="Inactive" class="text-danger">Inactive</option>
            </select>
          </div>

          <address class="col-md-12">
            <hr>
            <strong>ผู้สร้าง: </strong><br>
            <span id="create_by"></span><br><br>
            <strong>วันที่สร้าง: </strong><br>
            <span id="create_date"></span>
          </address>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" onclick="editSpareType()">บันทึกการเปลี่ยนแปลง</button>
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
                    "ajax": "setting/sparepart_type/fetch_s_pm_sparepart_type.php",
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        { "width": "2%", "targets": 0, "visible": true, "className": "text-center" },
                        { "width": "15%", "targets": 1, "visible": true, "className": "text-center", },
                        { "width": "66%", "targets": 2, "visible": true, "className": "text-left", },
                        { "width": "15%", "targets": 3, "visible": true, "className": "text-center", },
                        { "width": "2%", "targets": 4, "visible": false, }
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
      $("#add_spare_type")[0].reset();
  });

  $('#addModal').on('shown.bs.modal', function () {
      console.log('input focus');
      $("#spare_type_code").focus();
  });

  $('#editModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        // modal.find('.modal-body input').val(recipient)

        $('#spare_type_id').val(id);

        $.ajax({
          url:"setting/sparepart_type/select-data.php",
          method: "POST",
          data: { 'id':id },
          success:function(data){

            console.log(data);

            var json = $.parseJSON(data);
            $("#spare_type_code_edit").val(json[0].spare_type_code);
            $("#spare_type_name_edit").val(json[0].spare_type_name);
            $("#status_edit").val(json[0].status);
            $("#create_by").html(json[0].create_by);
            $("#create_date").html(json[0].create_date);

            $("#spare_type_name_edit").select();

          }
          // End Success
        });

  });
  // End myModal(Edit)


});

function addSpareType(){

  var spare_type_code = $('#spare_type_code');
  var spare_type_name = $('#spare_type_name');
  var formData = new FormData($('#add_spare_type')[0]);

  if(spare_type_code.val() == ''){
    alert('กรุณากรอกรหัสประเภทก่อน!');
    spare_type_code.focus();
    return false;
  }

  if(spare_type_name.val() == ''){
    alert('กรุณากรอกชื่อประเภทก่อน!');
    spare_type_name.focus();
    return false;
  }

  console.log(formData);

      $.ajax({
        url:"setting/sparepart_type/insert.php",
        method: "POST",
        data: formData , //$("#add_spare_type").serialize()
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

          }else if(data == 'invalid_code'){

            alert("รหัสนี้ มีแล้วในระบบ! กรุณาเปลี่ยนใหม่");

            spare_type_code.select();
            return false;
          }

      });

}

function editSpareType(){

  var formData = new FormData($('#edit_spare_type')[0]);

      $.ajax({
        url:"setting/sparepart_type/update.php",
        method: "POST",
        data: formData , //$("#add_spare_type").serialize()
        contentType: false,
        cache: false,
        processData: false
      }).done(function(data){

          console.log(data);

          if(data == 'update_ok'){
            alert("บันทึกการเปลี่ยนแปลงเรียบร้อย");
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
