<?php

	include_once('include/connectdb.php');

		// $today = date("Y-m-d");	//2019-12-08

    $sql = "SELECT CONCAT(emp_code,' - ',emp_firstname,'  ',emp_lastname)AS fullname
						FROM tbl_employee
						WHERE emp_group = 'TECH'
						AND emp_status != 'ลาออก'
						";

						$result = mysqli_query($con, $sql) or die(mysqli_error(). "<hr/>Line: ".__LINE__."<br/>$sql");
						while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						  $json[] = $rs;
						}//end while

						echo json_encode($json, JSON_UNESCAPED_UNICODE);

						mysqli_free_result($result);
						mysqli_close($con);

 ?>
