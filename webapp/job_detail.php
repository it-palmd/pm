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

$job_code = $_GET['job_code'];

// echo $u_level;

include_once('../include/connect_oop_db.php');

            $sql = "SELECT
                        r.*,
                        (SELECT tech_type_name FROM tbl_tech_type  WHERE tech_type_code = r.tech_group ) AS tech_group,
                        (SELECT CONCAT(emp_firstname,'  ',emp_lastname) FROM tbl_employee  WHERE emp_code = r.repair_informer ) AS informer_name,
                        (SELECT CONCAT(emp_firstname,'  ',emp_lastname) FROM tbl_employee  WHERE emp_code = r.assigner ) AS assigner_name,
                        (SELECT CONCAT(emp_firstname,'  ',emp_lastname) FROM tbl_employee  WHERE emp_code = r.tech_accept ) AS tech_accept_name,
                        (SELECT CONCAT(emp_firstname,'  ',emp_lastname) FROM tbl_employee  WHERE emp_code = r.inspector ) AS inspector_name,
                        s.spare_code, s.spare_name_th, s.spare_name_en, s.spare_location,
                        CONCAT(s.spare_code,' - ',s.spare_name_th,' (',s.spare_name_en,')') as repair_spare_name

                    FROM tbl_repair_register as r
                  	INNER JOIN tbl_sparepart as s ON r.repair_spare_code = s.spare_code

                    WHERE r.repair_code = '$job_code'
                    ";

            $result = $mysqli->query($sql);
            $rs = $result->fetch_object();

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../images/icons/construction-and-tools.png" />
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../bootstrap_v3.3.6/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link href="dist/jquery.bootgrid.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="dist/css/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery/jquery-3.3.1.slim.js"></script>
    <script src="../js/jquery/popper.js"></script>
    <script src="../js/jquery/bootstrap.js"></script>

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/jquery-1.11.1.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>
    <script src="dist/jquery.bootgrid.min.js"></script>
    <script src="dist/js/jquery.datetimepicker.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

        @media screen and (max-width: 769px) {
          /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
          .table-responsive { font-size: 80%; }
          .control_box_c { width:800px!important; }
          .navbar { width:325px; margin:0 auto; }
          p { font-size: 80%; }
          #spare_pic { height: 300px; width: 100%; }
          #page { padding: 10px; background: #fff; border-radius: 10px; }
          .spare_pic_style { margin: 15px -15px; }
          #spare_use_table { width: 345px; margin: 5px -10px; }
          #item_spare_use {
              padding: 0px!important;
              border: 0px solid #ccc!important;
              width: 170px!important;
              margin: 2px -55px!important;
          }
          .bootstrap-select#item_unit_count .dropdown-menu {
              min-width: 100%;
              -webkit-box-sizing: border-box;
              -moz-box-sizing: border-box;
              box-sizing: border-box;
              width: 342px!important;
          }
          .item_spare_quantity { height: auto!important; padding: 2px!important; font-size: 10px!important; border: 0;}
          .dropdown-toggle::after { right: 0px!important; }
          .dropdown-menu>li>a { padding: 2px 7px!important; }
          #item_spare_use { width: 100px!important; padding: 2px!important; font-size: 9px!important; word-break: break-all; }
          #item_spare_quantity { width: 45px!important; padding: 1px!important; font-size: 10px!important; }
          #item_unit_count {  padding: 2px 0px!important; font-size: 9px!important; }
          td.item_spare_command { padding: 2px!important; }
          #job_detail { font-size: 14px; }
          .dropdown-menu { max-width: 300px; }
          .btn { padding: 2px 3px; }
          #item_spare_use,.filter-option-inner-inner { width: 100px!important; }
          #item_unit_count,.filter-option-inner-inner { width: 40px!important; }
          .bootstrap-select .dropdown-toggle .filter-option-inner-inner { overflow: visible; }
          .bs-searchbox .form-control{ font-size: 12px!important; height: 32px; padding: 1px 2px; text-align: center; }
          .table-bordered>tbody>tr>td { border: 1px solid #ddd; padding: 2px; }
        }

        @media screen and (min-width: 769px) {
          #page { width:40%; margin:0 auto; padding: 15px; background: #fff; border-radius: 10px; }
          small { font-size: 100%; }
          #spare_pic { /*height: 600px;*/ width: 100%; }
          #top-title { font-size: 18px; color: #195f42; }
          .spare_pic_style { margin: 15px -15px; }
          .item_spare_quantity { height: auto; padding: 4px 0px; font-size: 13px; margin: 1.5px auto; border: 0; }
          textarea { font-size: 16px!important; }
          .dropdown-menu { max-width: 325px; }
          .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
              overflow: hidden;
              font-size: 12px;
          }
          .table-bordered>tbody>tr>td { border: 1px solid #ddd; padding: 2px!important; }
        }

        body{
          font-family: 'Poppins', sans-serif;
          background: #fafafa;
          font-size: 12px;
        }
        h4, .h4 {
            font-size: 20px;
        }
        h5, .h5 {
            font-size: 20px;
        }
        .lead {
            font-weight: 300;
            font-size: 19px;
        }
        .btn-lg, .btn-group-lg > .btn {
          padding: 5px 10px;
          font-size: 19px;
          line-height: 1.5;
          border-radius: 0.3rem;
          height: 50px;
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
          width: 500px;
          /* height: 50px;
          line-height: 50px; */
          text-align: center;
          margin:auto;
        }

        .row { margin: -10px!important; }

        input[type="file"]{
          display: none;
        }

        .label{
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

        .form-control-lg {
            height: calc(2.875rem + 2px);
            padding: 5px 10px;
            font-size: 16px!important;
            line-height: 1.5;
            border-radius: 0.3rem;
            height: 40px!important;
        }

        .form-control-sm {
            height: calc(1.8125rem + 2px);
            padding: 5px 12px;
            font-size: 14px;
            line-height: 1.5;
            border-radius: 0.2rem;
            /* height: 35px; */
        }

        .form-control-tech-list {
            height: calc(1.8125rem + 2px);
            padding: 5px 12px;
            font-size: 14px;
            line-height: 1.5;
            border-radius: 0.2rem;
            height: 35px;
        }


        .btn-light {
            color: #212529;
            background-color: #ffffff;
            border-color: #f8f9fa;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #f3f3f3;
            color: #6f6f6f;
            transition: all 0.3s;
        }

        .bootstrap-select>.dropdown-toggle.bs-placeholder,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:active,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
            text-align: left;
            background: #fff;
        }

        .dropdown-menu {
          font-size: 13px;
        }
        .btn-light {
            color: #212529;
            background-color: #ffffff;
            border-color: #f8f9fa;
        }
        .bootstrap-select.form-control-sm .dropdown-toggle {
            padding: 0px;
        }
        .bootstrap-select.form-control-lg .dropdown-toggle {
            padding: 4px;
            border: 1px solid #ccc;
            width: 85px;
        }
        .caret {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 2px;
            vertical-align: middle;
            border-top: 0px dashed;
            border-top: 0px solid\9;
            border-right: 0px solid transparent;
            border-left: 0px solid transparent;
        }
        .head_title_panel { margin-top: -11px; }
        .size-14 { font-size: 14px; }
        .bs-searchbox .form-control{
            margin-bottom: 0;
            width: 100%;
            float: none;
            font-size: 14px;
        }
        .disabled{ cursor: not-allowed; pointer-events: none; }
    </style>

  </head>
  <body>

    <!-- Image loader -->
    <div id='loader' class="preLoad"></div>
    <!-- Image loader -->

   <div class="wrapper" style="display:none;">

     <?php include('nav.php'); ?>

   	<div id="content">

   		<nav class="navbar navbar-expand-lg navbar-light bg-light col-12">

     		<button type="button" id="sidebarCollapse" class="btn btn-light">
     			<i class="fa fa-align-justify"></i> <span></span>
     		</button>

        <div id="top-title" class="mx-auto px-3 py-1 mb-0"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>

        <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>

      </nav>

    <div id="page" class="mr-auto ml-auto">

      <div id="top" class="">
        <div class="col-xs col-sm text-center alert alert-warning show" role="">
          <h4 class="lead mb-0">รายละเอียดใบแจ้งซ่อม</h4>
        </div>
      </div>

      <h5 class="text-center text-danger"><?php echo $_GET['job_code']; ?></h5>

      <div id="body" class="text-center">

