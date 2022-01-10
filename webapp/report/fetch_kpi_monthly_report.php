<?php
//fetch.php
include_once('../../include/connectdb.php');

$persentile = 0;

// echo $_POST['tech_group'];
// echo $_POST['is_search'];

if($_POST['action'] == 'month_total' || $_POST['action'] == 'month_close' || $_POST['action'] == 'month_progress'){

    $query = "
              SELECT COUNT(repair_code) AS month_total FROM tbl_repair_register WHERE 1
            ";

    if(isset($_POST["tech_group"])){
      $query .= " AND tech_group = '".$_POST['tech_group']."' ";
    }

    if(isset($_POST["month"]) OR isset($_POST["yesr"]))
    {
      $query .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
    }else{
      $query .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
    }

    if($_POST['action']=='month_close'){
      $query .= " AND status = 'Active' ";
    }
    if($_POST['action']=='month_progress'){
      $query .= " AND status != 'Active' ";
    }

    $result = mysqli_query($connect, $query);
    $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);

    echo $rs['month_total'];

}

if($_POST['action'] == 'month_total_persen'){

  $query = "SELECT COUNT(repair_code) AS count_repair
            FROM tbl_repair_register
            WHERE 1
            ";

      if(isset($_POST["tech_group"])){
          $query .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      if(isset($_POST["month"]) OR isset($_POST["year"]))
      {
          $query .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
      }else{
          $query .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
      }

      $result = mysqli_query($connect, $query) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$query");
      $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $all_repair = $rs['count_repair'];


      $q_success = "SELECT COUNT(repair_code) AS count_repair_success
              FROM tbl_repair_register
              WHERE status = 'Active'
              ";

      if(isset($_POST["tech_group"])){
          $q_success .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      if(isset($_POST["month"]) OR isset($_POST["year"]))
      {
          $q_success .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
      }else{
          $q_success .= ' AND MONTH(repair_date) = "'.$_POST["month"].'" AND YEAR(repair_date) = "'.$_POST["year"].'" ';
      }


      $result1 = mysqli_query($connect, $q_success) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$q_success");
      $rs1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

      $success_repair = $rs1['count_repair_success'];

      if($all_repair != 0){

        $number = ($success_repair/$all_repair)*100;
        $persentile = number_format($number, 2, '.', '');
        $persentile = $persentile + 0;

      }else{
        $persentile = 0;
      }

      if($persentile >= 80){
        echo '<span class="text-success">'.$persentile. '% </span>';
      }
      if($persentile >= 70 && $persentile < 80){
        echo '<span class="text-warning">'.$persentile. '% </span>';
      }
      if($persentile < 70){
        echo '<span class="text-danger">'.$persentile. '% </span>';
      }

}


if($_POST['action'] == 'dep_total' || $_POST['action'] == 'dep_close' || $_POST['action'] == 'dep_progress' ){

        $query = "
                  SELECT COUNT(repair_code) AS data FROM tbl_repair_register WHERE 1
                ";

    if($_POST['action'] == 'dep_close'){

      $query .= " AND status = 'Active' ";

    }else if($_POST['action'] == 'dep_progress'){

      $query .= " AND status != 'Active' ";

    }

    if(isset($_POST["tech_group"])){
      $query .= " AND tech_group = '".$_POST['tech_group']."' ";
    }

    $result = mysqli_query($connect, $query) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$query");
    $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);

    echo $rs['data'];

}

if($_POST['action'] == 'equal_total' || $_POST['action'] == 'equal_close' || $_POST['action'] == 'equal_progress' ){

  $lastMonth = $_POST['month']-1;

    $query = "
              SELECT COUNT(repair_code) AS data FROM tbl_repair_register WHERE (MONTH(repair_date)  BETWEEN ".$lastMonth." AND ".$_POST['month'].")
              AND (YEAR(repair_date) = ".$_POST['year'].")
             ";

    if($_POST['action'] == 'equal_close'){

      $query .= " AND status = 'Active' ";

    }else if($_POST['action'] == 'equal_progress'){

      $query .= " AND status != 'Active' ";

    }

    if(isset($_POST["tech_group"])){
      $query .= " AND tech_group = '".$_POST['tech_group']."' ";
    }

    $result = mysqli_query($connect, $query) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$query");
    $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);

    echo $rs['data'];

}

