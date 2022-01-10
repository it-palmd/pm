<?php
//fetch.php
include_once('../../../include/connect_oop_db.php');

$columns = array('id', 'spare_sub_code', 'spare_sub_name_th', 'spare_sub_warehouse', 'spare_sub_price', 'spare_sub_stock', 'spare_sub_remaining_amount', 'status');

$query = "SELECT *
          FROM tbl_sparepart_sub
        ";

$query .= " WHERE 1 AND ";

// if($_POST["is_date_search"] == "yes")
// {
//   $query .= ' MONTH(a.repair_date) = "'.$_POST["month"].'" AND YEAR(a.repair_date) = "'.$_POST["year"].'" AND ';
// }else{
//   $query .= ' MONTH(a.repair_date) = "'.$_POST["month"].'" AND YEAR(a.repair_date) = "'.$_POST["year"].'" AND ';
// }

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (
    spare_sub_code LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_sub_name_th LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_sub_warehouse LIKE "%'.$_POST["search"]["value"].'%"
    OR spare_sub_price LIKE "%'.$_POST["search"]["value"].'%"
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
 $query .= ' ORDER BY spare_sub_code DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$result1 = $mysqli->query($query);
$number_filter_row = $result1->num_rows;

$result = $mysqli->query($query . $query1);

$data = array();
$date1 = "";

$no =  1;
while($row = $result->fetch_object())
{

  $sub_array = array();

  $sub_array[] = $no++;
  $sub_array[] = $row->spare_sub_code;
  $sub_array[] = $row->spare_sub_type;
  $sub_array[] = $row->spare_sub_name_th;
  $sub_array[] = $row->spare_sub_spec;
  $sub_array[] = $row->spare_sub_model;
  $sub_array[] = $row->spare_sub_warehouse;
  $sub_array[] = $row->spare_sub_price;
  $sub_array[] = $row->spare_sub_stock;
  $sub_array[] = $row->spare_sub_remaining_amount;
  $sub_array[] = $row->status;
  $data[] = $sub_array;

  // if($status == 'Active') $status = 'พร้อมใช้งาน';
  // if($status == 'Wait_assignment') $status = 'รอ PM มอบหมายงาน';
  // if($status == 'Wait_technician') $status = 'รอช่างรับงาน';
  // if($status == 'In_progress') $status = 'กำลังดำเนินงาน';
  // if($status == 'Wait_to_check') $status = 'รอตรวจงาน';


}

 $sql = "SELECT * FROM tbl_sparepart_sub";
 $result2 = $mysqli->query($sql);
 $all_data = $result2->num_rows;


$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  => intval($all_data),
 "recordsFiltered" => intval($number_filter_row),
 "data"    => $data
);

echo json_encode($output);

$result->free();
$result1->free();
$result2->free();
$mysqli->close();

?>