<!-- begin for informer -->

           <div class="form-group">
             <div class="spare_pic_style" >
               <img id="spare_pic" src="images/<?php echo $symptom_pic = ($rs->repair_symptom_pic=='' ? $symptom_pic = 'sparepart/' . $rs->spare_code. '.jpg' : $symptom_pic = 'symptom/' . $rs->repair_symptom_pic) ?>"  alt="Spare Pic">
             </div>
           </div>

           <div class="form-group text-left">
             <small for="breakdown" class="text-muted">อุปกรณ์: </small>
             <div class="form-inline">
               <input type="text" class="form-control-sm form-control-plaintext" id="job_name" name="job_name" value="<?php echo $rs->repair_spare_name; ?>" readonly>
               <input type="hidden" name="spare_code" value="<?php echo $rs->spare_code; ?>" />
            </div>
           </div>

           <div class="form-group text-left">
             <small for="breakdown" class="text-muted">สถานที่ติดตั้ง: </small>
             <div class="form-inline">
               <input type="text" class="form-control-sm form-control-plaintext" id="job_spare_location" name="job_spare_location" value="<?php echo $rs->spare_location; ?>" readonly>
            </div>
           </div>

           <div class="form-group text-left">
             <small for="breakdown" class="text-muted">ประเภทงานซ่อม: </small>
             <div class="form-inline">
               <input type="text" class="form-control-sm form-control-plaintext" id="job_type" name="job_type" value="<?php echo $rs->repair_type; ?>" readonly>
            </div>
           </div>

          <?php
          $readonly = '';
          if($u_level=='informer'){
            if($rs->assigner!=''){
              $readonly = 'readonly';
            }else{
              $readonly = '';
            }
          }else{
              $readonly = 'readonly';
          }
          ?>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">อาการเสีย: </small>
            <div class="form-inline">
              <textarea class="form-control-sm form-control-plaintext px-2 py-1" style="width:100%;height:auto;border: 1px solid #eee;" id="job_symptom" name="job_symptom" rows="5" readonly><?php echo $rs->repair_symptom; ?></textarea>
           </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">ผู้แจ้งซ่อม: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_informer" name="job_informer" value="<?php echo $rs->informer_name; ?>" readonly>
           </div>
          </div>

          <div class="form-group text-left mb-5">
            <small for="breakdown" class="text-muted">วันที่แจ้งซ่อม: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_date" name="job_date" value="<?php echo $rs->repair_date; ?>" readonly>
           </div>
          </div>

<!-- end for informer -->

<!-- ******************************************************************************************************************************************************** -->

<?php if($rs->assigner != '') { ?>
<!-- begin job detail for technician -->
          <hr/>

                <div class="form-group row pb-3 text-center">
                  <div class="col-12 head_title_panel">
                    <p class="badge badge-info text-center">ส่วนงานของ PM มอบหมายงาน</p>
                  </div>
                </div>

                <div class="form-group text-left">
                  <small for="breakdown" class="text-muted">กำหนดวันที่ซ่อมเสร็จ: </small>
                  <div class="form-inline">
                    <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->desired_date; ?>" readonly>
                 </div>
                </div>

                <div class="form-group text-left">
                  <small for="breakdown" class="text-muted">กลุ่มช่าง: </small>
                  <div class="form-inline">
                    <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->tech_group; ?>" readonly>
                 </div>
                </div>

                  <div id="internal_tech" class="form-group">
                    <div class="form-group text-left">
                      <small for="breakdown" class="text-muted">ช่างที่รับผิดชอบ: <span class="text-danger">*</span>ช่าง 1 เป็นหัวหน้างาน</small>
                      <div class="form-inline">
                        <p  class="form-control-sm form-control-plaintext mr-1 text-primary"  ><?php echo $rs->tech_leader; ?></p>
                      <?php for ($i = 2;$i <= 5;$i++) { $tech_no = 'tech_'.$i; ?>
                        <p  class="form-control-sm form-control-plaintext mr-1" style="display:<?php if($rs->$tech_no=='') echo 'none'; else 'block'; ?>" ><?php echo $rs->$tech_no; ?></p>
                      <?php } ?>
                     </div>
                    </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ผู้มอบหมายงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->assigner_name; ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left mb-5">
                    <small for="breakdown" class="text-muted">วันที่มอบหมายงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->assign_date; ?>" readonly>
                   </div>
                  </div>



<?php } ?>

<!-- ******************************************************************************************************************************************************** -->

