<?php
//fetch.php
include_once('../../include/connectdb.php');

$query = "SELECT a.repair_spare_code, CONCAT(b.spare_name_th,' (', b.spare_name_en,')') AS repair_spare_name,
          b.spare_location, count(repair_spare_code) c_rsc
          FROM `tbl_repair_register` a
          INNER JOIN tbl_sparepart AS b ON a.repair_spare_code = b.spare_code
        ";

$query .= " WHERE ";

if($_POST["is_date_search"] == "yes")
{
  if($_POST["month"] != 'all'){
    $query .= ' MONTH(a.repair_date) = "'.$_POST["month"].'" AND YEAR(a.repair_date) = "'.$_POST["year"].'" AND ';
  }else{
    $query .= ' YEAR(a.repair_date) = "'.$_POST["year"].'" AND ';
  }
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (
    repair_spare_code LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_name_th LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_location LIKE "%'.$_POST["search"]["value"].'%"
  )
 ';
}

$query .= " GROUP BY repair_spare_code ";

if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}else{
    $query .= ' ORDER BY c_rsc DESC ';
}

$query1 = '';

if($_POST["length"] != -1){
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

$date1 = "";

$no =  1;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{

  $sub_array = array();

  $sub_array[] = $no++;
  $sub_array[] = $row["repair_spare_code"];
  $sub_array[] = $row["repair_spare_name"];
  $sub_array[] = $row["spare_location"];
  $sub_array[] = $row["c_rsc"];
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
