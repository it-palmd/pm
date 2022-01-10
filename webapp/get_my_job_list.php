<?php
session_start();
$emp_code = $_SESSION['pm_emp_code'];
$username = $_POST['username'];
$level = $_POST['level'];
$order_by = $_POST['order'];

$order = '';

if($order_by=='repair_code' || $order_by=='status'){ $order = 'DESC'; }else{ $order = 'ASC'; }

include_once('../include/connectdb.php');

$sql = "SELECT
          r.repair_symptom_pic,
          r.repair_code,
          r.repair_date,
          s.spare_location,
          CONCAT(s.spare_code,' - ',s.spare_name_th,' (',s.spare_name_en,')') as repair_sparepart,
          r.repair_type,
          r.repair_symptom,
          r.repair_informer,
          r.tech_leader,
          r.status,
          CONCAT(e.emp_firstname,'  ',e.emp_lastname) AS informer_name

        FROM tbl_repair_register as r
      	INNER JOIN tbl_sparepart as s ON r.repair_spare_code = s.spare_code
        INNER JOIN tbl_employee AS e ON e.emp_code = r.repair_informer
        WHERE 1
      ";
        // -- WHERE r.repair_informer = '$username' AND r.status != 'Active'
        if($level == 'informer'){
            $sql .= " AND r.status = 'Wait_to_check' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
            $sql .= " AND r.repair_informer = '$username' ";
        }
        else if($level == 'assignment'){
            $sql .= " AND r.status = 'Wait_assignment' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
        }
        else if($level == 'technician'){
            $sql .= " AND (r.status = 'Wait_technician' OR r.status = 'In_progress') ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
            $sql .= " AND (SELECT LEFT(r.tech_leader,7)) = '$emp_code' ";
        }
$sql .= "
         ORDER BY r.$order_by $order
        ";

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
            if($status == 'Wait_assignment') { $status = 'รอ PM หมอบหมายงาน'; $bg = 'secondary'; }
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
      <img src='images/".($rs['repair_symptom_pic']=='' ? $symptom_pic = 'sparepart/' .$rs['repair_code']. '.jpg' : $symptom_pic = 'symptom/' .$rs['repair_symptom_pic'])."' class='symptom_pic' alt='ไม่มีรูป'>
      <div class='symptom_detail'>
      <strong class='text-warning'>".$rs['repair_code'].'</strong><br/>
      <strong>แผนก: </strong>'.$rs['spare_location'].'<br/>
      <strong>ชื่อ: </strong>'.$rs['repair_sparepart'].'<br/>
      <strong>ประเภท: </strong>'.$repair_type.'<br/>
      <strong>อาการ: </strong>'.$rs['repair_symptom'].'<br/>
      <strong>ผู้แจ้ง: </strong>'.$rs['informer_name'].'<br/>
      <strong>วันที่แจ้ง: </strong>'.$rs['repair_date'].'<br/>'.$txt1.'
      <span class="badge badge-'.$bg.'" style="font-size:0.75rem;" >'.$status.'</span>'.
      "</div></a>";

      echo $txt;

    }
    echo '|'.mysqli_num_rows($result);

}else{
  echo "<p class='list-group-item border-1'>ไม่พบข้อมูล</p>";
}

mysqli_free_result($result);
mysqli_close($connect);
 ?>