<!-- ช่างรับงาน -->
<?php if($rs->tech_accept != '') { ?>

            <hr/>

                  <div class="form-group row pb-3 text-center">
                    <div class="col-12 head_title_panel">
                      <p class="badge badge-secondary text-center">ส่วนงานของ ช่างที่ได้รับมอบหมายงาน</p>
                    </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ผู้รับงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->tech_accept_name; ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">วันที่รับงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->tech_accept_date; ?>" readonly>
                   </div>
                  </div>


        <?php if($rs->dispatcher != '') { ?>

                  <div class="form-group">
                    <div class="spare_pic_style" >
                      <img id="spare_pic" src="images/<?php echo $repair_pic = ($rs->repair_detail_pic=='' ? $repair_pic = 'sparepart/' . $rs->spare_code. '.jpg' : $repair_pic = 'repair/' . $rs->repair_detail_pic) ?>"  alt="Spare Pic">
                    </div>
                  </div>

                  <?php if($rs->repair_type_by=='EX'){ ?>

                      <!-- ช่างซ่อมจากข้างนอก -->
                        <div class="form-group text-left">
                          <small for="external_company" class="text-muted">ชื่อบริษัท/ร้านซ่อม: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->external_company?>" readonly>
                         </div>
                        </div>

                        <div class="form-group text-left col-sm-6 pull-left pl-0 pr-0 mb-0">
                          <small for="external_tech_leader" class="text-muted">หัวหน้างาน/ช่างซ่อม: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext"  value="<?php echo $rs->external_tech_leader?>" readonly >
                         </div>
                        </div>

                        <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                          <small for="external_phone" class="text-muted">เบอร์ติดต่อ: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->external_phone?>" readonly>
                         </div>
                        </div>
                      <!-- End ช่างซ่อมจากข้างนอก -->

                  <?php } ?>

                  <div class="form-group text-left" style="clear:both;">
                    <div class="form-group text-left">
                      <small for="breakdown" class="text-muted">รายละเอียดการซ่อม: </small>
                      <div class="form-inline">
                        <textarea class="form-control-sm form-control-plaintext px-2 py-1" rows="10" readonly style="width:100%;height:auto;border: 1px solid #eee;"><?php echo $rs->repair_detail; ?></textarea>
                     </div>
                    </div>
                    <div class="form-group text-left">
                      <small for="spare_use_table" class="text-muted">อะไหล่ที่ใช้: </small>
                      <table class="table w-100">
                        <tbody>
                          <tr class="warning">
                            <th class="text-center"></th>
                            <th>ชื่ออะไหล่</th>
                            <th class="text-right">จำนวน</th>
                            <th class="text-right"></th>
                          </tr>
                          <?php
                            $html = '';
                            $no = 1;
                            $sql = "  SELECT *,
                                      (SELECT CONCAT(s.spare_sub_code,' ',s.spare_sub_name_th) FROM tbl_sparepart_sub s WHERE s.spare_sub_code = spare_use) as spare_name,
                                      (SELECT u.unit_name FROM tbl_unit_count u WHERE u.unit_code = unit_count) as unit_name
                                      FROM tbl_job_spare_use
                                      WHERE job_code = '$job_code' ";

                                      $result = $mysqli->query($sql);

                                      if($result->num_rows > 0){

                                        while ($row = $result->fetch_object()) {
                                          if($row->spare_use=='NO'){
                                            $html = "<tr>";
                                            $html .= "<td class='text-center size-14' colspan='4'>ไม่มี</td>";
                                            $html .="</tr>";
                                          }else{
                                            $html .= "<tr>";
                                            $html .= "<td class='text-center'>".$no."</td>";
                                            $html .="<td class='text-left'>".$row->spare_name."</td>";
                                            $html .="<td class='text-right'>".$row->spare_quantity."</td>";
                                            $html .="<td style='vertical-align: middle;' class='item_spare_command text-right'>".$row->unit_name."</td>";
                                            $html .="</tr>";
                                            $no++;
                                          }
                                        }
                                      }else{
                                        $html .= "<tr>";
                                        $html .= "<td class='text-center size-14' colspan='4'>ไม่มี</td>";
                                        $html .="</tr>";
                                      }

                            echo $html;
                          ?>

                        </tbody>
                      </table>
                     </div>
                    </div>
                  <!-- </div> -->

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ความพร้อมของอะไหล่: </small>
                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->wait_sparepart=='N' ? 'ไม่รอ':'รออะไหล่' ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="pr_no" class="text-muted">สั่งซื้อวัสดุ เลขที่ใบสั่งซื้อ(PR/PO):</small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->pr_no; ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                    <small for="breakdown" class="text-muted">วันที่และเวลา เข้าซ่อม: </small>
                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->working_day; ?>" readonly>
                   </div>
                  </div>
                  <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                    <small for="breakdown" class="text-muted">วันที่และเวลา ซ่อมเสร็จ: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->working_day_stop; ?>" readonly>
                   </div>
                  </div>
                  <div class="form-group text-left" style="clear:both;">
                    <small for="breakdown" class="text-muted">ใช้เวลาในการซ่อมทั้งหมด: </small>
                    <div class="form-inline">
                      <?php

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

                        //------------------------------ ตัวอย่างการใช้งาน
                        $h = '';
                        $m = '';
                        $t1 = $rs->working_day;
                        $t2 = $rs->working_day_stop;

                        if($t2 != '0000-00-00 00:00:00'){

                          $time=dateDiv($t1,$t2);
                          // print_r($time);
                          if($time['H'] != '0') { $h = $time['H'].' ชั่วโมง '; }
                          if($time['M'] != '0') { $m = $time['M'].' นาที '; }

                        }

                          echo '<input type="text" class="form-control-sm form-control-plaintext" value="'.$h.$m.'" readonly>';

                      ?>
                   </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ผู้บันทึก/ผู้ส่งงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->tech_accept_name; ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left mb-5">
                    <small for="breakdown" class="text-muted">วันที่ซ่อมเสร็จ(ส่งงาน): </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->repair_finished_date; ?>" readonly>
                   </div>
                  </div>

            <?php
              if($rs->inspector != ''){
            ?>
                <hr/>

                   <div class="form-group row pb-3 text-center">
                     <div class="col-12 head_title_panel">
                       <p class="badge badge-primary text-center">ส่วนงานของ ผู้ตรวจรับงาน</p>
                     </div>
                   </div>
              <!-- ซ่อนไว้ก่อน ยังไม่ได้ใช้งาน -->
                <div style="display:none;">
                   <div class="form-group text-left">
                     <small for="breakdown" class="text-muted">หยุดเดินเครื่อง เมื่อ: </small>
                     <div class="form-inline">
                       <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->repair_breakdown_stop; ?>" readonly>
                    </div>
                   </div>

                   <div class="form-group text-left">
                     <small for="breakdown" class="text-muted">เริ่มเดินเครื่อง เมื่อ: </small>
                     <div class="form-inline">
                       <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->repair_breakdown_start; ?>" readonly>
                    </div>
                   </div>

                   <div class="form-group text-left">
                     <small for="breakdown" class="text-muted">รวมเวลา Breakdown: </small>
                     <div class="form-inline">
                       <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->repair_breakdown_time; ?>" readonly>
                    </div>
                   </div>
                </div>
              <!-- ซ่อนไว้ก่อน ยังไม่ได้ใช้งาน -->
                   <div class="form-group text-left">
                     <small for="breakdown" class="text-muted"><?php echo (($rs->status == 'In_progress' || $rs->status == 'Wait_to_check') && $rs->dispatcher != '' ? 'รอตรวจงาน/แก้งาน' : 'ปิดงานโดย'); ?></small>
                     <div class="form-inline">
                       <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->inspector_name; ?>" readonly>
                    </div>
                   </div>

                   <div class="form-group text-left">
                     <small for="breakdown" class="text-muted">วันที่บันทึก: </small>
                     <div class="form-inline">
                       <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs->close_job_date; ?>" readonly>
                    </div>
                   </div>

                    <div id="reject_panel" class="form-group text-left">
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">ความเห็น:</small>
                        <div class="form-inline">
                          <textarea class="form-control-sm form-control-plaintext w-100 px-2 py-1" style="width:100%;height:auto;border: 1px solid #eee;" rows="5" readonly><?php echo $rs->note; ?></textarea>
                       </div>
                      </div>
                    </div>

                  <?php } ?>
                  <!-- มีการตรวจรับงานแล้ว -->
        <?php } ?>
        <!-- เมื่อมีการกดส่งงานแล้ว -->

<?php } ?><!-- จบช่างรับงาน -->

          <?php
            $bg = '';
            $status = $rs->status;
            if($status == 'Wait_to_check') { $status = 'รอตรวจงาน'; $bg = 'primary'; }
            if($status == 'Wait_assignment') { $status = 'รอ PM หมอบหมายงาน'; $bg = 'warning'; }
            if($status == 'Wait_technician') { $status = 'รอช่างรับงาน'; $bg = 'warning'; }
            if($status == 'In_progress') { $status = 'กำลังดำเนินงาน'; $bg = 'info'; }
            if($status == 'Active') { $status = 'พร้อมใช้งาน'; $bg = 'success'; }
          ?>

          <div class="form-group text-left py-4 " style="text-align:center!important;">
            <small for="breakdown" class="text-muted">สถานะปัจจุบัน:</small>
            <div class="py-2">
              <p class="badge badge-<?php echo $bg ?> px-3 py-2 w-50p" style="font-size:14px;border-radius: 15px;"><strong><?php echo $status; ?></strong></p>
           </div>
          </div>

          <!-- <hr/> -->

