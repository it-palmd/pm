<?php

$username = @$_POST['username'];
$level = @$_POST['level'];

include_once('include/connectdb.php');

$sql = "SELECT
          r.repair_code,
          CONCAT(s.spare_code,' - ',s.spare_name_th,'  ',s.spare_name_en) as repair_sparepart,
          r.repair_type,
          r.repair_symptom,
          r.repair_informer,
          r.status
        FROM tbl_repair_register as r
      	INNER JOIN tbl_sparepart as s
        ON r.repair_spare_code = s.spare_code

      ";
        // -- WHERE r.repair_informer = '$username' AND r.status != 'Active'
        if($level == 'informer'){
            $sql .= " WHERE r.repair_informer = '$username' AND r.status = 'Wait_to_check' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
        }
        else if($level == 'assignment'){
            $sql .= " WHERE r.status = 'Wait_assignment' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
        }
        else if($level == 'technician'){
            $sql .= " WHERE r.status = 'In_progress' OR r.status = 'Wait_technician' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
        }
$sql .= "
         ORDER BY r.repair_code DESC
        ";

$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");
while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $json[] = $rs;
}//end while

if(mysqli_num_rows($result)>0){
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
} else {
  echo 'NO_DATA';
}

mysqli_free_result($result);
mysqli_close($con);
 ?>
