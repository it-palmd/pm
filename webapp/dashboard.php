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

include_once('../include/connect_oop_db.php');

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
          .navbar {  width: 325px; margin:0 auto; padding: 10px 0px; }
          p { font-size: 80%; }
        }

        @media screen and (min-width: 769px) {
          #page { width:40%; margin:0 auto; }
          small { font-size: 100%; }
          #top-title { font-size: 18px; color: #195f42; }
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

     <?php
       include('nav.php');
     ?>

   	<div id="content" class="">

      <!-- Begin menu_bar -->

      <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">

        <button type="button" id="sidebarCollapse" class="btn btn-light">
          <i class="fa fa-align-justify"></i> <span></span>
        </button>

        <div id="top-title" class="mx-auto px-3 py-1 mb-0"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>

        <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
      </nav>

      <!-- End menu_bar -->

    <div id="page" class="mr-auto ml-auto" style="">
      <div id="top" class="">
        <div class="clearfix text-center panel panel-danger">
            <div class="panel-heading">
              <h4 class="alert alert-danger">กระดานสรุปผล</h4>
            </div>
        </div>
      </div>


<!-- ใบแจ้งซ่อมทั้งหมด -->
      <div id="body" class="text-center">

        <div class="alert alert-light my-1" role="alert">
          เริ่มใช้งานระบบ: 4/02/2020
        </div>

<!-- % การปิดงานซ่อม -->

        <div class="alert alert-info my-1" role="alert">
          <strong>สรุปงานแจ้งซ่อมทั้งหมด</strong>
        </div>

      <?php

      $persentile = '';

          $q_all = " SELECT COUNT(repair_code) AS count_repair FROM tbl_repair_register ";
          $result = $mysqli->query($q_all);
          $rs = $result->fetch_object();
          $all_repair = $rs->count_repair;

          $q_success = "SELECT COUNT(repair_code) AS count_repair_success FROM tbl_repair_register WHERE status = 'Active' ";
          $result1 = $mysqli->query($q_success);
          $rs1 = $result1->fetch_object();
          $success_repair = $rs1->count_repair_success;

          $number = ($success_repair/$all_repair)*100;
          $persentile = number_format($number, 2, '.', '');

          $bgbar = '';
          if($persentile < 55) $bgbar = 'bg-danger';
          if($persentile >= 55) $bgbar = 'bg-warning';
          if($persentile >= 80) $bgbar = 'bg-success';

       ?>

        <div class="alert alert-warning col-12 mb-1" role="alert">
          <div class="progress" style="height:2rem!important">
            <div class="progress-bar progress-bar-striped <?php echo $bgbar; ?>" role="progressbar" style="width: <?php echo $persentile; ?>%"
               aria-valuenow="<?php echo $persentile; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $persentile; ?>%</div>
          </div>
          <small>เปอร์เซ็นต์ความสำเร็จ</small>
          <h1 class="alert-heading"><?php echo $persentile; ?> %</h1>
        </div>

        <div class="form-inline mr-0 ml-0">

        <!-- ปิดงานซ่อม -->

            <div class="alert alert-success col-6 mb-1" role="alert">
              <a href="success_job.php">
                <h4 class="alert-heading"><?php echo $success_repair ?></h4>
                <small>ปิดงานแล้ว(ใบ)</small>
              </a>
            </div>

        <!-- ยังไม่ปิดงานซ่อม -->
            <?php
                $sql = "SELECT COUNT(DATE_FORMAT(repair_date, '%Y-%m-%d')) AS count_repair_today
                        FROM tbl_repair_register
                        WHERE status != 'Active'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
                $result = $mysqli->query($sql);
                $rs = $result->fetch_object();
             ?>

              <div class="alert alert-danger col-6 mb-1" role="alert">
                <a href="no_action_job.php">
                  <h4 class="alert-heading"><?php echo $rs->count_repair_today; ?></h4>
                  <!-- <hr> -->
                  <small>ยังไม่ปิดงาน(ใบ)</small>
                </a>
              </div>


          </div>


        <div class="alert alert-primary col-12 mb-1" role="alert">
          <a href="all_job.php">
            <h2 class="alert-heading"><?php echo $all_repair; ?></h2>
            <!-- <hr> -->
            <small>งานซ่อมทั้งหมด(ใบ)</small>
            <!-- <p class="mb-0">ใบแจ้งซ่อมทั้งหมด(ใบ)</p> -->
          </a>
        </div>


        <div class="form-inline mr-0 ml-0">

<!-- ใบแจ้งซ่อมเดือนนี้ -->
            <?php

            $sql = "SELECT COUNT(repair_date) AS count_repair_month
                    FROM tbl_repair_register
        						WHERE DATE_FORMAT(repair_date, '%Y-%m') = Date_format(NOW(),'%Y-%m')
        						";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                $result = $mysqli->query($sql);
                $rs = $result->fetch_object();

             ?>

            <div class="alert alert-light col-6" role="alert">
              <a href="month_job.php">
                <h4 class="alert-heading"><?php echo $rs->count_repair_month ?></h4>
                <!-- <hr> -->
                <p class="mb-0">แจ้งซ่อมเดือนนี้(ใบ)</p>
              </a>
            </div>

<!-- ใบแจ้งซ่อมวันนี้ -->
            <?php

                $sql = "SELECT COUNT(DATE_FORMAT(repair_date, '%Y-%m-%d')) AS count_repair_today
                        FROM tbl_repair_register
                        WHERE DATE_FORMAT(repair_date, '%Y-%m-%d') = Date_format(NOW(),'%Y-%m-%d')
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                $result = $mysqli->query($sql);
                $rs = $result->fetch_object();

             ?>
            <div class="alert alert-light col-6" role="alert">
              <a href="today_job.php">
                <h4 class="alert-heading text-danger"><?php echo $rs->count_repair_today ?></h4>
                <!-- <hr> -->
                <p class="mb-0">แจ้งซ่อมวันนี้(ใบ)</p>
              </a>
            </div>

          </div>

<!-- สถานะต่าง -->

          <div class="form-group mr-0 ml-0">

              <div class="list-group">
                <?php
                $sql_wait_pm = "SELECT COUNT(status) AS count_wait_pm
                        FROM tbl_repair_register
                        WHERE status = 'Wait_assignment'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                    $result = $mysqli->query($sql_wait_pm);
                    $rs_wait_pm = $result->fetch_object();

                 ?>
                <a href="wait_assignment_job.php"  class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                  รอ PM มอบหมายงาน
                  <span class="badge badge-secondary badge-pill"><?php echo $rs_wait_pm->count_wait_pm ?></span>
                </a>

                <?php
                $sql_wait_tech = "SELECT COUNT(status) AS count_wait_tech
                        FROM tbl_repair_register
                        WHERE status = 'Wait_technician'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                    $result = $mysqli->query($sql_wait_tech);
                    $rs_wait_tech = $result->fetch_object();

                 ?>
                <a href="wait_technician_job.php"  class="list-group-item d-flex justify-content-between align-items-center text-warning">
                  รอช่างรับงาน
                  <span class="badge badge-warning badge-pill"><?php echo $rs_wait_tech->count_wait_tech ?></span>
                </a>

                <?php
                $sql_in_progress = "SELECT COUNT(status) AS count_in_progress
                        FROM tbl_repair_register
                        WHERE status = 'In_progress'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                    $result = $mysqli->query($sql_in_progress);
                    $rs_in_progress = $result->fetch_object();

                 ?>
                <a href="in_progress_job.php"  class="list-group-item d-flex justify-content-between align-items-center text-info">
                  กำลังดำเนินงาน
                  <span class="badge badge-info badge-pill"><?php echo $rs_in_progress->count_in_progress ?></span>
                </a>

                <?php
                $sql_wait_to_check = "SELECT COUNT(status) AS count_wait_to_check
                        FROM tbl_repair_register
                        WHERE status = 'Wait_to_check'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                    $result = $mysqli->query($sql_wait_to_check);
                    $rs_wait_to_check = $result->fetch_object();

                 ?>

                  <a href="wait_to_check_job.php" class="list-group-item d-flex justify-content-between align-items-center text-primary">
                    รอตรวจงาน
                    <span class="badge badge-primary badge-pill"><?php echo $rs_wait_to_check->count_wait_to_check ?></span>
                  </a>

                <?php
                $sql_success = "SELECT COUNT(status) AS count_success
                        FROM tbl_repair_register
                        WHERE status = 'Active'
                        ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                    $result = $mysqli->query($sql_success);
                    $rs_success = $result->fetch_object();

                 ?>

                  <a href="success_job.php" class="list-group-item d-flex justify-content-between align-items-center text-success">
                    ปิดงานแล้ว
                      <span class="badge badge-success badge-pill"><?php echo $rs_success->count_success ?></span>
                  </a>

              </div>

          </div>
<!-- End จบแยกตามสถานะต่างๆ -->

        <?php
        // $data = array("01:30:16", "01:30:59", "02:10:20");
        $sql_select_bdt = "SELECT repair_breakdown_time_h, repair_breakdown_time_m, repair_breakdown_time_s
                FROM tbl_repair_register
                WHERE DATE_FORMAT(repair_date, '%Y-%m') = Date_format(NOW(),'%Y-%m')
                ";

        $result = $mysqli->query($sql_select_bdt);

        $date = new DateTime('0000-00-00 00:00:00');
        $h = 0; $m = 0; $s = 0;

        while($rs = $result->fetch_object()){
            $h = $h + $rs->repair_breakdown_time_h;
            $m = $m + $rs->repair_breakdown_time_m;
            $s = $s + $rs->repair_breakdown_time_s;
        }

        date_modify($date, "$h hour $m min $s sec");
        $bdt = date_format($date, "H ชั่วโมง i นาที s วินาที");

        // $date->modify("$h hour $m min $s sec");
        // echo $date->format('H ชั่วโมง i นาที s วินาที');
        ?>
        <div class="alert alert-danger col-12" role="alert">
          <small>รวม Breakdown ณ เดือนปัจจุบัน</small>
          <h4 class="alert-heading"><?php echo $bdt; ?> </h4>
        </div>

        <div class="form-group mr-0 ml-0">

            <div class="alert alert-warning my-1" role="alert">
              <strong>สรุปงานตามกลุ่มช่าง</strong>
            </div>

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ช่างกล</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ช่างผลิต</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">ช่างไฟ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">ไอที</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content mb-5">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                  <div class="my-3" role="">

                    <div class="alert alert-light my-1" role="alert">
                      สรุปงานของกลุ่มTMECH
                    </div>

                          <?php

                          $tech_mechanic_persentile = '';

                              $q_tech_mechanic = "SELECT COUNT(repair_code) AS n_tech_mechanic
                                                  FROM tbl_repair_register
                                                  WHERE tech_group = 'TMECH'
                                                  ";
                              $result = $mysqli->query($q_tech_mechanic);
                              $rs_tech_mechanic = $result->fetch_object();
                              $all_tech_mechanic = $rs_tech_mechanic->n_tech_mechanic;

                              $q_tech_mechanic_success = "SELECT COUNT(repair_code) AS n_tech_mechanic_success
                                                          FROM tbl_repair_register
                                                          WHERE tech_group = 'TMECH' AND status = 'Active'
                                                          ";
                              $result1 = $mysqli->query($q_tech_mechanic_success);
                              $rs_tech_mechanic_success = $result1->fetch_object();

                              $tech_mechanic_success = $rs_tech_mechanic_success->n_tech_mechanic_success;

                              if($tech_mechanic_success != 0) {
                                $number = ($tech_mechanic_success / $all_tech_mechanic)*100;
                                $tech_mechanic_persentile = number_format($number, 2, '.', '');
                              }else{
                                echo '$tech_mechanic_success มีค่าเป็น 0';
                              }

                              $bgbar = '';
                              if($tech_mechanic_persentile < 55) $bgbar = 'bg-danger';
                              if($tech_mechanic_persentile >= 55) $bgbar = 'bg-warning';
                              if($tech_mechanic_persentile >= 80) $bgbar = 'bg-success';

                           ?>

                            <div class="alert alert-light col-12" role="alert">
                              <div class="progress" style="height:2rem!important">
                                <div class="progress-bar progress-bar-striped <?php echo $bgbar; ?>" role="progressbar" style="width: <?php echo $tech_mechanic_persentile; ?>%"
                                   aria-valuenow="<?php echo $tech_mechanic_persentile; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tech_mechanic_persentile; ?>%</div>
                              </div>
                              <small>เปอร์เซ็นต์ความสำเร็จ</small>
                              <!-- <h1 class="alert-heading"><?php echo $tech_mechanic_persentile; ?> %</h1> -->
                            </div>

                            <div class="form-inline mr-0 ml-0">

                            <!-- ปิดงานซ่อม -->

                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-success"><?php echo $tech_mechanic_success; ?></h4>
                                  <small>ปิดงานแล้ว(ใบ)</small>
                                </div>

                            <!-- ยังไม่ปิดงานซ่อม -->
                                <?php

                                $q_tech_mechanic_not_success = "SELECT COUNT(repair_code) AS n_tech_mechanic_not_success
                                                                FROM tbl_repair_register
                                                                WHERE tech_group = 'TMECH' AND status != 'Active'
                                                                ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                                $result = $mysqli->query($q_tech_mechanic_not_success);
                                $rs_tech_mechanic_not_success = $result->fetch_object();

                                 ?>
                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-danger"><?php echo $rs_tech_mechanic_not_success->n_tech_mechanic_not_success; ?></h4>
                                  <small>ยังไม่ปิดงาน(ใบ)</small>
                                </div>

                              </div>


                            <div class="alert alert-light col-12 mb-1" role="alert">
                              <h2 class="alert-heading text-primary"><?php echo $all_tech_mechanic; ?></h2>
                              <small>งานซ่อมทั้งหมด(ใบ)</small>
                            </div>

                  </div>

                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                  <div class="my-3" role="">

                    <div class="alert alert-light my-1" role="alert">
                      สรุปงานของกลุ่มTPROD
                    </div>

                          <?php

                          $tech_production_persentile = '';

                              $q_tech_production = "SELECT COUNT(repair_code) AS n_tech_production
                                                  FROM tbl_repair_register
                                                  WHERE tech_group = 'TPROD'
                                                  ";

                              $result = $mysqli->query($q_tech_production);
                              $rs_tech_production = $result->fetch_object();
                              $all_tech_production = $rs_tech_production->n_tech_production;

                              $q_tech_production_success = "SELECT COUNT(repair_code) AS n_tech_production_success
                                                          FROM tbl_repair_register
                                                          WHERE tech_group = 'TPROD' AND status = 'Active'
                                                          ";

                              $result1 = $mysqli->query($q_tech_production_success);
                              $rs_tech_production_success = $result1->fetch_object();
                              $tech_production_success = $rs_tech_production_success->n_tech_production_success;

                              if($tech_production_success != 0) {
                                $number = ($tech_production_success / $all_tech_production)*100;
                                $tech_production_persentile = number_format($number, 2, '.', '');
                              }else{
                                echo '$tech_production_success มีค่าเป็น 0';
                              }

                              $bgbar = '';
                              if($tech_production_persentile < 55) $bgbar = 'bg-danger';
                              if($tech_production_persentile >= 55) $bgbar = 'bg-warning';
                              if($tech_production_persentile >= 80) $bgbar = 'bg-success';

                           ?>

                            <div class="alert alert-light col-12" role="alert">
                              <div class="progress" style="height:2rem!important">
                                <div class="progress-bar progress-bar-striped <?php echo $bgbar; ?>" role="progressbar" style="width: <?php echo $tech_production_persentile; ?>%"
                                   aria-valuenow="<?php echo $tech_production_persentile; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tech_production_persentile; ?>%</div>
                              </div>
                              <small>เปอร์เซ็นต์ความสำเร็จ</small>
                              <!-- <h1 class="alert-heading"><?php echo $tech_production_persentile; ?> %</h1> -->
                            </div>

                            <div class="row mr-0 ml-0">

                            <!-- ปิดงานซ่อม -->

                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-success"><?php echo $tech_production_success; ?></h4>
                                  <small>ปิดงานแล้ว(ใบ)</small>
                                </div>

                            <!-- ยังไม่ปิดงานซ่อม -->
                                <?php

                                $q_tech_production_not_success = "SELECT COUNT(repair_code) AS n_tech_production_not_success
                                                                FROM tbl_repair_register
                                                                WHERE tech_group = 'TPROD' AND status != 'Active'
                                                                ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                                $result = $mysqli->query($q_tech_production_not_success);
                                $rs_tech_production_not_success = $result->fetch_object();

                                 ?>
                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-danger"><?php echo $rs_tech_production_not_success->n_tech_production_not_success ?></h4>
                                  <small>ยังไม่ปิดงาน(ใบ)</small>
                                </div>

                              </div>

                            <div class="alert alert-light col-12 mb-1" role="alert">
                              <h2 class="alert-heading text-primary"><?php echo $all_tech_production; ?></h2>
                              <small>งานซ่อมทั้งหมด(ใบ)</small>
                            </div>

                  </div>
                </div>

                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                  <div class="my-3" role="">

                    <div class="alert alert-light my-1" role="alert">
                      สรุปงานของกลุ่มTELECฟ้า
                    </div>
                          <?php
                            $tech_electric_persentile = '';

                              $q_tech_electric = "SELECT COUNT(repair_code) AS n_tech_electric
                                                  FROM tbl_repair_register
                                                  WHERE tech_group = 'TELEC'
                                                  ";

                              $result = $mysqli->query($q_tech_electric);
                              $rs_tech_electric = $result->fetch_object();
                              $all_tech_electric = $rs_tech_electric->n_tech_electric;

                              $q_tech_electric_success = "SELECT COUNT(repair_code) AS n_tech_electric_success
                                                          FROM tbl_repair_register
                                                          WHERE tech_group = 'TELEC' AND status = 'Active'
                                                          ";

                              $result1 = $mysqli->query($q_tech_electric_success);
                              $rs_tech_electric_success = $result1->fetch_object();
                              $tech_electric_success = $rs_tech_electric_success->n_tech_electric_success;

                              if($tech_electric_success != 0) {
                                $number = ($tech_electric_success / $all_tech_electric)*100;
                                $tech_electric_persentile = number_format($number, 2, '.', '');
                              }else{
                                  echo '$tech_electric_success มีค่าเป็น 0';
                              }

                              $bgbar = '';
                              if($tech_electric_persentile < 55) $bgbar = 'bg-danger';
                              if($tech_electric_persentile >= 55) $bgbar = 'bg-warning';
                              if($tech_electric_persentile >= 80) $bgbar = 'bg-success';

                           ?>

                            <div class="alert alert-light col-12" role="alert">
                              <div class="progress" style="height:2rem!important">
                                <div class="progress-bar progress-bar-striped <?php echo $bgbar; ?>" role="progressbar" style="width: <?php echo $tech_electric_persentile; ?>%"
                                   aria-valuenow="<?php echo $tech_electric_persentile; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tech_electric_persentile; ?>%</div>
                              </div>
                              <small>เปอร์เซ็นต์ความสำเร็จ</small>
                            </div>

                            <div class="row mr-0 ml-0">

                            <!-- ปิดงานซ่อม -->

                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-success"><?php echo $tech_electric_success; ?></h4>
                                  <small>ปิดงานแล้ว(ใบ)</small>
                                </div>

                            <!-- ยังไม่ปิดงานซ่อม -->
                                <?php

                                $q_tech_electric_not_success = "SELECT COUNT(repair_code) AS n_tech_electric_not_success
                                                                FROM tbl_repair_register
                                                                WHERE tech_group = 'TELEC' AND status != 'Active'
                                                                ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

                                $result = $mysqli->query($q_tech_electric_not_success);
                                $rs_tech_electric_not_success = $result->fetch_object();

                                 ?>
                                <div class="alert alert-light col-6 mb-1" role="alert">
                                  <h4 class="alert-heading text-danger"><?php echo $rs_tech_electric_not_success->n_tech_electric_not_success ?></h4>
                                  <small>ยังไม่ปิดงาน(ใบ)</small>
                                </div>

                              </div>


                            <div class="alert alert-light col-12 mb-1" role="alert">
                              <h2 class="alert-heading text-primary"><?php echo $all_tech_electric; ?></h2>
                              <small>งานซ่อมทั้งหมด(ใบ)</small>
                            </div>

                  </div>

                </div>

                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                  <div class="alert alert-light my-1" role="alert">
                    สรุปงานของกลุ่มช่างไอที
                  </div>

                </div>

              </div>

        </div>



      </div>

      <?php
        $result->free();
        $result1->free();
        $mysqli->close();
      ?>

<!-- bottom panel       -->
      <div id="bottom" class="">

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


});


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


  </script>




  </body>
</html>
