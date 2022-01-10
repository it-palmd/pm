<?php
$code = @$_POST['code'];
// $code = 'PRD0001';
include_once('../include/connectdb.php');

$sql = "SELECT *
        FROM tbl_sparepart
        WHERE spare_code = '$code'
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
