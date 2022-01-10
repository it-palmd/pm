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
$emp_code = $_SESSION["pm_emp_code"];

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
    <link rel="stylesheet" href="dist/css/jquery-editable-select.css">

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>

    <script src="dist/for_report/js/jquery.dataTables.js"></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js"></script>

    <script src="dist/js/jquery.datetimepicker.js"></script>
    <script src="dist/js/jquery-editable-select.js"></script>
    <script src="dist/js/validationForm.js"></script>

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
      small, .small { font-size: 80%;font-weight: 400; }
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
        .table { width:800px!important; }
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

      input[type="file"]{
        display: none;
      }

      .label-file{
        color: white;
        height: 60px;
        width: max-width: 100%;
        background-color: #f5af09;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Montserrat",sans-serif;
        cursor: pointer;
      }

      .lowercase {text-transform: lowercase; }
      .uppercase { text-transform: uppercase; }
      .capitalize { text-transform: capitalize; }

    </style>


  </head>
  <body>

    <!-- Image loader -->
    <div id='loader' class="preLoad"></div>
    <!-- Image loader -->

   <div class="wrapper" id="" style="display:none;">
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
          <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>ทะเบียนอะไหล่</h4></div>
      </div>

  <!-- ส่วนข้อมูล set_department -->


            <div id="" class="text-center border panel panel-default">

  <!-- Begin panel-body -->
              <div class="panel-body">

                <p>สามารถระบุคำ เพื่อค้นหาอะไหล่ที่ต้องการได้ในช่องค้นหาด้านขวา</p>

                    <div>
                            <strong>แสดง/ซ่อน column:</strong>
                            <a href="#" class="toggle-vis" data-column="0"> ลำดับ</a> |
                            <a href="#" class="toggle-vis" data-column="1">รหัส</a> |
                            <a href="#" class="toggle-vis" data-column="2">ชนิด</a> |
                            <a href="#" class="toggle-vis" data-column="3">ชื่ออะไหล่</a> |
                            <a href="#" class="toggle-vis" data-column="4">รายละเอียด</a> |
                            <a href="#" class="toggle-vis" data-column="5">รุ่น</a> |
                            <a href="#" class="toggle-vis" data-column="6">คลังเก็บ</a> |
                            <a href="#" class="toggle-vis" data-column="7">ราคา</a> |
                            <a href="#" class="toggle-vis" data-column="8">Stork</a> |
                            <a href="#" class="toggle-vis" data-column="9">คงเหลือ</a> |
                            <a href="#" class="toggle-vis" data-column="10">สถานะ</a> |
                            <a href="#" class="toggle-vis text-primary" data-column="11"><strong>จัดการ</strong></a>
                    </div>

              </div>
  <!-- End panel-body -->

              <div class="panel-footer">

                <button onclick="" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#addModal" data-whatever="">
                  <span class="glyphicon glyphicon-plus"></span> เพิ่มอะไหล่ใหม่
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

          <div id="" class="print_panel clearfix" style="clear:both; display:none; margin:0px;">

            <div id="control_container">

              <div class="control_box_lr" style="text-align:left;">
                <img src="images/PDS-Logo-03.jpg" alt="pds-logo" width="170px;"/>
              </div>

                <div class="control_box_c text-center">
                  <h4>ทะเบียนอะไหล่</h4>
                  <p>(Machine List)</p>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5>MT-FR-18</h5>
                </div>

            </div>

               <div class="table-responsive">
                 <p></p>
                <table id="p_data" class="table table-bordered table-condensed table-striped table-hover" cellspacing="0" data-toggle="bootgrid" width="" style="margin-bottom: 0px!important;">
                 <thead>
                  <tr>
                   <th class="bg-primary" data-type="numeric" data-sortable="true">ลำดับ</th>
                   <th class="bg-primary">รหัส</th>
                   <th class="bg-primary text-center">ชนิด</th>
                   <th class="bg-primary text-left">ชื่ออะไหล่</th>
                   <th class="bg-primary text-left">รายละเอียด</th>
                   <th class="bg-primary text-left">รุ่น</th>
                   <th class="bg-primary text-center">คลังเก็บ</th>
                   <th class="bg-primary text-right">ราคา</th>
                   <th class="bg-primary text-right">Stork</th>
                   <th class="bg-primary text-right">คงเหลือ</th>
                   <th class="bg-primary text-center">สถานะ</th>
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-plus"></span> เพิ่มอะไหล่ใหม่</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='add_spare' name='add_spare'>

          <div class="text-center">
               <img id="imgAvatar" style="max-width:100%; height:auto;">
          </div>

          <div class="form-group">
            <label for="spare_pic" class="label-file">
              <span class="glyphicon glyphicon-print"></span> &nbsp;&nbsp;รูปอะไหล่
            </label>
               <input type="file" name="spare_pic" id="spare_pic" onchange="showPreview(this)" data-required="กรุณาเลือก รูปอะไหล่" />
               <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
          </div>
          <div class="form-group col-md-6">
            <label for="spare_code" class="control-label">รหัส:</label>
            <input type="text" class="form-control uppercase" id="spare_code" name="spare_code" data-required="กรุณากรอก รหัสอะไหล่">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_category" class="control-label">ประเภท:</label><small for="breakdown" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มประเภทอะไหล่ก่อน</small>
            <select class="form-control" id="spare_category>" name="spare_category" data-required="กรุณาระบุ ประเภทอะไหล่">
              <option value=""> ---- ระบุประเภท---- </option>
              <?php
              // Connect DB
              $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
              mysqli_set_charset($connect, "utf8");

                $sql = "SELECT spare_type_name
                        FROM tbl_sparepart_type
                        WHERE status != 'Inactive'
                        ORDER BY spare_type_name ASC
                        ";

                        $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

                        while ($r = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                          echo '<option value="'.$r['spare_type_name'].'">'.$r['spare_type_name'].'</option>';
                        }//end while
              ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_name_th" class="control-label">ชื่ออะไหล่(ไทย):</label>
            <input type="text" class="form-control" id="spare_name_th" name="spare_name_th" data-required="กรุณากรอก ชื่ออะไหล่(ไทย)">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_name_en" class="control-label">ชื่ออะไหล่(EN):</label>
            <input type="text" class="form-control" id="spare_name_en" name="spare_name_en">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_description" class="control-label">รายละเอียด:</label>
            <textarea class="form-control" id="spare_description" name="spare_description" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_location" class="control-label">จุดติดตั้ง:</label>
            <input type="text" class="form-control" id="spare_location" name="spare_location" data-required="กรุณาระบุ จุดติดตั้งอะไหล่">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_brand" class="control-label">ยี่ห้อ:</label>
            <input type="text" class="form-control" id="spare_brand" name="spare_brand">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_model" class="control-label">รุ่น:</label>
            <input type="text" class="form-control" id="spare_model" name="spare_model">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_dealer" class="control-label">ตัวแทนจำหน่าย:</label>
            <input type="text" class="form-control" id="spare_dealer" name="spare_dealer">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_price" class="control-label">ราคา(บาท):</label>
            <input type="number" class="form-control" id="spare_price" name="spare_price" min="0" max="" value="0.00">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_amount" class="control-label">จำนวน(ชิ้น):</label>
            <input type="number" class="form-control" id="spare_amount" name="spare_amount" min="0" max="" value="0">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_min" class="control-label">จำนวนน้อยสุด(ชิ้น):</label>
            <input type="number" class="form-control" id="spare_min" name="spare_min" min="0" max="" value="0">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_install_date" class="control-label">ติดตั้ง:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_install_date" name="spare_install_date">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-6 date">
            <label for="spare_start_work" class="control-label">เริ่มใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_start_work" name="spare_start_work">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-6 date">
            <label for="spare_stop_work" class="control-label">ยกเลิกใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_stop_work" name="spare_stop_work">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="note" class="control-label">หมายเหตุ:</label>
            <textarea class="form-control" id="note" name="note" rows="4" cols="50"></textarea>
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
        <button type="button" class="btn btn-success" onclick="addSpare()">บันทึก</button>
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
        <h4 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลอะไหล่</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='edit_spare' name='edit_spare'>

          <input type="hidden" id="spare_sub_id" name="spare_sub_id" >
          <input type="hidden" id="spare_pic_old_edit" name="spare_pic_old_edit" value="">

          <div class="text-center">
                 <img id="imgAvatar_edit" style="max-width:100%; height:auto;" src=""  alt="Spare Pic">
          </div>

          <div class="form-group">
            <label for="spare_pic_edit" class="label-file">
              <i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;&nbsp;รูปอะไหล่
            </label>
                <input type="file" name="spare_pic_edit" id="spare_pic_edit" onchange="showPreview_edit(this)" />
                <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
          </div>
          <div class="form-group col-md-6">
            <label for="spare_sub_code_edit" class="control-label">รหัส:</label>
            <input type="text" class="form-control" id="spare_sub_code_edit" name="spare_sub_code_edit" readonly>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_category_edit" class="control-label">ประเภท:</label><small for="breakdown" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มประเภทอะไหล่ก่อน</small>
            <input type="hidden" class="form-control" id="spare_category_hidden" name="spare_category_hidden">

            <select class="form-control" id="spare_category_edit>" name="spare_category_edit">
              <option value=""> ---- ระบุประเภท---- </option>
              <?php
              // Connect DB
              $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
              mysqli_set_charset($connect, "utf8");

                $sql = "SELECT spare_type_name
                        FROM tbl_sparepart_type
                        WHERE status != 'Inactive'
                        ORDER BY spare_type_name ASC
                        ";

                        $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

                        while ($r = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                          echo '<option value="'.$r['spare_type_name'].'">'.$r['spare_type_name'].'</option>';
                        }//end while
              ?>
            </select>

          </div>
          <div class="form-group col-md-12">
            <label for="spare_name_th_edit" class="control-label">ชื่ออะไหล่(ไทย):</label>
            <input type="text" class="form-control" id="spare_name_th_edit" name="spare_name_th_edit">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_name_en_edit" class="control-label">ชื่ออะไหล่(EN):</label>
            <input type="text" class="form-control" id="spare_name_en_edit" name="spare_name_en_edit">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_description_edit" class="control-label">รายละเอียด:</label>
            <textarea class="form-control" id="spare_description_edit" name="spare_description_edit" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_location_edit" class="control-label">จุดติดตั้ง:</label>
            <input type="text" class="form-control" id="spare_location_edit" name="spare_location_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_brand_edit" class="control-label">ยี่ห้อ:</label>
            <input type="text" class="form-control" id="spare_brand_edit" name="spare_brand_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_model_edit" class="control-label">รุ่น:</label>
            <input type="text" class="form-control" id="spare_model_edit" name="spare_model_edit">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_dealer_edit" class="control-label">ตัวแทนจำหน่าย:</label>
            <input type="text" class="form-control" id="spare_dealer_edit" name="spare_dealer_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_price_edit" class="control-label">ราคา:</label>
            <input type="number" class="form-control" id="spare_price_edit" name="spare_price_edit" min="0" max="">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_amount_edit" class="control-label">จำนวน:</label>
            <input type="number" class="form-control" id="spare_amount_edit" name="spare_amount_edit" min="0" max="">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_min_edit" class="control-label">จำนวนน้อยสุด:</label>
            <input type="number" class="form-control" id="spare_min_edit" name="spare_min_edit" min="0" max="">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_install_date_edit" class="control-label">ติดตั้ง:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_install_date_edit" name="spare_install_date_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-6 date">
            <label for="spare_start_work_edit" class="control-label">เริ่มใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_start_work_edit" name="spare_start_work_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-6 date">
            <label for="spare_stop_work_edit" class="control-label">ยกเลิกใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_stop_work_edit" name="spare_stop_work_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="note_edit" class="control-label">หมายเหตุ:</label>
            <textarea class="form-control" id="note_edit" name="note_edit" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-8">
            <label for="status_edit" class="control-label">สถานะ:</label>
            <select class="form-control" id="status_edit" name="status_edit">
              <option value="Active" class="text-success">Active</option>
              <option value="Inactive" class="text-danger">Inactive</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <hr>
            <strong>แก้ไขโดย: </strong><br>
            <span id="update_by"></span>
          </div><div class="form-group col-md-6">
            <hr>
            <strong>แก้ไขล่าสุด: </strong><br>
            <span id="last_update_date"></span>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" onclick="editSpare()">บันทึกการเปลี่ยนแปลง</button>
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

   // var month = $('#month').val();
   // var year = $('#year').val();

   var dataTable = $('#p_data').DataTable({
     "processing" : true,
     "serverSide" : true,
     "scrollX": false,
     "dom": '<lf<t>ip>',
     "paging":   true,
     "ordering": true,
     "stateSave": false, //เวลากด refresh หน้าเว็บจะค้างไว้ที่ page ที่เราเลือก
     "info":     true,
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
      "pageLength": 10, //-1 = All
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
      "columnDefs": [
                   { "width": "1%", "targets": 0, "className":"text-center" },
                   { "width": "7%", "targets": 1, "className":"text-center" },
                   { "width": "8%", "targets": 2, "className":"text-center" },
                   { "width": "20%", "targets": 3, "className":"text-left" },
                   { "width": "15%", "targets": 4, "className":"text-left"},
                   { "width": "12%", "targets": 5, "className":"text-left" },
                   { "width": "8%", "targets": 6, "className":"text-center" },
                   { "width": "7%", "targets": 7, "className":"text-right" },
                   { "width": "5%", "targets": 8, "className":"text-right" },
                   { "width": "5%", "targets": 9, "className":"text-right" },
                   { "width": "7%", "targets": 10, "className":"text-center" },
                   {
                       // The `data` parameter refers to the data for the cell (defined by the
                       // `data` option, which defaults to the column being worked with, in
                       // this case `data: 0`.
                       "render": function ( data, type, row ) {
                           return '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editModal" data-id="'+row[0]+'"><span class="glyphicon glyphicon-edit"></span></button> '
                       },
                       "targets": 11,
                       "width": "5%", "className":"text-right", "visible": false
                   }
                 ],
      "ajax" : {
         url:"setting/sparepart_sub/fetch_s_pm_sparepart_sub.php",
         type:"POST",
         // data:{is_date_search:is_date_search, month:month, year:year}
      }

   });
   //End dataTable

   $('a.toggle-vis').on( 'click', function (e) {
          e.preventDefault();

          // Get the column API object
          var column = dataTable.column( $(this).attr('data-column') );

          // Toggle the visibility
          column.visible( ! column.visible() );
      } );

  }
  //End fetch_data function

  $('#addModal').on('shown.bs.modal', function (e) {
      console.log('reset form');
      $("#imgAvatar").attr('src', ' ');
      $("#add_spare")[0].reset();
      $("#spare_code").focus();
      // $('option:selected', 'select[name="spare_category_edit"]').removeAttr('selected');  //remove selected one
      // $("#imgAvatar").attr('src', ' ');
      // $('#spare_pic').val('');
  });

  $('#editModal').on('hidden.bs.modal', function (e) {
      console.log('reset form');
      $("#edit_spare")[0].reset();
      $("#imgAvatar_edit").attr('src', ' ');

      // $("#imgAvatar").attr('src', ' ');
      // $('#spare_pic').val('');
  });

  $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        $('#spare_sub_id').val(id);

        $.ajax({
          url:"setting/sparepart_sub/select-data.php",
          method: "POST",
          data: { 'id':id },
          success:function(data){
            console.log(data);
            var json = $.parseJSON(data);

            $("#spare_sub_code_edit").val(json[0].spare_sub_code);
            $('select[name="spare_category_edit"]').find('option[value="'+json[0].spare_category+'"]').attr("selected",true);
            $("#spare_name_th_edit").val(json[0].spare_name_th);
            $("#spare_name_en_edit").val(json[0].spare_name_en);
            $("#spare_description_edit").val(json[0].spare_description);
            $("#spare_location_edit").val(json[0].spare_location);
            $("#spare_brand_edit").val(json[0].spare_brand);
            $("#spare_model_edit").val(json[0].spare_model);
            $("#spare_dealer_edit").val(json[0].spare_dealer);
            $("#spare_price_edit").val(json[0].spare_price);
            $("#spare_pic_old_edit").val(json[0].spare_pic);
            $("#imgAvatar_edit").attr('src', 'images/sparepart/'+json[0].spare_pic);
            $("#spare_amount_edit").val(json[0].spare_amount);
            $("#spare_min_edit").val(json[0].spare_min);
            $("#spare_install_date_edit").val(json[0].spare_install_date);
            $("#spare_start_work_edit").val(json[0].spare_start_work);
            $("#spare_stop_work_edit").val(json[0].spare_stop_work);
            $("#note_edit").val(json[0].note);
            $("#update_by").text(json[0].update_by);
            $("#last_update_date").text(json[0].last_update_date);
            $("#status_edit").val(json[0].status);

          }
          // End Success

        });


  });
  // End myModal(Edit)

  $('.date_edit').datetimepicker({
    timepicker:false,
    format:'Y-m-d',
    lang:'th',
    closeOnDateSelect:true,
    // theme:'dark',
    // mask:true, // '9999/19/39 29:59' - digit is the maximum possible for a cell
  });





});

