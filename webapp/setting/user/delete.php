<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

$connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
mysqli_set_charset($connect, "utf8");

// echo $_POST["id"];
  $sql = "DELETE FROM tbl_users WHERE id='".$_POST["id"]."'";

  echo $result = mysqli_query($connect, $sql) or die("error to delete users data");

mysqli_close($connect);
?>
