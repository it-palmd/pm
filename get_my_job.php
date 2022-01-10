<?php

$username = @$_POST['username'];
$level = @$_POST['level'];

// $username = 'test1';
// $level = 'technician';

	include_once('include/connectdb.php');

		// $today = date("Y-m-d");	//2019-12-08
    $sql = "SELECT COUNT(repair_code)
						FROM tbl_repair_register
						";
		if($level == 'informer'){
				$sql .= " WHERE repair_informer = '$username' AND status = 'Wait_to_check' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
		}
		else if($level == 'assignment'){
				$sql .= " WHERE status = 'Wait_assignment' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
		}
		else if($level == 'technician'){
				$sql .= " WHERE status = 'In_progress' OR status = 'Wait_technician' ";		//DISTINCT นับเฉพาะข้อมูลที่ไม่ซ้ำกัน
		}

    $result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");

    $rs = mysqli_fetch_array($result, MYSQLI_NUM);

		echo $rs[0];
		// echo 0;

		mysqli_free_result($result);
    mysqli_close($con);

 ?>