function addSpare(){

  var spare_pic = $('#spare_pic');
  var formData = new FormData($('#add_spare')[0]);

  // console.log();

    if(check_form($('#add_spare')[0]) === true){

    console.log(formData);

      $.ajax({
        url:"setting/sparepart/insert.php",
        method: "POST",
        data: formData , //$("#add_spare").serialize()
        contentType: false,
        cache: false,
        processData: false,
        // beforeSend:function(){ //ก่อนส่ง data ไป
        //   $('#preLoading').show();
        //   $('.wrapper').hide();
        // },
      }).done(function(data){
        // success:function(data){
          console.log(data);

          if(data == 'ok'){

            $('#spare_pic').val('');
            $('#addModal').modal('toggle');

            $('#p_data').DataTable().draw();
            // $('#preLoading').hide();
            // $('.wrapper').show();

            // alert("บันทึกอุปกรณ์ใหม่เรียบร้อย");

          }else if(data == 'invalid_code'){

            alert("รหัสนี้ มีแล้วในระบบ! กรุณาเปลี่ยนใหม่");

            spare_code.select();
            return false;
          }

      });

    }//check_form

}

function editSpare(){

  var formData = new FormData($('#edit_spare')[0]);

      $.ajax({
        url:"setting/sparepart/update.php",
        method: "POST",
        data: formData , //$("#add_spare").serialize()
        contentType: false,
        cache: false,
        processData: false
      }).done(function(data){

          console.log(data);

          if(data == 'ok'){
            alert("บันทึกการเปลี่ยนแปลงเรียบร้อย");
            $('#p_data').DataTable().draw();
            $('#spare_pic_edit').val('');
            $('#editModal').modal('toggle');
            $('option:selected', 'select[name="spare_category_edit"]').removeAttr('selected');  //remove selected one
          }else{
            alert("การส่งค่าไม่สำเร็จ");
          }
      });

}

function showPreview(ele)
 {
     $('#imgAvatar').attr('src', ele.value); // for IE
           if (ele.files && ele.files[0]) {

               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#imgAvatar').attr('src', e.target.result);
               }

               reader.readAsDataURL(ele.files[0]);
           }
      $('#spare_code').focus();
 }

 function showPreview_edit(ele)
  {
      $('#imgAvatar_edit').attr('src', ele.value); // for IE
            if (ele.files && ele.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgAvatar_edit').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
            }
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
