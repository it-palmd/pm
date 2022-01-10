<?php
//fetch.php
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

// echo $start_date.' - '.$end_date;

include_once('../../include/connectdb.php');

$columns = array('id', 'repair_date', 'repair_code', 'repair_type', 'repair_spare_code', 'spare_name_th', 'spare_location',  'repair_symptom', 'repair_informer', 'tech_group');

$query = "SELECT
            a.repair_date, a.repair_code, a.repair_type, a.repair_spare_code, a.repair_symptom, a.repair_informer, b.spare_name_th, a.tech_group, b.spare_location,
            CONCAT(b.spare_name_th,' (', b.spare_name_en,')') AS repair_spare_name,
            CONCAT(e.emp_firstname,'  ',e.emp_lastname) AS informer_name,
            (SELECT tech_type_name FROM tbl_tech_type WHERE tech_type_code = a.tech_group) as tech_group,
            tt.tech_type_name
          FROM tbl_repair_register AS a
          INNER JOIN tbl_sparepart AS b ON a.repair_spare_code = b.spare_code
          INNER JOIN tbl_employee AS e ON e.emp_code = a.repair_informer
          INNER JOIN tbl_tech_type AS tt ON tt.tech_type_code = a.tech_group
        ";

$query .= " WHERE a.status != 'Active' AND ";

if($start_date != '' && $end_date != ''){
  $query .= " DATE_FORMAT(a.repair_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (
    repair_date LIKE "%'.$_POST["search"]["value"].'%"
    OR repair_code LIKE "%'.$_POST["search"]["value"].'%"
    OR repair_type LIKE "%'.$_POST["search"]["value"].'%"
    OR repair_spare_code LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_name_th LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_location LIKE "%'.$_POST["search"]["value"].'%"
    OR repair_symptom LIKE "%'.$_POST["search"]["value"].'%"
    OR repair_informer LIKE "%'.$_POST["search"]["value"].'%"
    OR emp_firstname LIKE "%'.$_POST["search"]["value"].'%"
    OR emp_lastname LIKE "%'.$_POST["search"]["value"].'%"
    OR tech_type_name LIKE "%'.$_POST["search"]["value"].'%"
  )
 ';
}

if(isset($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= ' ORDER BY repair_code DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
$date1 = "";
$no =  1;

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
  $repair_date = $row['repair_date'];
  $repair_code = $row["repair_code"];

  $sub_array = array();

  $sub_array[] = $no++;

  if($date1 != $repair_date){
    $date1 = $repair_date;
    $sub_array[] = $repair_date;
   }else{
    $sub_array[] = "";
  }
  $sub_array[] = $repair_code;
  $sub_array[] = $row["repair_type"];
  $sub_array[] = $row["repair_spare_code"];
  $sub_array[] = $row["repair_spare_name"];
  $sub_array[] = $row["spare_location"];
  $sub_array[] = $row["repair_symptom"];
  $sub_array[] = $row["informer_name"];
  $sub_array[] = $row["tech_group"];
  $data[] = $sub_array;

}

function get_all_data($connect)
{
 $query = "SELECT * FROM tbl_repair_register";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);


//Function ThaiDate
function thaidate1($str){
    if($str == "0000-00-00") { return "-"; }
    $y = substr($str, 0, 4) + 543;
    $m = substr($str, 5, 2) + 0;
    $d = substr($str, 8, 2);
    $month = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    return $d . "/" . $m . "/" . $y;
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

?>
