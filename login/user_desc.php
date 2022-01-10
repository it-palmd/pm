<?php
$username = @$_POST['username'];

// $id = 1;
include_once('../include/connectdb.php');

$sql = "SELECT *
        FROM tbl_users
        WHERE username = '$username'
        ";
$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");
$rs = mysqli_fetch_array($result, MYSQLI_NUM);

$json[] = $rs;

echo json_encode($json, JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($con);

// if(mysqli_num_rows($result)>0){
//   echo "OK_PASS";
// }//end if

 ?>
