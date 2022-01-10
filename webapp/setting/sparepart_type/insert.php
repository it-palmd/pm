<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["spare_code"];

  $check = 'SELECT spare_type_code FROM tbl_sparepart_type WHERE spare_type_code = "'.$_POST["spare_type_code"].'" ';
  $rs1 = mysqli_query($connect, $check) or die(mysqli_error());
  $num = mysqli_num_rows($rs1);

  if($num > 0)
  {

    echo "invalid_code";

  }else{

    $spare_type_code = strtoupper(mysqli_real_escape_string($connect, $_POST["spare_type_code"]));
    $spare_type_name = mysqli_real_escape_string($connect, $_POST["spare_type_name"]);
    $status = mysqli_real_escape_string($connect, $_POST["status"]);

            $sql = "INSERT INTO tbl_sparepart_type ( spare_type_code, spare_type_name, status, create_by, create_date )
                    VALuES ( '$spare_type_code','$spare_type_name', '$status', '".$_SESSION["pm_user"]."', NOW() )
                    ";

            $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

            if($rs){
              echo 'insert_ok';
            }else{
              echo $sql;
            }
            mysqli_close($connect);

  }

?>
