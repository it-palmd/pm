<?php
//fetch.php
include_once('../include/connect_oop_db.php');
$output = '';
$sql = "SELECT * FROM tbl_sparepart_sub WHERE status = 'Active' ORDER BY spare_sub_name_th ASC";
        $result = $mysqli->query($sql);
        while ($rs1 = $result->fetch_assoc()) {
          $output .= '<option value="'.$rs1['spare_sub_code'].'" >'.$rs1['spare_sub_code'].' - '.$rs1['spare_sub_name_th'].'</option>';
        }//end while
echo $output;

$result->free();
$mysqli->close();
?>
