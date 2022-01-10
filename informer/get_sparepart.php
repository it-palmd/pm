<?php

include_once('../include/connectdb.php');

$sql = "SELECT *
        FROM tbl_sparepart
        ORDER BY spare_name_th ASC;
        ";

        $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");
        while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $json[] = $rs;
        }//end whil

        echo json_encode($json, JSON_UNESCAPED_UNICODE);

        mysqli_free_result($result);
        mysqli_close($con);

 ?>
