<?php

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = '';

include_once('../include/connectdb.php');

$sql = "SELECT

          r.repair_code,
          s.spare_location,
          CONCAT(s.spare_code,' - ',s.spare_name_th,'  ',s.spare_name_en) as repair_sparepart,
          r.repair_type,
          r.repair_symptom,
          r.repair_informer,
          r.repair_date,
          r.tech_group,
          r.tech_leader,
					r.status,
          CONCAT(e.emp_firstname,'  ',e.emp_lastname) AS informer_name,
          e.emp_firstname, e.emp_lastname

        FROM tbl_repair_register as r
      	INNER JOIN tbl_sparepart as s ON r.repair_spare_code = s.spare_code
        INNER JOIN tbl_employee as e ON e.emp_code = r.repair_informer
      ";

$sql .= " WHERE ";

if($start_date != '' && $end_date != ''){
  $sql .= " DATE_FORMAT(r.repair_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' AND ";
}

if($_POST["filter_tech_group"] != 'all')
{
  $sql .= " tech_group = '".$_POST["filter_tech_group"]."' AND ";
}

if($_POST["filter_tech_leader"] != 'all')
{
  $sql .= " tech_leader = '".$_POST["filter_tech_leader"]."' AND ";
}

if(isset($_POST["search"]))
{
 $sql .= '
   (
    repair_date LIKE "%'.$_POST["search"].'%"
    OR repair_code LIKE "%'.$_POST["search"].'%"
    OR repair_type LIKE "%'.$_POST["search"].'%"
    OR repair_spare_code LIKE "%'.$_POST["search"].'%"
    OR spare_name_th LIKE "%'.$_POST["search"].'%"
    OR spare_location LIKE "%'.$_POST["search"].'%"
    OR repair_symptom LIKE "%'.$_POST["search"].'%"
    OR emp_firstname LIKE "%'.$_POST["search"].'%"
    OR emp_lastname LIKE "%'.$_POST["search"].'%"
    OR repair_informer LIKE "%'.$_POST["search"].'%"
    OR r.status LIKE "%'.$_POST["search"].'%"
  )
 ';
}

$sql .= " ORDER BY r.repair_code DESC ";

$result = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if(mysqli_num_rows($result) > 0){



    while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

      $repair_type = $rs['repair_type'];

      if($repair_type == 'ด่วนมาก' || $repair_type == 'ด่วนฉุกเฉิน') {
        $repair_type = '<span class="text-danger">'.$repair_type.'</span>';
      }else{
        $repair_type = '<span class="text-info">'.$repair_type.'</span>';
      }

        $bg = '';
        $status = $rs['status'];
        if($status == 'Wait_to_check') { $status = 'รอตรวจงาน'; $bg = 'primary'; }
        if($status == 'Wait_assignment') { $status = 'รอ PM หมอบหมายงาน'; $bg = 'default'; }
        if($status == 'Wait_technician') { $status = 'รอช่างรับงาน'; $bg = 'warning'; }
        if($status == 'In_progress') { $status = 'กำลังดำเนินงาน'; $bg = 'info'; }
        if($status == 'Active') { $status = 'พร้อมใช้งาน'; $bg = 'success'; }

        $txt = '';
        $txt1 = '';

      if($rs['tech_leader'] != ''){
        $txt1 = '<strong>ผู้รับผิดชอบงาน: </strong><span class="text-primary">'.$rs['tech_leader'].'</span><br/>';
      }

      $txt = "
      <a href='job_detail.php?job_code=".$rs['repair_code']."' class='list-group-item list-group-item-action border-1'>
      <strong class='text-warning'>".$rs['repair_code'].'</strong><br/>
      <strong>แผนก: </strong>'.$rs['spare_location'].'<br/>
      <strong>ชื่อ: </strong>'.$rs['repair_sparepart'].'<br/>
      <strong>ประเภท: </strong>'.$repair_type.'<br/>
      <strong>อาการ: </strong>'.$rs['repair_symptom'].'<br/>
      <strong>ผู้แจ้ง: </strong>'.$rs['informer_name'].'<br/>
      <strong>วันที่แจ้ง: </strong>'.$rs['repair_date'].'<br/>'.$txt1.'
      <label class="label label-'.$bg.'" style="font-size:0.75rem;" >'.$status.'</label>'.
      "</a>
      ";

      echo $txt;

    }
    echo '|'.mysqli_num_rows($result);
}else{
  echo "<p class='list-group-item border-1'>ไม่พบข้อมูล</p>";
}

mysqli_free_result($result);
mysqli_close($connect);
 ?>
