<?php
$repair_code = @$_POST['jobcode'];

// $repair_code = 'JOB-0004';
include_once('include/connectdb.php');

$sql = "SELECT
          r.repair_date,
          s.spare_code,
          s.spare_name_th,
          r.repair_type,
          r.repair_breakdown_start,
          r.repair_breakdown_stop,
          r.repair_breakdown_time,
          r.repair_symptom,
          r.repair_informer,
          r.status,
          r.assigner,
          r.assign_date,
          r.desired_date,
          r.repair_finished_date,
          r.tech_leader,
          r.tech_group,
          r.tech_2,
          r.tech_3,
          r.tech_4,
          r.tech_5,
          r.tech_accept_date,
          r.tech_accept,
          r.external_company,
          r.external_tech_leader,
          r.repair_detail,
          r.note,
          r.last_update
        FROM tbl_repair_register as r
      	INNER JOIN tbl_sparepart as s
        ON r.repair_spare_code = s.spare_code
        WHERE repair_code = '$repair_code'
        ";

$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");
$rs = mysqli_fetch_array($result, MYSQLI_NUM);
$json[] = $rs;

if(mysqli_num_rows($result)>0){
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
}else{
  echo 'NO_DATA';
}

mysqli_free_result($result);
mysqli_close($con);
 ?>
