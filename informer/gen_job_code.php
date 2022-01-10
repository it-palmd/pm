<?php
// $code = 'JOB-001';
include_once('../include/connectdb.php');

    $sql = "SELECT repair_code
            FROM tbl_repair_register AS Q
            WHERE id = (SELECT MAX(id) FROM tbl_repair_register)";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $this_month = date("Y-m"); //2019-11
    $next_month = date("Y-m",strtotime("first day of next month")); //วันแรกของเดือนถัดไป 2019-12

    $strNextSeq = "";

    // echo strtotime($this_month).' < '.strtotime($next_month).' ,';

    // *** Check val = month now ***// เปรียบเทียบเดือนว่าเป็นเดือนปัจจุบันหรือไม่
    if(strtotime($this_month) < strtotime($next_month))
    {
      //แยกปีเดือน และ รหัส 1911-119
      if(mysqli_num_rows($result)>0){
    		$arr = explode("-",$row["repair_code"]);
    		$str = $arr[0]; //JOB
    		$code = $arr[1];  //001

        $code = $code+1;

        $new_prcode = substr("0000".$code,-4,4);   //*** Replace Zero Fill ***//
        $strNextSeq = 'JOB-'.$new_prcode;
      }else{
        $start_code = substr("0001",-5,5);   //*** Replace Zero Fill ***//
        $strNextSeq = 'JOB-'.$start_code;
      }

    }
    else  //*** Check val != year now ***//
    {
      $start_code = substr("0001",-5,5);   //*** Replace Zero Fill ***//
      $strNextSeq = 'JOB-'.$start_code;

    }

    mysqli_free_result($result);
    mysqli_close($con);

    echo $strNextSeq;

 ?>
