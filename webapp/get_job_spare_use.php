<?php
//fetch.php
include_once('../include/connect_oop_db.php');

$r_code = $_POST['repair_code'];
$output = '';
$sql = "SELECT jsu.*,
        (SELECT spare_sub_name_th FROM tbl_sparepart_sub WHERE spare_sub_code = jsu.spare_use) as spare_name,
        (SELECT unit_name FROM tbl_unit_count WHERE unit_code = jsu.unit_count) as unit
        FROM tbl_job_spare_use jsu
        WHERE job_code = '$r_code'
       ";
$result = $mysqli->query($sql);
While($row = $result->fetch_object()){
    $output .= $row->spare_use.' '.$row->spare_name.' &nbsp;&nbsp;&nbsp; จำนวน '.$row->spare_quantity.' '.$row->unit.' &#013;';
}

echo $output;

$result->free();
$mysqli->close();
?>
