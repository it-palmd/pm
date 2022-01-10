<?php
  session_start();
  include_once('../include/connect_oop_db.php');

  if(isset($_POST['query'])){
    $inpText=$_POST['query'];
    $sql="SELECT spare_code, spare_name_th FROM tbl_sparepart WHERE spare_code LIKE '%$inpText%' OR spare_name_th LIKE '%$inpText%' ";
    $result = $mysqli->query($sql) ;
    if($num = $result->num_rows > 0){
        while ($rs = $mysqli->fecth_object()) {
          echo "<a href='#' class='list-group-item list-group-item-action border-1'>".$rs->spare_code.' - '.$rs->spare_name_th."</a>";
        }
    }else{
      echo "<p class='list-group-item border-1'>ไม่พบข้อมูล</p>";
    }

  }

  if(isset($_POST['action'])){

    $action = $_POST['action'];
    $level = $_POST['level'];
    $username = $_POST['username'];

    if($action=='get_count_my_job'){
      // $today = date("Y-m-d");	//2019-12-08

      $sql = "SELECT count(repair_code) FROM `tbl_repair_register` as r WHERE 1 ";

  		if($level == 'informer'){
  				$sql .= " AND r.status = 'Wait_to_check' ";
          $sql .= " AND r.repair_informer = '$username' ";
  		}
  		else if($level == 'assignment'){
  				$sql .= " AND r.status = 'Wait_assignment' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
  		}
  		else if($level == 'technician'){
  				$sql .= " AND (r.status = 'In_progress' OR r.status = 'Wait_technician') ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
          $sql .= " AND (SELECT LEFT(r.tech_leader,7)) = '$username' ";
  		}

    }else if($action=='get_count_today_job'){

      $sql = "SELECT COUNT(DATE_FORMAT(repair_date, '%Y-%m-%d')) AS job_count
  						FROM tbl_repair_register
  						WHERE DATE_FORMAT(repair_date, '%Y-%m-%d') = Date_format(NOW(),'%Y-%m-%d')
  						";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

    }else if($action=='get_count_month_job'){

      $sql = "SELECT COUNT(repair_date) AS job_count
  						FROM tbl_repair_register
  						WHERE DATE_FORMAT(repair_date, '%Y-%m') = Date_format(NOW(),'%Y-%m')
  						";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

    }else if($action=='get_count_no_action_job'){

      $sql = "SELECT COUNT(repair_date) AS job_count
  						FROM tbl_repair_register
  						WHERE status != 'Active'
  						";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
    }
    $result = $mysqli->query($sql);
    $rs = $result->fetch_array();

    echo $rs[0];

  }

  $result->free();
  $mysqli->close();

 ?>
