<?php

function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));

$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));

$thaiweek = Array("","วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");
$thaimonth = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

$strMonthThai = $thaimonth[$strMonth];

return "$strDay $strMonthThai $strYear $strHour:$strMinute";

}

$strDate = date('Y-m-d H:i:s');
echo "Time now : ".DateThai($strDate);

//technician
$tech = array('aa', 'bb', 'cc', 'dd','ee');
echo "I like " . $tech[0] . ", " . $tech[1] . " and " . $tech[2] . ".";


?>
