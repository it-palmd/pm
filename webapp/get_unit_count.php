<?php
//fetch.php
include_once('../include/connect_oop_db.php');
$output = '';
$sql = "SELECT * FROM tbl_unit_count WHERE status = 'Active' ORDER BY unit_name ASC";
        $result = $mysqli->query($sql);
        while ($rs1 = $result->fetch_assoc()) {
          ($rs1['unit_code']=='EA')?$selected = 'selected':$selected = '';
          $output .= '<option value="'.$rs1['unit_code'].'" '.$selected.'>'.$rs1['unit_name'].'</option>';
        }//end while
echo $output;

$result->free();
$mysqli->close();
?>
