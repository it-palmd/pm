<?php
	//include connection file
	include_once('../include/connectdb.php');

    $sql = "SELECT repair_code FROM tbl_repair_register AS Q   WHERE id = (SELECT MAX(id) FROM tbl_repair_register)";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$last_id = mysqli_insert_id($connect);

    $d1 = date("Y-m"); //2019-11
    $d2 = date("Y-m",strtotime("first day of next month")); //วันแรกของเดือนถัดไป 2019-12
    $current_y = date("y"); //19
    $current_m = date("m"); //11

    $strNextSeq = "";

		//แยกปีเดือน และ รหัส 1911-119
		$arr = explode("-",$row["repair_code"]);
		$ym = $arr[0];
		$code = $arr[1];

		//แยก ปี และ เดือน
		$arr1 = 	str_split($ym,2);
		$rp_y = $arr1[0];	//ปีจาก PRCODE
		$rp_m = $arr1[1];	//เดือนจาก PRCODE

    // *** Check val = month now ***// เปรียบเทียบเดือนว่าเป็นเดือนปัจจุบันหรือไม่
    if($rp_m == $current_m)
    {
      $code = $code+1;

      $new_repair_code = substr("000".$code,-3,3);   //*** Replace Zero Fill ***//
      $strNextSeq = $current_y.$current_m.'-'.$new_repair_code;

    }
    else  //*** Check val != year now ***//
    {
      $start_repair_code = substr("001",-4,4);   //*** Replace Zero Fill ***//
      $strNextSeq = $current_y.$current_m.'-'.$start_repair_code;

    }
    mysqli_close($connect);

    echo $strNextSeq;

 ?>