<!-- end job detail for technician -->

<!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** -->

                            <!-- FOR Control -->
<!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** --><!-- ******************************************************************************************************************************************************** -->
<!-- ******************************************************************************************************************************************************** -->


<!-- begin for assignment -->
<?php

  if($u_level == 'assignment' && $rs->status=='Wait_assignment'){

?>
        <hr/>
              <div id="assignment_control">

                <div class="form-group row">
                  <div class="col-12 pb-3 head_title_panel">
                    <p class="badge badge-info text-center">ส่วนงานของ PM </p>
                  </div>
                </div>

                <form id="frm_assign_update_job" name="frm_assign_update_job" method="post">

                  <input type="hidden" name="job_code" value="<?php echo $_GET['job_code']; ?>" />
                  <input type="hidden" name="spare_code" value="<?php echo $rs->spare_code; ?>" />
                  <input type="hidden" name="username" value="<?php echo $emp_code; ?>" />
                  <input type="hidden" name="repair_type_by" id="repair_type_by" value="" />

                    <div class="form-group text-left">
                      <small for="desired_date" class="text-muted">กำหนดวันซ่อมเสร็จ: <span class="text-danger">*</span></small>
                      <div class="form-inline">
                        <input type="text" class="form-control-lg form-control text-center mr-1 w-100" id="desired_date" name="desired_date" value="" placeholder="ระบุวันที่ซ่อมเสร็จ" >
                     </div>
                    </div>

                    <div class="form-group text-left">
                      <small for="breakdown" class="text-muted">กลุ่มช่าง: <span class="text-danger">*</span></small>
                      <div class="form-inline">
                        <select class="form-control-lg form-control w-100 " id="tech_group_pick" name="tech_group">
                          <option value=""> --- ระบุกลุ่มช่าง --- </option>
                          <?php
                            $sql = "SELECT *
                                    FROM tbl_tech_type
                                    WHERE status = 'Active'
                                    ORDER BY tech_type_name ASC
                                    ";

                                    $result = $mysqli->query($sql);
                                    while ($rs1 = $result->fetch_object()) {
                                      echo '<option value="'.$rs1->tech_type_code.'">'.$rs1->tech_type_name.'</option>';
                                    }//end while
                          ?>
                        </select>
                     </div>
                    </div>

                    <!-- In internal_tech -->
                    <div id="internal_tech" class="form-group" style="display:none;">

                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">ช่างที่รับผิดชอบ: <span class="text-danger">*</span></small>
                        <div id="tech_type_panel">
                          <?php for ($i = 1;$i <= 5;$i++) { ?>
                            <select class="form-control-tech-list form-control w-100 mb-2 techname "
                             id="tech_<?php echo $i ?>" name="tech_<?php echo ($i=='1')? 'leader':$i; ?>" onchange="check_tech_same(this)" <?php echo ($i > 1)? 'disabled':''; ?>>
                              <option value="">ไม่ระบุ</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>

                    </div>
                    <!-- End internal_tech -->

                    <button type="button" id="assign_save" class="btn btn-lg btn-success my-5 w-100" style="display:block">บันทึก</button>


                </form>

              </div>

          <?php } ?>
<!-- end for assignment -->

<!-- ******************************************************************************************************************************************************** -->

<!-- begin for technician -->
          <?php if($u_level == 'technician'){ ?>

              <div id="technician_control">

              <?php if($rs->status=='Wait_technician' || $rs->status=='In_progress'){ ?>

                <hr/>

                  <div class="form-group row">
                    <div class="col-12 pb-3 head_title_panel">
                      <p class="badge badge-secondary text-center">ส่วนงานของ ช่างซ๋อม </p>
                    </div>
                  </div>

                <?php } ?>

              <!-- ช่างภายใน -->

                <form name="frm_tech_update_job" id="frm_tech_update_job">

                  <input type="hidden" name="job_code" id="job_code" value="<?php echo $_GET['job_code']; ?>" />
                  <input type="hidden" name="username" value="<?php echo $emp_code; ?>" />
                  <input type="hidden" name="spare_code" id="spare_code" value="<?php echo $rs->spare_code; ?>" />
                  <input type="hidden" name="ex_tech" id="ex_tech" value="<?php echo $rs->repair_type_by; ?>" />

                  <?php if($rs->status=='Wait_technician'){ ?>

                    <input type="hidden" name="event" id="event" value="accept_job" />
                    <button type="button" id="tech_accept" class="tech_save btn btn-lg btn-danger my-5 w-100" style="display:block">รับงาน</button>

                  <?php }else if($rs->status=='In_progress'){ ?>

                    <input type="hidden" name="event" id="event" value="<?php if($rs->wait_sparepart != 'Y'){ echo 'send_job'; }else{ echo 'save_job'; } ?>" />

                        <!-- Begin Table รายการอะไหล่ที่ใช้ซ่อม -->
                        <div class="form-group mb-0 text-left">
                          <div class="mt-3">
                            <small for="sparepart_use" class="text-muted">รายการอะไหล่ที่ใช้ซ่อม (เบิกจากสโตร์)</small>
                          </div>
                        </div>

                        <div class="text-center " >
      										 <table class="table table-bordered" id="spare_use_table">
      												 <tr class="warning">
      														 <th width="">อะไหล่</th>
      														 <th width="45px" class="text-center">จำนวน</th>
                                   <th width="35px">หน่วย</th>
      														 <th width="2px"></th>
      												 </tr>
      												 <tr>
      														 <td class="px-0 py-2" >
                                     <select class="form-control selectpicker item_spare_use" id="item_spare_use" name="spare_use" data-live-search="true" title=" --- ระบุอะไหล --- ">
                                       <option value="NO">ไม่มี</option>
                                       <?php
                                              // $sql = "SELECT * FROM tbl_sparepart_sub WHERE status = 'Active' ORDER BY spare_sub_name_th ASC";
                                               // $result = $mysqli->query($sql);
                                               // while ($rs1 = $result->fetch_object()) {
                                               //   echo '<option value="'.$rs1->spare_sub_code.'" >'.$rs1->spare_sub_code.' - '.$rs1->spare_sub_name_th.'</option>';
                                               // }//end while
                                       ?>

                                       <?php
                                       //Connect SQLSERVER ที่เครื่อง Cosmic ที่ตาราง ViewProducts
                                         try{
                                           $conn = new PDO( "sqlsrv:Server=192.168.1.100,1433;Database=ComPDS", "sa", "sa@m1n");
                                           $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                                         }
                                         catch(Exception $e)
                                         {
                                           die( print_r( $e->getMessage()));
                                         }

                                         $tsql = "SELECT * FROM vProduct WHERE ProdGroup = 'G1-PART'";
                                         $getRS = $conn->prepare( $tsql );
                                         $getRS->execute();
                                         $results = $getRS->fetchAll(PDO::FETCH_BOTH);
                                         $count = $getRS->rowCount();
                                         $html = '';

                                         foreach($results as $row){
                                           $html .= '<option value="'.trim($row['ProdCode']).'" >'.trim($row['ProdCode']).' - '.trim($row['ProdTHname']).'</option>';
                                         }
                                         echo $html;
                                        ?>

                                     </select>
                                   </td>
      														 <td class="px-0 py-2">
                                    <div class="item_spare_panel invisible">
                                      <input type="text" class="form-control mr-1 text-center item_spare_quantity" id="item_spare_quantity" size="10" name="spare_quantity" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                    </div>
                                   </td>
                                   <td class="px-0 py-2 text-center">
                                    <div class="item_spare_panel invisible">
                                     <select class="form-control selectpicker item_unit_count" id="item_unit_count" name="unit_count" data-live-search="true" title="">
                                       <?php $sql = "SELECT * FROM tbl_unit_count WHERE status = 'Active' ORDER BY unit_name ASC";
                                               $result = $mysqli->query($sql);
                                               while ($rs1 = $result->fetch_object()) {
                                                 ($rs1->unit_code=='EA')?$selected = 'selected':$selected = '';
                                                 echo '<option value="'.$rs1->unit_code.'" '.$selected.'>'.$rs1->unit_name.'</option>';
                                               }//end while
                                       ?>
                                     </select>
                                   </div>
                                   </td>
      														 <td style="vertical-align: middle;" class="px-0 py-2 item_spare_command"></td>
      												 </tr>
      										 </table>
      									<!-- End Table รายการอะไหล่ที่ใช้ซ่อม -->
                      </div>

                    <div class="form-group hidden" id="btn_add_command">
                      <div class="text-right pr-0">
                          <button type="button" name="add" id="add" class="btn btn-success btn-xs">เพิ่ม</button>
                      </div>
                    </div>

                    <div class="form-group text-left">
                      <small for="wait_sparepart" class="col-form-label text-muted py-0">ความพร้อมของอะไหล่</small>
                      <select class="form-control-lg form-control w-50" id="wait_sparepart" name="wait_sparepart">
                        <option value="N" <?php if ($rs->wait_sparepart == 'N' ){ echo 'selected'; } ?>>ไม่รอ</option>
                        <option value="Y" <?php if ($rs->wait_sparepart == 'Y' ){ echo 'selected'; } ?>>รออะไหล่</option>
                      </select>
                    </div>

                    <div class="form-group text-left wait_spare" >
                      <small for="pr_no" class="text-muted">สั่งซื้อวัสดุ เลขที่ใบสั่งซื้อ(PR/PO):</small>
                      <div class="form-inline">
                        <input type="text" class="form-control-lg form-control col-12 mr-1" id="external_pr_no" name="pr_no" value="<?php echo $rs->pr_no; ?>" placeholder="ระบุหมายเลขใบสั่งซื้อ(PR/PO) ถ้ามี">
                     </div>
                    </div>

                    <div class="not_wait_spare">
                         <img id="imgAvatar" style="max-width:100%; height:auto;">
                    </div>

                    <div class="form-group not_wait_spare">
                      <label for="image_file" class="label">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;&nbsp;เลือกรูปซ่อมเสร็จแล้ว
                      </label>
                         <input type="file" name="image_file" id="image_file" onchange="showPreview(this)" />
                         <span class="help-block">ประเภทไฟล์ภาพ - jpg, jpeg เท่านั้น</span>
                    </div>

                <?php if($rs->repair_type_by=='EX'){ ?>

                    <!-- ช่างซ่อมจากข้างนอก -->
                      <div class="form-group text-left">
                        <small for="external_company" class="text-muted">ชื่อบริษัท/ร้านซ่อม: <span class="text-danger">*</span></small>
                        <div class="form-group">
                          <input type="text" class="form-control-lg form-control mr-1" id="external_company" name="external_company" value="<?php echo $rs->external_company; ?>" placeholder="ระบุชื่อบริษัท" >
                       </div>
                      </div>

                      <div class="form-group text-left">
                        <small for="external_tech_leader" class="text-muted">หัวหน้างาน/ช่างซ่อม: <span class="text-danger">*</span></small>
                        <div class="form-group">
                          <input type="text" class="form-control-lg form-control mr-1" id="external_tech_leader" name="external_tech_leader" value="<?php echo $rs->external_tech_leader; ?>" placeholder="ระบุชื่อหัวหน้างาน/ช่างซ่อม" >
                       </div>
                      </div>

                      <div class="form-group text-left">
                        <small for="external_phone" class="text-muted">เบอร์ติดต่อ: <span class="text-danger">*</span></small>
                        <div class="form-group">
                          <input type="text" class="form-control-lg form-control mr-1" id="external_phone" name="external_phone" value="<?php echo $rs->external_phone; ?>" placeholder="เบอร์โทรศัพท์" >
                       </div>
                      </div>
                    <!-- End ช่างซ่อมจากข้างนอก -->

                <?php } ?>

                    <div id="reject_panel" class="form-group text-left" style="display:block;">
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">รายละเอียดการซ่อม:  <span class="text-danger">*</span></small>
                        <div class="form-inline" >
                          <textarea class="form-control" id="job_detail" name="job_detail" style="width:100%; height:auto;" rows="10" placeholder="โปรดระบุรายละเอียดการซ่อมให้ชัดเจน"><?php echo $rs->repair_detail; ?></textarea>
                       </div>
                      </div>
                    </div>

                    <div class="not_wait_spare">
                      <div class="form-group text-left ">
                        <small for="breakdown" class="text-muted">วันที่และเวลา เข้าซ่อม: <span class="text-danger">*</span></small>
                        <div class="form-inline">
                          <input type="text" class="form-control-lg form-control col-12 mr-1" id="working_day" name="working_day" value="<?php echo $rs->working_day; ?>" >
                       </div>
                      </div>
                      <div class="form-group text-left ">
                        <small for="breakdown" class="text-muted">วันที่และเวลา ซ๋อมเสร็จ: <span class="text-danger">*</span></small>
                        <div class="form-inline">
                          <input type="text" class="form-control-lg form-control col-12 mr-1" id="working_day_stop" name="working_day_stop" value="<?php echo $rs->working_day_stop; ?>" >
                       </div>
                      </div>
                    </div>

                    <button type="button" id="tech_save" class="tech_save btn btn-lg <?php if($rs->wait_sparepart!='Y'){ echo 'btn-success'; }else{ echo 'btn-warning'; } ?> my-5 w-100">
                      <?php if($rs->wait_sparepart!='Y'){ echo 'ส่งงาน'; }else{ echo 'บันทึก'; } ?></button>

                  <?php } ?>

                </form>


              </div>

            <?php } ?>
<!-- end for technician -->

<!-- ******************************************************************************************************************************************************** -->

<!-- begin for informer -->
          <?php if($u_level == 'informer' AND $rs->status=='Wait_to_check'){ ?>
            <hr/>

              <div id="infermer_control">

                <div class="form-group row pb-5 text-center">
                  <div class="col-12 head_title_panel">
                    <p class="badge badge-info text-center">ส่วนงานของ ผู้ตรวจงาน หรือ ผู้แจ้ง </p>
                  </div>
                </div>

                  <form name="frm_inf_update_job" id="frm_inf_update_job">

                    <input type="hidden" name="job_code" value="<?php echo $_GET['job_code']; ?>" />
                    <input type="hidden" name="username" value="<?php echo $emp_code; ?>" />
                    <input type="hidden" name="spare_code" value="<?php echo $rs->spare_code; ?>" />

                    <div class="custom-control custom-checkbox text-left mb-3">
                      <input type="checkbox" class="custom-control-input" id="breakdown" name="breakdown" onclick="getChecked()">
                      <label class="custom-control-label" for="breakdown">Breakdown</label>
                    </div>

                    <div id="breakdown_panel" class="mt-2" style="display:none;">
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">หยุดเครื่องเมื่อ: </small>
                        <div class="form-inline">
                          <input type="text" class="form-control col-12 text-center mr-1" id="breakdown_stop" name="breakdown_stop">
                        </div>
                      </div>
                      <div class="form-group text-left">
                        <small for="job_symptom" class="text-muted">เดินเครื่องเมื่อ: </small>
                        <div class="form-inline">
                        <input type="text" class="form-control col-12 text-center mr-1" id="breakdown_start" name="breakdown_start">
                      </div>
                      </div>
                    </div>

                    <div class="form-group text-left">
                        <small for="select_job" class="text-muted">เลือกงาน: </small>
                      <select class="form-control-lg form-control w-50" id="select_job" name="select_job">
                        <option value="accept" selected>ปิดงาน</option>
                        <option value="reject">ปฏิเสธ</option>
                      </select>
                    </div>

                  <div id="reject_panel" class="form-group text-left" >
                    <small for="breakdown" class="text-muted">ความเห็น: </small><span class="text-danger">*</span></label>
                    <textarea class="form-control-sm form-control" id="note" name="note" rows="5" placeholder="กรุณาระบุความคิดเห็น ไม่ว่าจะปิดงานซ่อม หรือ ปฏิเสธงาน ครับ!"><?php echo $rs->note; ?></textarea>
                  </div>

                  <button type="button" id="inf_save" class="btn btn-lg btn-success my-5 w-100" style="display:block">บันทึก</button>

                </form>

              </div>
          <?php } ?>
<!-- end for infermer -->

<!-- ******************************************************************************************************************************************************** -->

      </div>
      <!-- End body Div -->

        <?php
          $result->free();
          $mysqli->close();
        ?>

        <hr/>
          <!-- bottom panel       -->
          <div id="bottom" class="">
            <div class="text-center mb-5">
              <button type="button" id="<?php echo $_GET['job_code']; ?>" class="btn btn-info btn-lg btn_view_repair">
                ดูในรูปแบบฟอร์ม ISO
              </button>
            </div>
          </div>

     	</div>
      <!-- End page Div -->

    </div>
    <!-- End content Div -->

  </div>
  <!-- End Wrapper -->


  </body>
</html>


<script>

  $(document).ready(function(){

    $('.wrapper').fadeIn('slow');

    $('.wait_spare').css('display', 'none');

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



// technicain รับงานซ๋อมและส่งงาน
        $('.tech_save').click(function(){

          var formData = new FormData($('#frm_tech_update_job')[0]);
          var image_file = $('#image_file');
          var external_company = $('#external_company');
          var external_tech_leader = $('#external_tech_leader');
          var working_day = $('#working_day');
          var working_day_stop = $('#working_day_stop');
          var job_detail = $('#job_detail');
          var wait_sparepart = $('#wait_sparepart');
          var pr_no = $('#pr_no');
          var ex_tech = $('#ex_tech');
          var item_spare_use = $('#item_spare_use');
          var item_spare_quantity = $('#item_spare_quantity');
          var arr_job_code = [];
          var arr_spare_use = [];
          var arr_spare_quantity = [];
          var arr_unit_count = [];

          // if(item_spare_use.val() == ''){
          //     console.log(item_spare_use.val());
          //     alert('ยังไม่ได้ระบุอะไหล่!');
          //     item_spare_use.focus();
          //     return false;
          // }

            $('.item_spare_use').each(function(){
              console.log(this.value);
              if(this.value == ''){
                alert('ยังไม่ได้ระบุอะไหล่!!!');
                this.focus();
                return false;
              }

            });

          if(ex_tech.val() == 'EX'){

              if(external_company.val() == ''){
                  alert('ยังไม่ได้ระบุบริษัท/ร้านซ่อม/ผู้ให้บริการ!');
                  external_company.focus();
                  return false;
              }
              if(external_tech_leader.val() == ''){
                  alert('ยังไม่ได้ระบุชื่อช่าง!');
                  external_tech_leader.focus();
                  return false;
              }

          }

          if(wait_sparepart.val() == 'N'){
            console.log(working_day.val());
            if(image_file.val() == ''){
              alert('กรุณาเลือกรูปภาพซ่อมเสร็จแล้ว');
              image_file.focus();
              return false;
            }

            if(working_day.val() == '0000-00-00 00:00:00' || working_day.val() == '____-__-__ __:__'){
                alert('ยังไม่ได้ระบุวันที่และเวลา เข้าซ่อม!');
                working_day.focus();
                return false;
            }
            if(working_day_stop.val() == '0000-00-00 00:00:00' || working_day_stop.val() == '____-__-__ __:__'){
                alert('ยังไม่ได้ระบุวันที่และเวลา ซ่อมเสร็จ!');
                working_day_stop.focus();
                return false;
            }

          }

            if(job_detail.val() == ''){
                alert('ยังไม่ได้ระบุรายละเอียดการซ่อม!');
                job_detail.focus();
                return false;
            }

            $('.item_spare_quantity').each(function(){        //วนลูป attribute <td> ที่มี class = .item_product ทุกตัว
                arr_job_code.push($('#job_code').val());     //ใส่ค่าข้อความที่อยู่ใน <td> ลงไปใน array ชื่อ item_product
            });
            $('.item_spare_use').each(function(){        //วนลูป attribute <td> ที่มี class = .item_product ทุกตัว
                  if($(this).val() != ''){
                    arr_spare_use.push($(this).val());     //ใส่ค่าข้อความที่อยู่ใน <td> ลงไปใน array ชื่อ item_product
                  }
            });
            $('.item_spare_quantity').each(function(){        //วนลูป attribute <td> ที่มี class = .item_product ทุกตัว
                arr_spare_quantity.push($(this).val());     //ใส่ค่าข้อความที่อยู่ใน <td> ลงไปใน array ชื่อ item_product
            });
            $('.item_unit_count').each(function(){        //วนลูป attribute <td> ที่มี class = .item_product ทุกตัว
                if($(this).val() != ''){
                  arr_unit_count.push($(this).val());     //ใส่ค่าข้อความที่อยู่ใน <td> ลงไปใน array ชื่อ item_product
                }
            });

            dataObj = {  arr_job_code: arr_job_code, arr_spare_use: arr_spare_use, arr_spare_quantity: arr_spare_quantity, arr_unit_count: arr_unit_count };
            //เพิ่ม dataObj jsonstring เข้าไปใน formData
            formData.append('other_data',JSON.stringify(dataObj));

            console.log(formData);

            $.ajax({
              url: 'tech_update_job.php',
              type: 'POST',
              data: formData,
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function(){
                //Show image container
                $("#loader").show();
                $("#wrapper").hide();
                // console.log('Befor Send');
              },
               success: function(data){
                  console.log(data);
                  if(data=='OK_ACCEPT'){
                    // window.history.back();
                  }
                  if(data=='OK_SAVE'){

                    // window.history.back();
                  }
                  if(data=='OK_SEND'){
                    // window.location.href = '../webapp/my_job.php'; //Will take you to Google.
                    // window.history.back();
                  }
                  window.history.back();
               },
               complete:function(data){
                // Hide image container
                $("#loader").hide();
                $("#wrapper").show();
               }

             });

        });


  // assigner มอบหมายงาน
        $('#assign_save').click(function(){

          var desired_date = $('#desired_date');
          var tech_group = $('#tech_group_pick');
          var tech_leader = $('#tech_leader option:selected');
          var formData = $("#frm_assign_update_job").serialize();

          console.log(desired_date.val());

          if(desired_date.val() == '' || desired_date.val() == '____-__-__ __:__'){

            alert("โปรดระบุวันที่ซ่อมเสร็จ!");
            desired_date.focus();
            return false;
          }

          if(tech_group.val() == ''){

            alert("โปรดระบุกลุ่มช่าง!");
            tech_group.focus();
            return false;

          }

          if(tech_group.val() != 'TOUT'){

            if(tech_leader.val() == ''){
              alert("ยังไม่ได้ระบุหัวหน้าช่าง!");
              tech_leader.focus();
              return false;
            }

          }

            $.ajax({
              url: 'assign_update_job.php',
              method: 'post',
              data: formData,
              beforeSend: function(){
                //Show image container
                $("#loader").show();
                $("#wrapper").hide();
                // console.log('Befor Send');
              },
               success: function(data){
                // $('.response').empty();
                // $('.response').append(response);
                console.log(data);
                if(data=='OK_UPDATE'){
                  window.location.href = '../webapp/my_job.php'; //Will take you to Google.
                }else{
                  alert('ERROR:: '+data);
                }
               },
               complete:function(data){
                // Hide image container
                $("#loader").hide();
                $("#wrapper").show();
               }

            });


        });

        // $('#job_symptom').on('blur',function(){
        // 	$('#sidebar').toggleClass('active');
        // });

  // infermer ตรวจงาน
        $('#inf_save').click(function(){

          var formData = $("#frm_inf_update_job").serialize();
          var msg = '';
          var note = $('#note');
          var e = $('#select_job');

          e.val() == 'reject' ? msg = 'บันทึกข้อมูลเรียบร้อย' : msg = 'ปิดงานซ่อมเรียบร้อย';

          if(note.val() == ''){
            alert("รุบุความเห็นก่อน !");
            note.focus();
            return false;
          }

                $.ajax({
                  url: 'infor_update_job.php',
                  method: 'post',
                  data: formData,
                  beforeSend: function(){
                    //Show image container
                    $("#loader").show();
                    $("#wrapper").hide();
                  },
                   success: function(data){
                    // $('.response').empty();
                    // $('.response').append(response);
                    console.log(data);
                    if(data=='OK_UPDATE'){
                      alert(msg);
                      window.location.href = '../webapp/my_job.php'; //Will take you to Google.
                    }else{
                      alert('ERROR:: '+data);
                    }
                   },
                   complete:function(data){
                    // Hide image container
                    $("#loader").hide();
                    $("#wrapper").show();
                   }

                });

        });

        $('#desired_date').datetimepicker({ format:'Y-m-d', mask:true, lang: 'th', timepicker:false });
        $('#working_day, #working_day_stop, #breakdown_stop, #breakdown_start').datetimepicker({
          format:'Y-m-d H:i',
          mask:true,  // mask:'9999-19-39 29:59',
          lang: 'th',
          // minDate:0,//yesterday is minimum date(for today use 0 or -1970/01/01)-1970/01/02
          // maxDate:'tomorrow',//tomorrow is maximum date calendar +1970/01/02
          step:10
        });

        $(document).on('click', '.btn_view_repair', function(){

          var repair_code = this.id;
          console.log(repair_code);
          var part = '../webapp/p_pm_print_job_repair_report.php?repair_code='+repair_code;
          // window.location = part;
          window.open(part, '_blank');

        });

        $('#tech_group_pick').on('change', function() {
          // console.log(data);
          var tech_group = $("#tech_group");
          var internal_tech = $("#internal_tech");
          var repair_type_by = $("#repair_type_by");

          console.log(this.value);
          // If the checkbox is checked, display the output text
            if(this.value == ''){
              repair_type_by.val('');
              internal_tech.fadeOut(200);
            }else if(this.value == 'TOUT'){
              repair_type_by.val('EX');
              internal_tech.fadeIn();
            }else{
              repair_type_by.val('IN');
              internal_tech.fadeIn();
            }

              $.ajax({
                  type: "POST",
                  url: "get_tech_type.php",
                  data: { tech_code: this.value },
                  success: function(result) {
                    // console.log(result);
                    for(i = 0; i <= 5; i++) {
                      var tech = '<select class="form-control-sm form-control w-100 mb-2 " id="tech_'+i+'" name="tech_'+i+'" onchange="check_tech_same(this)">'+result+'</select>';
                      $('.techname').html(tech);
                    }

                  }
              });
            tech_group.val($(this).find('option:selected').text());

        });


        $('#wait_sparepart').on('change', function() {

          var btn_tech_save = $('#tech_save');
          var e = $('#event');

          if(this.value == 'Y'){

            e.val('save_job');
            btn_tech_save.text('บันทึก');
            btn_tech_save.removeClass('btn-success').addClass('btn-warning');

            $('.wait_spare').each(function(){
              $(this).fadeIn(300);
            });
            $('.not_wait_spare').each(function(){
              $(this).fadeOut(300);
            });

          }else{

            e.val('send_job');
            btn_tech_save.text('ส่งงาน');
            btn_tech_save.removeClass('btn-warning').addClass('btn-success');

            $('.wait_spare').each(function(){
              $(this).fadeOut(300);
            });
            $('.not_wait_spare').each(function(){
              $(this).fadeIn(300);
            });

          }


        });

        $('#item_spare_use').on('change', function(){
          // console.log($(this).val());
          if( $(this).val() != 'NO' && $(this).val() != '' ){
            $('.item_spare_panel').removeClass("invisible");
            $('.item_spare_quantity').val(1);
            $('.item_spare_quantity').select();
            $('#btn_add_command').removeClass("hidden");
          }else{
            $('.item_spare_panel').addClass("invisible");
            $('.item_spare_quantity, .item_unit_count').val('');
            $('#btn_add_command').addClass("hidden");
          }

        });

        $('#select_job').on('change', function() {

          var btn_inf_save = $('#inf_save');
          var note = $('#note');

          if(this.value == 'reject'){
            btn_inf_save.text('บันทึก');
            btn_inf_save.removeClass('btn-success').addClass('btn-warning');
          }else{
            btn_inf_save.text('ปิดงานซ่อม');
            btn_inf_save.removeClass('btn-warning').addClass('btn-success');
          }
          note.focus();

        });


        // Function เพิ่มอะไหล่ที่ซ่อม
            var count = 1;
            var action = "select";
            var data = '';

            $('#add').click(function(){       //เมื่อคลิกที่ปุ่ม add
                count++;                        //เพิ่มค่า count ขึ้น 1 ค่า

                $.ajax({
                    type: "POST",
                    url: "get_spare_use.php",
                    success: function(result) {
                      // console.log(result);
                      $('#item_spare_use'+count).append(result);
                      $(".selectpicker").selectpicker('refresh');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "get_unit_count.php",
                    success: function(result1) {
                      // console.log(result1);
                      $('#item_unit_count'+count).append(result1);
                      $(".selectpicker").selectpicker('refresh');
                    }
                });

                    var html_code = "<tr id='row"+count+"'>";                               //ค่า tr แถวต่อไปมีค่าเท่ากับ row+count(row2)
                      html_code += "<td contenteditable='true'>";
                      html_code += "<select class='form-control selectpicker item_spare_use' id='item_spare_use"+count+"' name='spare_use' onchange='check_spare_same(this);' data-live-search='true' title=' --- ระบุอะไหล --- '>";
                      html_code += "</select></td>";
                      html_code += "<td contenteditable='true'>";
                      html_code += "<input type='text' class='form-control mr-1 text-center item_spare_quantity' id='spare_quantity"+count+"' size='10' name='spare_quantity' value='1' OnKeyPress='return chkNumber(this);' >";
                      html_code += "</td>";
                      html_code += "<td contenteditable='true'>";
                      html_code += "<select class='form-control w-100 selectpicker item_unit_count' id='item_unit_count"+count+"' name='unit_count' data-live-search='true' title=''>";
                      html_code += "</select></td>";
                      html_code += "<td style='vertical-align: middle;' class='item_spare_command'><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove' >ลบ</button></td>";
                      html_code += "</tr>";
                      $('#spare_use_table').append(html_code);
                      $(".selectpicker").selectpicker('refresh');



            });

            //เหตุการเมื่อกดปุ่มลบแถว
            $(document).on('click','.remove', function(){
                var delete_row = $(this).data("row");
                // console.log(delete_row);
                $('#' + delete_row).remove();
            });

            //เหตุการเมื่อกดปุ่มลบแถว
            $(document).on('click','.remove_spare', function(){
                var id = $(this).data("id");
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "delete-where.php",
                    data: { table: 'tbl_job_spare_use', data_id: id },
                    beforeSend: function(){
                      //Show image container
                      $("#loader").show();
                      $("#wrapper").hide();
                    },
                    success: function(result) {
                      if(result == 'delete_ok'){
                        alert('ลบอะไหล่ เรียบร้อย!');
                      }else{
                        alert('not Delete! Error:: '+result);
                      }
                    },
                    complete:function(data){
                     // Hide image container
                     $("#loader").hide();
                     $("#wrapper").show();
                    }
                });

            });







});
// END JQUERY MAIN

