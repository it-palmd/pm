<?php
require('dist/for_report/fpdf17/fpdf.php');
define('FPDF_FONTPATH','font/');

// echo $_POST['month'].' '. $_POST['year'];

$connect = mysqli_connect("localhost", "root", "", "pds_pm");
mysqli_set_charset($connect, "utf8");

Class PDF extends FPDF{
  function Header(){
    $this->AddFont('angsa','','angsa.php');
    $this ->setFont('angsa','',18);
    $this->Image('images/PDS-Logo-03.jpg',8,11,45);      // Logo
    // $this->Cell(80);   //Center แนวตั้ง
    $this ->line(7,10,290,10); //เส้นแนวนอนบน
    $this ->line(7,30,7,10); //เส้นแนวตั้งซ้าย
    $this->Cell(120); //Center แนวนอน // Move to the right
    $this->Cell(30,15,iconv("UTF-8","TIS-620", 'รายงานแจ้งซ่อมรายเดือน '.$_POST["m_text"].' '.$_POST["y_text"]),0,1,'C');   // Title1
    $this->Cell(120); //Center แนวนอน
    $this ->setFont('angsa','',16);
    $this->Cell(30,-5,iconv("UTF-8","TIS-620", '(ทุกแผนก)'),0,1,'C'); // Title2
    // $this ->line(5,30,290,30);  //เส้นแนวนอนล่าง
    $this ->line(240,30,240,10); //เส้นแนวตั้งขวา1
    $this->Cell(240); //Center แนวนอน
    $this->Cell(30,-5,iconv("UTF-8","TIS-620", 'เลขที่เอกสาร'),0,1,'C'); // Title2
    $this->Cell(240); //จัดตำแหน่ง
    $this ->setFont('angsa','',14);
    $this->Cell(30,15,iconv("UTF-8","TIS-620", 'MT-FR-??'),0,1,'C'); // Title2
    $this ->line(290,30,290,10); //เส้นแนวตั้งขวา2
    // $this->SetDrawColor(0,80,180); //สีเส้นขอบ
    // $this->SetTextColor(220,50,50); //สีตัวหนังสือ
    $this->Cell(-3); //Center แนวนอน // Move to the right
    $this->Cell(10,7,iconv("UTF-8","TIS-620", 'ลำดับ'),1,0,'C'); //Header Table
    $this->Cell(30,7,iconv("UTF-8","TIS-620", 'วันที่/เวลา'),1,0,'C'); //Header Table
    $this->Cell(20,7,iconv("UTF-8","TIS-620", 'เลขที่แจ้งซ่อม'),1,0,'C'); //Header Table
    $this->Cell(20,7,iconv("UTF-8","TIS-620", 'ประเภทงาน'),1,0,'C'); //Header Table
    $this->Cell(18,7,iconv("UTF-8","TIS-620", 'รหัสเครื่องจักร'),1,0,'C'); //Header Table
    $this->Cell(50,7,iconv("UTF-8","TIS-620", 'ชื่อเครื่องจักร'),1,0,'C'); //Header Table
    $this->Cell(85,7,iconv("UTF-8","TIS-620", 'อาการ'),1,0,'C'); //Header Table
    $this->Cell(20,7,iconv("UTF-8","TIS-620", 'ผู้แจ้ง'),1,0,'C'); //Header Table
    $this->Cell(30,7,iconv("UTF-8","TIS-620", 'สถานะ'),1,0,'C'); //Header Table
    $this->Ln();
  }
  function Footer(){
    // $this ->SetLineWidth(0,5);
    $this ->AddFont('angsa','','angsa.php');
    $this ->setFont('angsa','',14);
    $this ->SetY(-12);
    // $this ->line(5,193,290,193); //เส้นแนวนอน L-margin, Y-L, length, Y-R
    // $this ->line(5,184,5,193); //เส้นแนวตั้งขวา1
    // $this ->line(290,184,290,193); //เส้นแนวตั้งขวา2
    $this->Cell(30,-18,iconv("UTF-8","TIS-620", 'วันที่เริ่มใช้งาน: 01/08/2559'),0,1,'C');   // Title1
    $this->Cell(35); //Center แนวนอน
    $this->Cell(30,18,iconv("UTF-8","TIS-620", 'แก้ไขครังที่: 00'),0,1,'C');   // Title1
    $this->Cell(275); //Center แนวนอน
    $this ->setFont('angsa','',10);
    $this->Cell(0,1,iconv("UTF-8","TIS-620", 'หน้า '. $this->PageNo().'/{nb}'),0,0,'C');   // Title1
  }

  function viewTable($connect, $month, $year){
    $t = 0;
    $date1 = "";
    $prcode = "";
    $prdatedesired = "";

          $sql = "
                  SELECT
                    a.repair_date, a.repair_code, a.repair_type, a.repair_spare_code, a.repair_symptom, a.repair_informer, b.spare_name_th, a.status,
                    CONCAT(b.spare_name_th,' ( ', b.spare_name_th,' )') AS repair_spare_name
                  FROM tbl_repair_register AS a
                  INNER JOIN tbl_sparepart AS b ON a.repair_spare_code = b.spare_code
                  WHERE MONTH(a.repair_date) = $month AND YEAR(a.repair_date) = $year
                  ORDER BY a.repair_date, a.repair_code ASC
                ";

          $result = mysqli_query($connect, $sql);

          while($data = mysqli_fetch_array($result)){

            $repair_date = $data['repair_date'];
            $repair_code = $data['repair_code'];
            // $dod = $data["pr_date_of_desired"];


            $this ->setFont('angsa','',12);
            $this->Cell(-3); //Center แนวนอน // Move to the right
            // if($prcode != $pc){
              $this->Cell(10,7,$t+=1,1,0,'C'); //Header Table นับจำนวนเพิ่มค่าไปเรื่อยๆ 'LR' คือ ไม่มีเส้นล่า
            // }else{
            //   $this->Cell(10,7, "",1,0,'C');
            // }
            // if($date1 != $dt){
            //   $date1 = $dt;
              // $this->Cell(20,7,iconv("UTF-8","TIS-620", thai_date($repair_date)),1,0,'C');
              $this->Cell(30,7,iconv("UTF-8","TIS-620", $repair_date),1,0,'C');
            // }else{
            //   $this->Cell(20,7, "",1,0,'C');
            // }
            // if($prcode != $pc){
            //   $prcode = $pc;
              $this->Cell(20,7,iconv("UTF-8","TIS-620", $repair_code),1,0,'C');
            // }else{
            //   $this->Cell(20,7, "",1,0,'C');
            // }
            $this->Cell(20,7,iconv("UTF-8","TIS-620//TRANSLIT", $data['repair_type']),1,0,'C');
            $this->Cell(18,7,iconv("UTF-8","TIS-620//TRANSLIT",$data['repair_spare_code']),1,0,'C');
            // if($prdatedesired != $dod){
            //   $prdatedesired = $dod;
              $this->Cell(50,7,iconv("UTF-8","TIS-620//TRANSLIT", $data['spare_name_th']),1,0,'L');
            // }else{
            //   $this->Cell(20,7, '""',1,0,'C');
            // }
            $this->Cell(85,7,iconv("UTF-8","TIS-620//TRANSLIT", $data['repair_symptom']),1,0,'L');
            $this ->setFont('angsa','',11);
            $this->Cell(20,7,iconv("UTF-8","TIS-620//TRANSLIT", $data["repair_informer"]),1,0,'C');

            $status = $data['status'];
            if($status == 'Active') $status = 'พร้อมใช้งาน';
            if($status == 'Wait_assignment') $status = 'รอ PM มอบหมายงาน';
            if($status == 'Wait_technician') $status = 'รอช่างรับงาน';
            if($status == 'In_progress') $status = 'กำลังดำเนินงาน';
            if($status == 'Wait_to_check') $status = 'รอตรวจงาน';

            $this ->setFont('angsa','',12);
            $this->Cell(30,7,iconv("UTF-8","TIS-620//TRANSLIT", $status),1,0,'C');
            $this->Ln();
          }
          //End While Loop
  }
  //End Function viewTable
}
//End Class PDF

