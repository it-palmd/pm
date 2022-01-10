<?php

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["system"];

    $sql = "SELECT * FROM tbl_users_level WHERE system = '".$_POST["system"]."' ";

    $rs = mysqli_query($connect, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)){
      $arr[] = $row;
    }

    echo json_encode($arr);

    mysqli_free_result($rs);
    mysqli_close($connect);

 ?>
