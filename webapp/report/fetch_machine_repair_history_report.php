<?php
//fetch.php
include_once('../../include/connectdb.php');

// $columns = array('id', 'repair_date', 'repair_code', 'repair_symptom', 'sparepart_use', 'repair_time', 'tech_leader');

$query = "
          SELECT
            a.repair_date, a.repair_code, a.repair_symptom, a.repair_detail,a.sparepart_use, a.working_day_stop, TIMEDIFF(a.working_day_stop, a.working_day) repair_time, a.tech_leader
          FROM tbl_repair_register AS a
        ";

$query .= " WHERE ";

if($_POST["is_date_search"] == "yes")
{
  $query .= ' a.repair_spare_code = "'.$_POST["sp_code"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= ' ORDER BY a.repair_date ASC ';
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

  $sub_array = array();

  $sub_array[] = $no++;
  $sub_array[] = $row['repair_date'];
  $sub_array[] = $row["repair_code"];
  $sub_array[] = $row["repair_symptom"];
  $sub_array[] = $row["repair_detail"];
  $sub_array[] = $row["sparepart_use"];
  //ชม. ปฏิบัติงาน
  if($row["working_day_stop"] == "0000-00-00 00:00:00"){
    $sub_array[] = "";
  }else{
    $sub_array[] = $row["repair_time"];
  }

  $sub_array[] = $row["tech_leader"];
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



?>
