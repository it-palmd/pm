<?php
$username = @$_POST['username'];
$password = @$_POST['password'];

// $id = 2;
// $username = "admin";
// $password = "admin";
include_once('../include/connectdb.php');

$sql = "SELECT *
        FROM tbl_users
        WHERE username = '$username' AND password = '$password'
        AND (system = 'PM' OR system = 'ALL')
        ";
$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

if(mysqli_num_rows($result)>0){
  $rs = mysqli_fetch_array($result, MYSQLI_NUM);
  $json[] = $rs[1]; //ส่งค่า username
  $json[] = $rs[4]; //ส่งค่า level
}else{
  $json[] = "0";
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($con);

// if(mysqli_num_rows($result)>0){
//   echo "OK_PASS";
// }//end if

 ?>