if($_POST['action'] == 'equal_total_persen'){

  $lastMonth = $_POST["month"] - 1;

  $query = "SELECT COUNT(repair_code) AS count_repair
            FROM tbl_repair_register
            WHERE (MONTH(repair_date)  BETWEEN ".$lastMonth." AND ".$_POST['month'].")
            AND (YEAR(repair_date) = ".$_POST['year'].")
            ";

      if(isset($_POST["tech_group"])){
          $query .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $result = mysqli_query($connect, $query) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$query");
      $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $equal_repair = $rs['count_repair'];


  $q_success = "SELECT COUNT(repair_code) AS count_repair_success
                FROM tbl_repair_register
                WHERE (MONTH(repair_date)  BETWEEN ".$lastMonth." AND ".$_POST['month'].") AND status = 'Active'
               ";

      if(isset($_POST["tech_group"])){
          $q_success .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $result1 = mysqli_query($connect, $q_success) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$q_success");
      $rs1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
      $success_repair = $rs1['count_repair_success'];

      if($equal_repair != 0){

        $number = ($success_repair/$equal_repair)*100;
        $persentile = number_format($number, 2, '.', '');
        $persentile = $persentile + 0;

      }else{
        $persentile = 0;
      }

      if($persentile >= 80){
        echo '<span class="text-success">'.$persentile. '% </span>';
      }
      if($persentile >= 70 && $persentile < 80){
        echo '<span class="text-warning">'.$persentile. '% </span>';
      }
      if($persentile < 70){
        echo '<span class="text-danger">'.$persentile. '% </span>';
      }

}


if($_POST['action'] == 'dep_total_persen'){

  $query = "SELECT COUNT(repair_code) AS count_repair
            FROM tbl_repair_register
            WHERE 1
            ";

      if(isset($_POST["tech_group"])){
          $query .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $result = mysqli_query($connect, $query) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$query");
      $rs = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $all_repair = $rs['count_repair'];


      $q_success = "SELECT COUNT(repair_code) AS count_repair_success
              FROM tbl_repair_register
              WHERE status = 'Active'
              ";

      if(isset($_POST["tech_group"])){
          $q_success .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $result1 = mysqli_query($connect, $q_success) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$q_success");
      $rs1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

      $success_repair = $rs1['count_repair_success'];

      if($all_repair != 0){

        $number = ($success_repair/$all_repair)*100;
        $persentile = number_format($number, 2, '.', '');
        $persentile = $persentile + 0;

      }else{
        $persentile = 0;
      }

      if($persentile >= 80){
        echo '<span class="text-success">'.$persentile. '% </span>';
      }
      if($persentile >= 70 && $persentile < 80){
        echo '<span class="text-warning">'.$persentile. '% </span>';
      }
      if($persentile < 70){
        echo '<span class="text-danger">'.$persentile. '% </span>';
      }

}


//Function Table
if($_POST['action'] == 'daily_repair'){

  if(isset($_POST["month"]) OR isset($_POST["year"])){

  $month = $_POST["month"];
  $year = $_POST["year"];

      //เรียกข้อมูลการจองของเดือนที่ต้องการ
      $allReportData = array();
      $strSQL = "SELECT DAY(`repair_date`) AS day, COUNT(*) AS numRepair FROM `tbl_repair_register` ";
      $strSQL.= "WHERE `repair_date` LIKE '$year-$month%' ";

      if(isset($_POST["tech_group"])){
          $strSQL .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $strSQL.= " GROUP by DAY(`repair_date`) ";

      $qry = mysqli_query($connect, $strSQL);
      while($row = mysqli_fetch_array($qry, MYSQLI_ASSOC)){
      	$allReportData[$row['day']] = $row['numRepair'];
      }

      // echo $strSQL;
      echo "<div id=''>";
      echo "<h5 align='center'>แสดงการแจ้งซ่อมในแต่ละวัน</h5>";
      echo "<table border='0' id='test_report' cellpadding='0' cellspacing='0'>";
      echo '<tr>';//เปิดแถวใหม่ ตาราง HTML
      echo '<th  class="number">รายละเอียด/วันที่</th>';

      //วันที่สุดท้ายของเดือน
      $timeDate = strtotime($year.'-'.$month."-01");  //เปลี่ยนวันที่เป็น timestamp
      $lastDay = date("t", $timeDate);   				//จำนวนวันของเดือน

      //สร้างหัวตารางตั้งแต่วันที่ 1 ถึงวันที่สุดท้ายของดือน
      for($day=1;$day<=$lastDay;$day++){
      	echo '<th class="number">' . substr('0'.$day, -2) . '</th>';
      }
      echo "</tr>";

      	echo '<tr>';//เปิดแถวใหม่ ตาราง HTML
      	echo '<td>จำนวนใบแจ้งซ่อมประจำวัน </td>';

      	//เรียกข้อมูลการจองของพนักงานแต่ละคน ในเดือนนี้
      	for($j=1;$j<=$lastDay;$j++){
      		$numBook = isset($allReportData[$j]) ? '<div>'.$allReportData[$j].'</div>' : 0;
      		echo "<td class='number'>", $numBook, "</td>";
      	}

      	echo '</tr>';//ปิดแถวตาราง HTML

      echo "</table>";
      echo "</div>";
    }

}


//Function For SPLINE Chart
if($_POST['action'] == 'daily_data'){

  if(isset($_POST["month"]) OR isset($_POST["year"])){

  $month = $_POST["month"];
  $year = $_POST["year"];

      //เรียกข้อมูลการจองของเดือนที่ต้องการ
      $allReportData = array();

      $strSQL = "SELECT DAY(`repair_date`) AS day, COUNT(*) AS numRepair FROM `tbl_repair_register` ";
      $strSQL.= "WHERE `repair_date` LIKE '$year-$month%' ";

      if(isset($_POST["tech_group"])){
          $strSQL .= " AND tech_group = '".$_POST['tech_group']."' ";
      }

      $strSQL.= " GROUP by DAY(`repair_date`) ";

      $qry = mysqli_query($connect, $strSQL);

      while($row = mysqli_fetch_array($qry, MYSQLI_ASSOC)){

        $allReportData[] = array(
                                "label" => intval($row['day']),
                                "y" => intval($row['numRepair'])
                                );

      }
      // echo $month. ' '. $year;
      echo json_encode($allReportData);

  }

}



?>
