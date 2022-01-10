<?php

$level = $_SESSION['pm_level'];

  if($level == 'informer'){
    $level = 'แจ้งซ่อม';
  }
  if($level == 'assignment'){
    $level = 'PM';
  }
  if($level == 'technician'){
    $level = 'ช่าง';
  }
  if($level == 'administrator'){
    $level = 'ผู้ดูแลระบบ';
  }

 ?>

<style>

  .fixed-top {
      position: fixed;
      top: 0;
      right: 0;
      left: 0;
      z-index: 1030;
      background-color: #eeeeee;
      /* opacity: 0.3; */

  }

</style>

<nav id="sidebar" class="active">
  <div class="sidebar-header">
    <h4 class="text-dark"><i class="fa fa-cogs" aria-hidden="true"></i> <span>ระบบซ่อมบำรุง</span></h4>
    <p>PDS PM Systems</p>
  </div>

  <div class="alert alert-info mb-0" role="alert" style="padding:12px 10px; margin-bottom:0px;">
    ผู้ใช้งาน :
    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <span><?php echo $_SESSION['pm_user']; ?></span>
    <br/>
    <span class="">ชื่อ-สกุล : </span><span class="text-primary"><?php echo $_SESSION['pm_emp_fullname']; ?></span>
    <br/>
    <span>สิทธิ์การใช้งาน: </span><span id="level" class="font-weight-bold text-danger"><?php echo $level; ?></span><span class="level invisible"><?php echo $_SESSION['pm_level'] ?></span>
  </div>

  <ul class="list-unstyled components">

    <li id="" class="active text-center">
      <p class="bg-info text-white font-weight-bold mb-0" style="background-color: #17a2b8 !important; margin-bottom:0px; color:#ffffff!important;">เมนู</p>
    </li>

    <li id="dashboard" class="">
      <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> <span>หน้าหลัก</span></a>
    </li>

    <li id="job_search" class="">
      <a href="job_search.php"><i class="fa fa-search" aria-hidden="true"></i> <span>เรียกดูข้อมูล</span></a>
    </li>

      <li id="dashboard">
        <a href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a>
      </li>

    <li id="today_job">
      <a href="today_job.php"><i class="fa fa-sun-o" aria-hidden="true"></i> <span>งานซ่อมวันนี้</span> <span id="count_today_job" class="badge badge-secondary">0</span></a>
    </li>

    <li id="month_job">
      <a href="month_job.php"><i class="fa fa-calendar" aria-hidden="true"></i> <span>งานซ่อมเดือนนี้</span> <span id="count_month_job" class="badge badge-secondary">0</span></a>
    </li>

    <li id="my_job">
      <a href="my_job.php"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>งานของฉัน</span> <span id="count_my_job" class="badge badge-secondary">0</span></a>
    </li>

    <li id="my_job">
      <a href="no_action_job.php"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>งานซ่อมค้าง</span> <span id="count_no_action_job" class="badge badge-secondary">0</span></a>
    </li>

    <li id="report">
      <a href="report.php"><i class="fa fa-book" aria-hidden="true"></i> <span>รายงาน</span> </a>
    </li>

    <!-- <li>
      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-file-text" aria-hidden="true"></i> <span>รายงาน</span></a>
      <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
          <a href="report.php"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>ค้นหาข้อมูล</span></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>รายงานแจ้งซ่อมประจำวัน</span></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>รายงานแจ้งซ่อมรายเดือน</span></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>รายงานแจ้งซ่อมตามสถานะ</span></a>
        </li>
      </ul>
    </li> -->

    <li id="setting">
      <a href="setting.php"><i class="fa fa-cogs" aria-hidden="true"></i> <span>ตั้งค่าระบบ</span></a>
    </li>

  </ul>

  <ul class="list-unstyled CTAs">
    <li>
      <a href="#" class="logout btn-danger"><i class="fa fa-setting" aria-hidden="true"></i> <span>ออกจากระบบ</span></a>
    </li>
  </ul>

</nav>
