<?php

  $connect = mysqli_connect('localhost', 'palmd', 'palmd2013', 'palmd');
  mysqli_set_charset($connect, "utf8");

  // echo $_POST["id"];

    $sql = "SELECT * FROM tbl_users WHERE id = ".$_POST["id"];
    $rs = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)){
      $arr[] = $row;
    }

    echo json_encode($arr);

    mysqli_free_result($rs);
    mysqli_close($connect);

 ?>