function thai_date($str){
    if($str == "0000-00-00") { return "-"; }
    $y = substr($str, 0, 4) + 543;
    $m = substr($str, 5, 2) + 0;
    $d = substr($str, 8, 2);
    $month = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    return $d . "/" . $m . "/" . $y; //$month[$m-1]
}
function thaidate($str){
    if($str == "0000-00-00") { return "ไม่ได้กำหนด"; }
    $m = substr($str, 5, 2) + 0;
    $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน.", "ธันวาคม");
    return $month[$m-1];
}

  $date = date("Y-m-d");

function getNumDaynews($d1,$d2){
    $dArr1 = preg_split("/-/", $d1);
    list($year1, $month1, $day1) = $dArr1;
    $Day1 = mktime(0,0,0,$month1,$day1,$year1);
    $dArr2 = preg_split("/-/", $d2);
    list($year2, $month2, $day2) = $dArr2;
    $Day2 = mktime(0,0,0,$month2,$day2,$year2);
    return round(abs( $Day2 - $Day1 ) / 86400 )+1;
}
//end Class

	$pdf=new PDF();
  $pdf->AliasNbPages();
	$pdf->AddPage('L','','A4');
	$pdf->AddFont('angsa','','angsa.php');
  $pdf->viewTable($connect, $_POST['month'], $_POST['year']);
  $pdf->Output("report_pm_monthly.pdf","I");

  mysqli_close($connect);


 ?>
