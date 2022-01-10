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

if($job_code != ''){

  include_once('../include/connect_oop_db.php');

  $sql = "SELECT

            r.*,
            s.spare_code, s.spare_pic, s.spare_name_th, s.spare_name_en, s.spare_location,
            CONCAT(s.spare_code,' - ',s.spare_name_th,' (',s.spare_name_en,')') as repair_spare_name,
            (SELECT tech_type_name FROM tbl_tech_type  WHERE tech_type_code = r.tech_group ) AS tech_group,
            (SELECT CONCAT(e.emp_firstname,'  ',e.emp_lastname) FROM tbl_employee e WHERE e.emp_code = r.repair_informer ) AS informer_name,
            (SELECT CONCAT(e.emp_firstname,'  ',e.emp_lastname) FROM tbl_employee e WHERE e.emp_code = r.assigner ) AS assigner_name,
            (SELECT CONCAT(e.emp_firstname,'  ',e.emp_lastname) FROM tbl_employee e WHERE e.emp_code = r.tech_accept ) AS tech_accept_name,
            (SELECT CONCAT(e.emp_firstname,'  ',e.emp_lastname) FROM tbl_employee e WHERE e.emp_code = r.inspector ) AS inspector_name

          FROM tbl_repair_register as r
          INNER JOIN tbl_sparepart as s ON r.repair_spare_code = s.spare_code
          WHERE r.repair_code = '$job_code'
          ";

  $result = $mysqli->query($sql);
  $rs = $result->fetch_assoc();

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
    <link rel="stylesheet" href="../css/bootstrap.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">

    <!-- <link rel="stylesheet" href="dist/css/beyond.min.css" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="dist/bootstrap.css" type="text/css" media="all"> -->
    <link href="dist/jquery.bootgrid.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/bootstrap-datepicker3.css" type="text/css" />
    <!-- <link rel="stylesheet" href="dist/css/main.css" type="text/css" /> -->

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

        @media screen and (max-width: 769px) {
          /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
          .table-responsive { font-size: 80%; }
          .control_box_c { width:800px!important; }
          .navbar { width:325px; margin:0 auto; }
          p { font-size: 80%; }
          #spare_pic { height: 350px; width: 100%; }
          #page { padding: 10px; background: #fff; border-radius: 10px; }
          .spare_pic_style { margin: 15px -15px; }
        }

        @media screen and (min-width: 769px) {
          #page { width:40%; margin:0 auto; padding: 15px; background: #fff; border-radius: 10px; }
          small { font-size: 100%; }
          #spare_pic { /*height: 500px;*/ width: 100%; }
          #top-title { font-size: 18px; color: #195f42; }
          .spare_pic_style { margin: 15px -15px; }
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

   		<nav class="navbar navbar-expand-lg navbar-light bg-light">

     		<button type="button" id="sidebarCollapse" class="btn btn-light">
     			<i class="fa fa-align-justify"></i> <span></span>
     		</button>

        <div id="top-title" class="mx-auto px-3 py-1 mb-0"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>

        <a href="./spare_detail.php?sp_code=<?php echo $rs['spare_code']; ?>" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
      </nav>

    <div id="page" class="mr-auto ml-auto" >

      <div id="top" class="">
        <div class="col-xs col-sm text-center alert alert-warning fade show" role="">
          <h4 class="lead mb-0">รายละเอียดใบแจ้งซ่อม</h4>
        </div>
      </div>

      <h5 class="text-center text-danger"><?php echo $_GET['job_code']; ?></h5>

      <div id="body" class="text-center">

<!-- begin for informer -->

           <div class="form-group">
             <div class="spare_pic_style" >
               <img id="spare_pic" src="images/<?php echo $symptom_pic = ($rs['repair_symptom_pic']=='' ? $symptom_pic = 'sparepart/' . $rs['spare_code']. '.jpg' : $symptom_pic = 'symptom/' . $rs['repair_symptom_pic']) ?>"  alt="Spare Pic">
             </div>
           </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">อุปกรณ์: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_name" name="job_name" value="<?php echo $rs['repair_spare_name']; ?>" readonly>
              <input type="hidden" name="spare_code" value="<?php echo $rs['spare_code']; ?>" />
            </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">สถานที่ติดตั้ง: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_spare_location" name="job_spare_location" value="<?php echo $rs['spare_location']; ?>" readonly>
            </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">ประเภทงานซ่อม: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_type" name="job_type" value="<?php echo $rs['repair_type']; ?>" readonly>
            </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">อาการเสีย: </small>
            <div class="form-inline">
              <textarea class="form-control-sm form-control-plaintext px-2 py-1" rows="5" readonly style="width:100%;height:auto;border: 1px solid #eee;" readonly><?php echo $rs['repair_symptom']; ?></textarea>
           </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">ผู้แจ้งซ่อม: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_informer" name="job_informer" value="<?php echo $rs['informer_name']; ?>" readonly>
            </div>
          </div>

          <div class="form-group text-left">
            <small for="breakdown" class="text-muted">วันที่แจ้งซ่อม: </small>
            <div class="form-inline">
              <input type="text" class="form-control-sm form-control-plaintext" id="job_date" name="job_date" value="<?php echo $rs['repair_date']; ?>" readonly>
            </div>
          </div>

          <hr/>


<?php if($rs['assigner'] != '') { ?>

                <div class="form-group">
                  <div class="col-12 text-center">
                    <h6>ส่วนงานของ PM มอบหมายงาน</h6>
                  </div>
                </div>

                <div class="form-group text-left">
                  <small for="breakdown" class="text-muted">กำหนดวันที่ซ่อมเสร็จ: </small>
                  <div class="form-inline">
                    <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['desired_date']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group text-left">
                  <small for="breakdown" class="text-muted">กลุ่มช่าง: </small>
                  <div class="form-inline">
                    <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['tech_group']; ?>" readonly>
                  </div>
                </div>

                <?php if($rs['tech_group'] == 'EX') { ?>

                    <div id="external_tech" >
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">ชื่อบริษัท/ร้านซ่อม: <span class="text-danger">*</span></small>
                        <div class="form-inline">
                          <input type="text" class="form-control-sm form-control-plaintext mr-1" value="<?php echo $rs['external_company']; ?>" >
                        </div>
                      </div>
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">หัวหน้างาน/ช่าง: <span class="text-danger">*</span></small>
                        <div class="form-inline">
                          <input type="text" class="form-control-sm form-control-plaintext mr-1" value="<?php echo $rs['external_tech_leader']; ?>" >
                        </div>
                      </div>
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">เบอร์ติดต่อ: <span class="text-danger">*</span></small>
                        <div class="form-inline">
                          <input type="text" class="form-control-sm form-control-plaintext mr-1" value="<?php echo $rs['external_phone']; ?>" >
                        </div>
                      </div>
                    </div>

                  <?php }else{ ?>

                    <div id="internal_tech" class="form-group">
                      <div class="form-group text-left">
                        <small for="breakdown" class="text-muted">ช่างที่รับผิดชอบ: <span class="text-danger">*</span>ช่าง 1 เป็นหัวหน้างาน</small>
                        <div class="form-inline">
                          <p  class="form-control-sm form-control-plaintext mr-1 text-primary"  ><?php echo $rs['tech_leader']; ?> (หัวหน้างาน)</p>
                        <?php for ($i = 2;$i <= 5;$i++) { ?>
                          <p  class="form-control-sm form-control-plaintext mr-1" style="display:<?php if($rs['tech_'.$i]=='') echo 'none'; else 'block'; ?>" ><?php echo $rs['tech_'.$i]; ?></p>
                        <?php } ?>
                        </div>
                      </div>
                    </div>

                  <?php } ?>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ผู้มอบหมายงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext mr-1" value="<?php echo $rs['assigner_name']; ?>" >
                    </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">วันที่มอบหมายงาน: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext mr-1" value="<?php echo $rs['assign_date']; ?>" >
                    </div>
                  </div>

                  <hr/>

<?php } ?>


<?php if($rs['tech_accept'] != '') { ?>
                  <!-- begin job detail for technician -->
                                  <div class="form-group">
                                    <div class="col-12 text-center">
                                      <h6>ส่วนงานของ ช่างที่ได้รับมอบหมายงาน</h6>
                                    </div>
                                  </div>
                                  <div class="form-group text-left">
                                    <small for="breakdown" class="text-muted">ผู้รับงาน: </small>
                                    <div class="form-inline">
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['tech_accept_name']; ?>" readonly>
                                    </div>
                                  </div>

                                  <div class="form-group text-left">
                                    <small for="breakdown" class="text-muted">วันที่รับงาน: </small>
                                    <div class="form-inline">
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['tech_accept_date']; ?>" readonly>
                                    </div>
                                  </div>

                <?php if($rs['dispatcher'] != '') { ?>

                  <div class="form-group">
                    <div class="" >
                      <img id="spare_pic" src="images/<?php echo $repair_pic = ($rs['repair_detail_pic']=='' ? $repair_pic = 'sparepart/' . $rs['spare_code']. '.jpg' : $repair_pic = 'repair/' . $rs['repair_detail_pic']) ?>"  alt="Spare Pic">
                    </div>
                  </div>

                  <?php if($rs['repair_type_by']=='EX'){ ?>

                      <!-- ช่างซ่อมจากข้างนอก -->
                        <div class="form-group text-left">
                          <small for="external_company" class="text-muted">ชื่อบริษัท/ร้านซ่อม: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['external_company']?>" readonly>
                         </div>
                        </div>

                        <div class="form-group text-left col-sm-6 pull-left pl-0 pr-0 mb-0">
                          <small for="external_tech_leader" class="text-muted">หัวหน้างาน/ช่างซ่อม: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext"  value="<?php echo $rs['external_tech_leader']?>" readonly >
                         </div>
                        </div>

                        <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                          <small for="external_phone" class="text-muted">เบอร์ติดต่อ: <span class="text-danger">*</span></small>
                          <div class="form-group">
                            <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['external_phone']?>" readonly>
                         </div>
                        </div>
                      <!-- End ช่างซ่อมจากข้างนอก -->

                  <?php } ?>


                  <div class="form-group text-left" style="clear:both;">
                    <div class="form-group text-left">
                      <small for="breakdown" class="text-muted">รายละเอียดการซ่อม: </small>
                      <div class="form-inline">
                        <textarea class="form-control-sm form-control-plaintext px-2 py-1" rows="10" readonly style="width:100%;height:auto;border: 1px solid #eee;"><?php echo $rs['repair_detail']; ?></textarea>
                     </div>
                    </div>
                    <div class="form-group text-left">
                      <small for="breakdown" class="text-muted">อะไหล่ที่ใช้: </small>
                      <div class="form-inline">
                        <textarea class="form-control-sm form-control-plaintext px-2 py-1" rows="5" readonly style="width:100%;height:auto;border: 1px solid #eee;"><?php echo $rs['sparepart_use']; ?></textarea>
                     </div>
                    </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="breakdown" class="text-muted">ความพร้อมของอะไหล่: </small>
                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['wait_sparepart']=='N' ? 'ไม่รอ':'รออะไหล่' ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left">
                    <small for="pr_no" class="text-muted">สั่งซื้อวัสดุ เลขที่ใบสั่งซื้อ(PR/PO):</small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['pr_no']; ?>" readonly>
                   </div>
                  </div>

                  <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                    <small for="breakdown" class="text-muted">วันที่และเวลา เข้าซ่อม: </small>
                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['working_day']; ?>" readonly>
                   </div>
                  </div>
                  <div class="form-group text-left col-sm-6 pull-right pl-0 pr-0 mb-0">
                    <small for="breakdown" class="text-muted">วันที่และเวลา ซ่อมเสร็จ: </small>
                    <div class="form-inline">
                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['working_day_stop']; ?>" readonly>
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
                        $t1 = $rs['working_day'];
                        $t2 = $rs['working_day_stop'];

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
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['tech_accept_name']; ?>" readonly>
                                    </div>
                                  </div>

                                  <div class="form-group text-left">
                                    <small for="breakdown" class="text-muted">วันที่ซ่อมเสร็จ(ส่งงาน): </small>
                                    <div class="form-inline">
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['repair_finished_date']; ?>" readonly>
                                    </div>
                                  </div>


                <?php } ?>
                                  <hr/>
<?php } ?>


<?php if($rs['inspector'] != '') { ?>

                                  <div class="form-group">
                                    <div class="col-12 text-center">
                                      <h6>ส่วนงานของ การตรวจรับงาน</h6>
                                    </div>
                                  </div>

                                  <div class="form-group text-left">
                                    <small for="breakdown" class="text-muted">ผู้ปิดงาน: </small>
                                    <div class="form-inline">
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['inspector_name']; ?>" readonly>
                                   </div>
                                  </div>

                                  <div class="form-group text-left">
                                    <small for="breakdown" class="text-muted">วันที่บันทึก: </small>
                                    <div class="form-inline">
                                      <input type="text" class="form-control-sm form-control-plaintext" value="<?php echo $rs['close_job_date']; ?>" readonly>
                                   </div>
                                  </div>

                                   <div id="reject_panel" class="form-group text-left">
                                     <div class="form-group text-left">
                                       <small for="breakdown" class="text-muted">ความเห็น:</small>
                                       <div class="form-inline">
                                         <textarea class="form-control-sm form-control-plaintext w-100 px-2 py-1" style="width:100%;height:auto;border: 1px solid #eee;" rows="5" readonly><?php echo $rs['note']; ?></textarea>
                                      </div>
                                     </div>
                                   </div>


<?php } ?>


                                <?php
                                  $bg = '';
                                  $status = $rs['status'];
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

                            <hr/>

      </div>

      <?php
        $result->free();
        $mysqli->close();
      ?>

<!-- bottom panel       -->
      <div id="bottom" class="">
        <div class="text-center mb-5">
          <button type="button" id="<?php echo $_GET['job_code']; ?>" class="btn btn-info btn-lg btn_view_repair">
              <span class="glyphicon glyphicon-print"></span> ดูในรูปแบบฟอร์ม ISO
          </button>
        </div>
      </div>
   	</div>
</div>



   </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery/jquery-3.3.1.slim.js" integrity="" crossorigin="anonymous"></script>
    <script src="../js/jquery/popper.js" integrity="" crossorigin="anonymous"></script>
    <script src="../js/jquery/bootstrap.js" integrity="" crossorigin="anonymous"></script>

    <script src="dist/jquery2.2.0/jquery.min.js"></script>
    <script src="dist/jquery-1.11.1.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>
    <script src="dist/jquery.bootgrid.min.js"></script>
    <script src="dist/js/bootstrap-datepicker.js"></script>

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

      $(document).on('click', '.btn_view_repair', function(){

        var repair_code = this.id;
        console.log(repair_code);
        var part = '../webapp/p_pm_print_job_repair_report.php?repair_code='+repair_code;
        // window.location = part;
        window.open(part, '_blank');

      });





});
// END JQUERY MQIN

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




  </body>
</html>
