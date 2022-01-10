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
          <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>ทะเบียนเครื่องจักร</h4></div>
      </div>

  <!-- ส่วนข้อมูล set_department -->


            <div id="" class="text-center border panel panel-default">

  <!-- Begin panel-body -->
              <div class="panel-body">

                <p>สามารถระบุคำ เพื่อค้นหาเครื่องจักรที่ต้องการได้ในช่องค้นหาด้านขวา</p>

                    <div>
                            <strong>แสดง/ซ่อน column:</strong>
                            <a href="#" class="toggle-vis" data-column="0"> ลำดับ</a> |
                            <a href="#" class="toggle-vis" data-column="1">รหัส</a> |
                            <a href="#" class="toggle-vis" data-column="2">ประเภท</a> |
                            <a href="#" class="toggle-vis" data-column="3">ชื่อเครื่องจักร</a> |
                            <a href="#" class="toggle-vis" data-column="4">จุดติดตั้ง</a> |
                            <a href="#" class="toggle-vis" data-column="5">สถานะ</a> |
                            <a href="#" class="toggle-vis text-primary" data-column="6"><strong>จัดการ</strong></a>
                    </div>

              </div>
  <!-- End panel-body -->

              <div class="panel-footer">

                <button onclick="" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#addModal" data-whatever="">
                  <span class="glyphicon glyphicon-plus"></span> เพิ่มอุปรกรณ์ใหม่
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
                  <h4>ทะเบียนเครื่องจักร</h4>
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
                   <th class="bg-primary"data-type="numeric" data-sortable="true">ลำดับ</th>
                   <th class="bg-primary">รหัส</th>
                   <th class="bg-primary">ประเภท</th>
                   <th class="bg-primary">ชื่อเครื่องจักร</th>
                   <th class="bg-primary">จุดติดตั้ง</th>
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-plus"></span> เพิ่มเครื่องจักรใหม่</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='add_spare' name='add_spare'>

          <div class="text-center">
               <img id="imgAvatar" style="max-width:100%; height:auto;">
          </div>

          <div class="form-group">
            <label for="spare_pic" class="label-file">
              <span class="glyphicon glyphicon-print"></span> &nbsp;&nbsp;รูปเครื่องจักร
            </label>
               <input type="file" name="spare_pic" id="spare_pic" onchange="showPreview(this)" data-required="กรุณาเลือก รูปเครื่องจักร" />
               <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
          </div>
          <div class="form-group col-md-6">
            <label for="spare_code" class="control-label">รหัส:</label>
            <input type="text" class="form-control uppercase" id="spare_code" name="spare_code" data-required="กรุณากรอก รหัสเครื่องจักร">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_category" class="control-label">ประเภท:</label><small for="breakdown" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มประเภทเครื่องจักรก่อน</small>
            <select class="form-control" id="spare_category>" name="spare_category" data-required="กรุณาระบุ ประเภทเครื่องจักร">
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
            <label for="spare_name_th" class="control-label">ชื่อเครื่องจักร(ไทย):</label>
            <input type="text" class="form-control" id="spare_name_th" name="spare_name_th" data-required="กรุณากรอก ชื่อเครื่องจักร(ไทย)">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_name_en" class="control-label">ชื่อเครื่องจักร(EN):</label>
            <input type="text" class="form-control" id="spare_name_en" name="spare_name_en">
          </div>
          <div class="form-group col-md-12">
            <label for="spare_description" class="control-label">รายละเอียด:</label>
            <textarea class="form-control" id="spare_description" name="spare_description" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="spare_location" class="control-label">จุดติดตั้ง:</label>
            <input type="text" class="form-control" id="spare_location" name="spare_location" data-required="กรุณาระบุ จุดติดตั้งเครื่องจักร">
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
  <div class="modal-fullscreen-sm-down">
    <div class="modal-content text-primary">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลเครื่องจักร</h4>
      </div>
      <div class="modal-body col-md-12">
        <form id='edit_spare' name='edit_spare'>

          <input type="hidden" id="spare_id" name="spare_id" >
          <input type="hidden" id="spare_pic_old_edit" name="spare_pic_old_edit" value="">

          <div class="form-group col-md-6 text-center">
            <div style="height:535px;"><img id="imgAvatar_edit" style="max-width:100%; height:535px;" src=""  alt="Spare Pic"></div>
            <label for="spare_pic_edit" class="label-file">
              <i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;&nbsp;รูปเครื่องจักร
            </label>
                <input type="file" name="spare_pic_edit" id="spare_pic_edit" onchange="showPreview_edit(this)" />
                <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
          </div>
          <div class="form-group col-md-3">
            <label for="spare_code_edit" class="control-label">รหัส:</label>
            <input type="text" class="form-control" id="spare_code_edit" name="spare_code_edit" readonly>
          </div>
          <div class="form-group col-md-3">
            <label for="spare_category_edit" class="control-label">ประเภท:</label><small for="breakdown" class="text-danger">*หากไม่มีประเภทในรายการ ให้ไปเพิ่มประเภทเครื่องจักรก่อน</small>
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
          <div class="form-group col-md-6">
            <label for="spare_name_th_edit" class="control-label">ชื่อเครื่องจักร(ไทย):</label>
            <input type="text" class="form-control" id="spare_name_th_edit" name="spare_name_th_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_name_en_edit" class="control-label">ชื่อเครื่องจักร(EN):</label>
            <input type="text" class="form-control" id="spare_name_en_edit" name="spare_name_en_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="spare_description_edit" class="control-label">รายละเอียด:</label>
            <textarea class="form-control" id="spare_description_edit" name="spare_description_edit" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="spare_location_edit" class="control-label">จุดติดตั้ง:</label>
            <input type="text" class="form-control" id="spare_location_edit" name="spare_location_edit">
          </div>
          <div class="form-group col-md-3">
            <label for="spare_brand_edit" class="control-label">ยี่ห้อ:</label>
            <input type="text" class="form-control" id="spare_brand_edit" name="spare_brand_edit">
          </div>
          <div class="form-group col-md-3">
            <label for="spare_model_edit" class="control-label">รุ่น:</label>
            <input type="text" class="form-control" id="spare_model_edit" name="spare_model_edit">
          </div>
          <div class="form-group col-md-3">
            <label for="spare_dealer_edit" class="control-label">ตัวแทนจำหน่าย:</label>
            <input type="text" class="form-control" id="spare_dealer_edit" name="spare_dealer_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="spare_price_edit" class="control-label">ราคา:</label>
            <input type="number" class="form-control" id="spare_price_edit" name="spare_price_edit" min="0" max="">
          </div>
          <div class="form-group col-md-2">
            <label for="spare_amount_edit" class="control-label">จำนวน:</label>
            <input type="number" class="form-control" id="spare_amount_edit" name="spare_amount_edit" min="0" max="">
          </div>
          <div class="form-group col-md-2">
            <label for="spare_min_edit" class="control-label">จำนวนน้อยสุด:</label>
            <input type="number" class="form-control" id="spare_min_edit" name="spare_min_edit" min="0" max="">
          </div>
          <div class="form-group col-md-2">
            <label for="spare_install_date_edit" class="control-label">ติดตั้ง:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_install_date_edit" name="spare_install_date_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-2 date">
            <label for="spare_start_work_edit" class="control-label">เริ่มใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_start_work_edit" name="spare_start_work_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-2 date">
            <label for="spare_stop_work_edit" class="control-label">ยกเลิกใช้งาน:</label>
            <div class="input-group date">
              <input type="text" class="form-control date_edit" id="spare_stop_work_edit" name="spare_stop_work_edit">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="status_edit" class="control-label">สถานะ:</label>
            <select class="form-control" id="status_edit" name="status_edit">
              <option value="Active" class="text-success">Active</option>
              <option value="Inactive" class="text-danger">Inactive</option>
            </select>
          </div>

          <div class="form-group col-md-12">
            <h4>ข้อมูลจำเพาะ:</h4>
            <hr>
        <!-- begin ขนาดและส่วนประกอบ -->
            <label class="label label-warning">ขนาด / ส่วนประกอบ</label>
          </div>

          <div class="form-group col-md-2">
            <label for="for_chain" class="control-label">โซ่ลำเลียง (Chain)</label>
            <input type="text" class="form-control" id="compo_chain_edit" name="compo_chain_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_sporcket" class="control-label">เฟืองโซ่ลำเลียง (Sporcket)</label>
            <input type="text" class="form-control" id="compo_sporcket_edit" name="compo_sporcket_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_spare_drive_shaft" class="control-label">ขนาดเพลาขับ (Drive shaft)</label>
            <input type="text" class="form-control" id="compo_drive_shaft_edit" name="compo_drive_shaft_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_end_shaft" class="control-label">ขนาดเพลาตาม (End Shaft)</label>
            <input type="text" class="form-control" id="compo_end_shaft_edit" name="compo_end_shaft_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_key" class="control-label">ลิ่ม (Key)</label>
            <input type="text" class="form-control" id="compo_key_edit" name="compo_key_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_driver_side_bearing" class="control-label">เสื้อลูกปืนด้านขับ</label>
            <input type="text" class="form-control" id="compo_driver_side_bearing_edit" name="compo_driver_side_bearing_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_side_bearing_shirt" class="control-label">เสื้อลูกปืนด้านตาม</label>
            <input type="text" class="form-control" id="compo_side_bearing_shirt_edit" name="compo_side_bearing_shirt_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_drive_side_bearing" class="control-label">ลูกปืนด้านขับ</label>
            <input type="text" class="form-control" id="compo_drive_side_bearing_edit" name="compo_drive_side_bearing_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_side_bearing" class="control-label">ลูกปืนด้านตาม</label>
            <input type="text" class="form-control" id="compo_side_bearing_edit" name="compo_side_bearing_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_liner" class="control-label">Liner</label>
            <input type="text" class="form-control" id="compo_liner_edit" name="compo_liner_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_bucket" class="control-label">กะพ้อ (Bucket)</label>
            <input type="text" class="form-control" id="compo_bucket_edit" name="compo_bucket_edit">
          </div>
          <div class="form-group col-md-2">
            <label for="for_scraper_bar" class="control-label">ใบพา (Scraper bar)</label>
            <input type="text" class="form-control" id="compo_scraper_bar_edit" name="compo_scraper_bar_edit">
          </div>
      <!-- end ขนาดและส่วนประกอบ -->

      <!-- begin มอร์เตอร์ (Motor) -->
      <div class="form-group col-md-12">
        <hr>
        <label class="label label-warning">มอร์เตอร์ (Motor)</label>
      </div>

        <div class="form-group col-md-2">
          <label for="for_motor_brand" class="control-label">ยี่ห้อ (Brand)</label>
          <input type="text" class="form-control" id="motor_brand_edit" name="motor_brand_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_ser_no" class="control-label">Ser. No</label>
          <input type="text" class="form-control" id="motor_ser_no_edit" name="motor_ser_no_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_model_type" class="control-label">Model / Type</label>
          <input type="text" class="form-control" id="motor_model_type_edit" name="motor_model_type_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_rpm" class="control-label">รอบ/นาที (rpm.)</label>
          <input type="text" class="form-control" id="motor_rpm_edit" name="motor_rpm_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_vot" class="control-label">แรงดันไฟฟ้า (Vot)</label>
          <input type="text" class="form-control" id="motor_vot_edit" name="motor_vot_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_amp" class="control-label">กระแสไฟฟ้า(Amp.)</label>
          <input type="text" class="form-control" id="motor_amp_edit" name="motor_amp_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_kw" class="control-label">กำลังไฟฟ้า ( kW)</label>
          <input type="text" class="form-control" id="motor_kw_edit" name="motor_kw_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_hp" class="control-label">แรงม้า (HP)</label>
          <input type="text" class="form-control" id="motor_hp_edit" name="motor_hp_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_bearing" class="control-label">ลูกปืน (Bearing)</label>
          <input type="text" class="form-control" id="motor_bearing_edit" name="motor_bearing_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motro_drive_shaft" class="control-label">ความโต เพลาขับ</label>
          <input type="text" class="form-control" id="motro_drive_shaft_edit" name="motro_drive_shaft_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_pulley" class="control-label">มูเล่ย์ (Pulley)</label>
          <input type="text" class="form-control" id="motor_pulley_edit" name="motor_pulley_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_coupling" class="control-label">คับปิง (Coupling)</label>
          <input type="text" class="form-control" id="motor_coupling_edit" name="motor_coupling_edit">
        </div>
        <div class="form-group col-md-2">
          <label for="for_motor_belt" class="control-label">สายพาน (Belt)</label>
          <input type="text" class="form-control" id="motor_belt_edit" name="motor_belt_edit">
        </div>
    <!-- end มอร์เตอร์ (motor) -->

    <!-- begin เกียร์ (Gear) -->
    <div class="form-group col-md-12">
      <hr>
      <label class="label label-warning">เกียร์ (Gear)</label>
    </div>

      <div class="form-group col-md-2">
        <label for="for_gear_brand" class="control-label">ยี่ห้อ (Brand)</label>
        <input type="text" class="form-control" id="gear_brand_edit" name="gear_brand_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_ser_no" class="control-label">Ser. No</label>
        <input type="text" class="form-control" id="gear_ser_no_edit" name="gear_ser_no_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_model_type" class="control-label">Model / Type</label>
        <input type="text" class="form-control" id="gear_model_type_edit" name="gear_model_type_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_na_rpm" class="control-label">รอบขับ (na) rpm</label>
        <input type="text" class="form-control" id="gear_na_rpm_edit" name="gear_na_rpm_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_motor_vot" class="control-label">รอบตาม (ne) rpm</label>
        <input type="text" class="form-control" id="gear_ne_rpm_edit" name="gear_ne_rpm_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_i" class="control-label">อัตราทด (i)</label>
        <input type="text" class="form-control" id="gear_i_edit" name="gear_i_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_im" class="control-label">IM</label>
        <input type="text" class="form-control" id="gear_im_edit" name="gear_im_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_bearing" class="control-label">ลูกปืน (Bearing)</label>
        <input type="text" class="form-control" id="gear_bearing_edit" name="gear_bearing_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_drive_shaft" class="control-label">ความโต เพลาขับ/เพลาตาม</label>
        <input type="text" class="form-control" id="gear_drive_shaft_edit" name="gear_drive_shaft_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_pulley" class="control-label">มูเล่ย์ (Pulley)</label>
        <input type="text" class="form-control" id="gear_pulley_edit" name="gear_pulley_edit">
      </div>
      <div class="form-group col-md-2">
        <label for="for_gear_lubrication" class="control-label">น้ำมันหล่อลื่น (Lubrication)</label>
        <input type="text" class="form-control" id="gear_lubrication_edit" name="gear_lubrication_edit">
      </div>
  <!-- end เกียร์ (Gear) -->


  <!-- begin อุอุปกรณ์ไฟฟ้าควบคุม (Gear) -->
      <div class="form-group col-md-12">
        <hr>
        <label class="label label-warning">อุปกรณ์ไฟฟ้าควบคุม (Electrical Equipment)</label>
      </div>

        <div class="form-group col-md-3">
          <label for="for_elec_circuit_beraker" class="control-label">Circuit beraker</label>
          <input type="text" class="form-control" id="elec_circuit_beraker_edit" name="elec_circuit_beraker_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_magnetic_contactor" class="control-label">Magnetic contactor</label>
          <input type="text" class="form-control" id="elec_magnetic_contactor_edit" name="elec_magnetic_contactor_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_overload_relay" class="control-label">Overload relay</label>
          <input type="text" class="form-control" id="elec_overload_relay_edit" name="elec_overload_relay_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_relay" class="control-label">Relay</label>
          <input type="text" class="form-control" id="elec_relay_edit" name="elec_relay_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_miniature_circuit_beraker" class="control-label">Miniature circuit beraker</label>
          <input type="text" class="form-control" id="elec_miniature_circuit_beraker_edit" name="elec_miniature_circuit_beraker_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_timer_relay" class="control-label">Timer relay</label>
          <input type="text" class="form-control" id="elec_timer_relay_edit" name="elec_timer_relay_edit">
        </div>
        <div class="form-group col-md-3">
          <label for="for_elec_current_tranformer" class="control-label">Current tranformer</label>
          <input type="text" class="form-control" id="elec_current_tranformer_edit" name="elec_current_tranformer_edit">
        </div>

    <!-- end เกียร์ (Gear) -->

        <hr>
          <div class="form-group col-md-12">
            <label for="note_edit" class="control-label">หมายเหตุ:</label>
            <textarea class="form-control" id="note_edit" name="note_edit" rows="4" cols="50"></textarea>
          </div>
          <div class="form-group col-md-6">
            <hr>
            <strong>แก้ไขโดย: </strong><br>
            <span id="update_by"></span>
          </div>
          <div class="form-group col-md-6">
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

    var dataTable = $('#p_data').DataTable({

                    "processing": true,
                    "serverSide": true,
                    "ajax": "setting/sparepart/fetch_s_pm_sparepart.php",
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        { "targets": 0, "visible": true, "className": "text-center", "width": "2%" }, //target: "_all" คือเลือกทุก column
                        { "targets": 1, "visible": true, "className": "text-center" },
                        { "targets": 5, "visible": true, "className": "text-center", "width": "10%" },
                        { "targets": 6, "visible": false, "className": "text-left", "width": "6%" },
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
        var id = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        // modal.find('.modal-body input').val(recipient)

        $('#spare_id').val(id);

        $.ajax({
          url:"setting/sparepart/select-data.php",
          method: "POST",
          data: { 'id':id },
          success:function(data){

            console.log(data);

            var json = $.parseJSON(data);

            $("#spare_code_edit").val(json[0].spare_code);
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

            $("#compo_chain_edit").val(json[0].compo_chain);
            $("#compo_sporcket_edit").val(json[0].compo_sporcket);
            $("#compo_drive_shaft_edit").val(json[0].compo_drive_shaft);
            $("#compo_end_shaft_edit").val(json[0].compo_end_shaft);
            $("#compo_key_edit").val(json[0].compo_key);
            $("#compo_driver_side_bearing_edit").val(json[0].compo_driver_side_bearing);
            $("#compo_side_bearing_shirt_edit").val(json[0].compo_side_bearing_shirt);
            $("#compo_drive_side_bearing_edit").val(json[0].compo_drive_side_bearing);
            $("#compo_side_bearing_edit").val(json[0].compo_side_bearing);
            $("#compo_liner_edit").val(json[0].compo_liner);
            $("#compo_bucket_edit").val(json[0].compo_bucket);
            $("#compo_scraper_bar_edit").val(json[0].compo_scraper_bar);

            $("#motor_brand_edit").val(json[0].motor_brand);
            $("#motor_ser_no_edit").val(json[0].motor_ser_no);
            $("#motor_model_type_edit").val(json[0].motor_model_type);
            $("#motor_rpm_edit").val(json[0].motor_rpm);
            $("#motor_vot_edit").val(json[0].motor_vot);
            $("#motor_amp_edit").val(json[0].motor_amp);
            $("#motor_kw_edit").val(json[0].motor_kw);
            $("#motor_hp_edit").val(json[0].motor_hp);
            $("#motor_bearing_edit").val(json[0].motor_bearing);
            $("#motro_drive_shaft_edit").val(json[0].motro_drive_shaft);
            $("#motor_pulley_edit").val(json[0].motor_pulley);
            $("#motor_coupling_edit").val(json[0].motor_coupling);
            $("#motor_belt_edit").val(json[0].motor_belt);

            $("#gear_brand_edit").val(json[0].gear_brand);
            $("#gear_ser_no_edit").val(json[0].gear_ser_no);
            $("#gear_model_type_edit").val(json[0].gear_model_type);
            $("#gear_na_rpm_edit").val(json[0].gear_na_rpm);
            $("#gear_ne_rpm_edit").val(json[0].gear_ne_rpm);
            $("#gear_i_edit").val(json[0].gear_i);
            $("#gear_im_edit").val(json[0].gear_im);
            $("#gear_bearing_edit").val(json[0].gear_bearing);
            $("#gear_drive_shaft_edit").val(json[0].gear_drive_shaft);
            $("#gear_pulley_edit").val(json[0].gear_pulley);
            $("#gear_lubrication_edit").val(json[0].gear_lubrication);

            $("#elec_circuit_beraker_edit").val(json[0].elec_circuit_beraker);
            $("#elec_magnetic_contactor_edit").val(json[0].elec_magnetic_contactor);
            $("#elec_overload_relay_edit").val(json[0].elec_overload_relay);
            $("#elec_relay_edit").val(json[0].elec_relay);
            $("#elec_miniature_circuit_beraker_edit").val(json[0].elec_miniature_circuit_beraker);
            $("#elec_timer_relay_edit").val(json[0].elec_timer_relay);
            $("#elec_current_tranformer_edit").val(json[0].elec_current_tranformer);

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