function check_tech_same(tech){

          var curr_id = $(tech).attr("id");  //เก็บค่า id ที่ส่งเข้ามา
          var curr_val = $(tech).val();
          var dup = '';
          $('.techname').each(function(){
              var id_now = $(this).attr("id");
                if(id_now != curr_id && $(this).val() == curr_val){
                    if(dup != '') dup += ',';
                    dup += $(this).find('option:selected').text();
                    // console.log(dup);
                    alert(dup+' เลือกไว้แล้ว! ');
                    $(tech).prop('selectedIndex', 0);
                    return false;
                }
          });
          // alert((dup==''?'ไม่ซ้ำ':'ซ้ำกับ : '+dup)); //if แบบย่อ
            var old_id = curr_id.split('tech_');
            var next_id = parseInt(old_id[1])+1;
            next_id = 'tech_'+next_id;
            console.log(next_id);
            $('#'+next_id).attr('disabled', false);

}

function check_spare_same(spare){

  var curr_id = $(spare).attr("id");  //เก็บค่า id ที่ส่งเข้ามา
  var curr_val = $(spare).val();
  var dup = '';
  var num = curr_id.split('item_spare_use');
  // console.log(num[1]);
  $('.item_spare_use').each(function(){
      var id_now = $(this).attr("id");
        if(id_now != curr_id && $(this).val() == curr_val){
            if(dup != '') dup += ',';
            dup += $(this).find('option:selected').text();
            // console.log(dup);
            alert(dup+' เลือกไว้แล้ว! ');
            $(spare).prop('selectedIndex', 0);
            return false;
        }else{
          $('#spare_quantity'+num[1]).val(1);
        }
  });

}


function getChecked() {
  // Get the checkbox
  var breakdown = document.getElementById("breakdown");
  // Get the output text
  var breakdown_panel = document.getElementById("breakdown_panel");

  // If the checkbox is checked, display the output text
  if (breakdown.checked == true){
    breakdown_panel.style.display = "block";
  } else {
    breakdown_panel.style.display = "none";
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

function update_symptom(job_code){

  var username = $('.user').text();
  var repair_symptom = document.getElementById("job_symptom").value;
  // alert(username+ ' ' + repair_symptom.value);

  $.ajax({
    url: 'infor_update_symptom.php',
    method: 'post',
    data: {'job_code': job_code, 'username': username, 'repair_symptom': repair_symptom} ,
    success:function(response){
      // alert(response);
      if(response=='OK_UPDATE'){
        alert("บันทึกข้อมูลเรียบร้อยแล้ว");
        window.location.href = '../webapp/my_job.php'; //Will take you to Google.
      }else{
        alert("ผิดพลาด");
      }

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
 }

function chkNumber(ele){
  	var vchar = String.fromCharCode(event.keyCode);
  	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
  	ele.onKeyPress=vchar;
}


</script>
