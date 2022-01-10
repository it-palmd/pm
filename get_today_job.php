<?php

	include_once('include/connectdb.php');

		// $today = date("Y-m-d");	//2019-12-08

    $sql = "SELECT COUNT(DATE_FORMAT(repair_date, '%Y-%m-%d')) AS job_count
						FROM tbl_repair_register
						WHERE DATE_FORMAT(repair_date, '%Y-%m-%d') = Date_format(NOW(),'%Y-%m-%d')
						";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน

    $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

    $rs = mysqli_fetch_array($result, MYSQLI_NUM);

		echo $rs[0];

		mysqli_free_result($result);
    mysqli_close($con);

 ?>
