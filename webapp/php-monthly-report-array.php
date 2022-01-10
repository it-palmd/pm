<html>
<head>
<title>SunZan-Desgin.Com</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<style>
.number{ text-align : right;}
.number div{
	background: #91F7A4;
	color : #ff0000;
}
#test_report th{ background-color : #21BBD6; color : #ffffff;}
#test_report{
	border-right : 1px solid #eeeeee;
	border-bottom : 1px solid #eeeeee;
}
#test_report td,#test_report th{
	border-top : 1px solid #eeeeee;
	border-left : 1px solid #eeeeee;
	padding : 2px;
}
#txt_year{ width : 70px;}
.fail{ color : red;}
</style>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<table>
		<tr>
			<td>ระบุเดือน-ปี : </td>
			<td>
				<select name="txt_month">
					<option value="">--------------</option>
					<?php
					$month = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน',
									'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม',
									'09' => 'กันยายน ', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
					$txtMonth = isset($_POST['txt_month']) && $_POST['txt_month'] != '' ? $_POST['txt_month'] : date('m');
					foreach($month as $i=>$mName) {
						$selected = '';
						if($txtMonth == $i) $selected = 'selected="selected"';
						echo '<option value="'.$i.'" '.$selected.'>'. $mName .'</option>'."\n";
					}
					?>
				</select>
			</td>
			<td>
				<select name="txt_year">
					<option value="">--------------</option>
					<?php
					$txtYear = (isset($_POST['txt_year']) && $_POST['txt_year'] != '') ? $_POST['txt_year'] : date('Y');

					$yearStart = date('Y');
					$yearEnd = $txtYear-5;

					for($year=$yearStart;$year > $yearEnd;$year--){
						$selected = '';
						if($txtYear == $year) $selected = 'selected="selected"';
						echo '<option value="'.$year.'" '.$selected.'>'. ($year+543) .'</option>'."\n";
					}
					?>
				</select>
			</td>
			<td><input type="submit" value="ค้นหา" /></td>
		</tr>
	</table>
</form>
<?php

//รับค่าตัวแปรที่ส่งมาจากแบบฟอร์ม HTML
$year = $_POST['txt_year'];
$month = $_POST['txt_month'];

if($year == '' || $month == '') exit('<p class="fail">กรุณาระบุ "เดือน-ปี" ที่ต้องการเรียกรายงาน</p>');

//เปิดการเชื่อมต่อฐานข้อมูล sunzandesign
//mysql_connect("localhost","root","abcd1234");  //ข้อมูลนี้ได้มาจากตอนติดตั้งเว็บเซิร์ฟเวอร์
$connect = mysqli_connect("localhost", "root", "", "pds_pm");
mysqli_set_charset($connect, "utf8");



//เรียกข้อมูลการจองของเดือนที่ต้องการ
$allReportData = array();
$strSQL = "SELECT DAY(`repair_date`) AS day, COUNT(*) AS numRepair FROM `tbl_repair_register` ";
$strSQL.= "WHERE `repair_date` LIKE '$year-$month%' ";
$strSQL.= "GROUP by DAY(`repair_date`)";
$qry = mysqli_query($connect, $strSQL);
while($row = mysqli_fetch_array($qry, MYSQLI_ASSOC)){
	$allReportData[$row['day']] = $row['numRepair'];
}

echo $strSQL;

echo "<table border='0' id='test_report' cellpadding='0' cellspacing='0'>";
echo '<tr>';//เปิดแถวใหม่ ตาราง HTML
echo '<th>รายละเอียด/วัน</th>';

//วันที่สุดท้ายของเดือน
$timeDate = strtotime($year.'-'.$month."-01");  //เปลี่ยนวันที่เป็น timestamp
$lastDay = date("t", $timeDate);   				//จำนวนวันของเดือน

//สร้างหัวตารางตั้งแต่วันที่ 1 ถึงวันที่สุดท้ายของดือน
for($day=1;$day<=$lastDay;$day++){
	echo '<th>' . substr("0".$day, -2) . '</th>';
}
echo "</tr>";

	echo '<tr>';//เปิดแถวใหม่ ตาราง HTML
	echo '<td>จำนวนใบแจ้งซ่อมประจำวัน </td>';

	//เรียกข้อมูลการจองของพนักงานแต่ละคน ในเดือนนี้
	for($j=1;$j<=$lastDay;$j++){
		$numBook = isset($allReportData[$j]) ? '<div>'.$allReportData[$j].'</div>' : 0;
		echo "<td class='number'>", $numBook, "</td>";
	}

	echo '</tr>';//ปิดแถวตาราง HTML

echo "</table>";

mysqli_close($connect);//ปิดการเชื่อมต่อฐานข้อมูล
?>
