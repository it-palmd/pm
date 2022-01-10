<?php
//fetch.php
$tech_code = $_POST["tech_code"];

include_once('../include/connect_oop_db.php');

$sql = "SELECT emp_code, CONCAT(emp_code,' - ',emp_firstname,' ',emp_lastname) AS tech_name
        FROM tbl_employee
        /*WHERE emp_group = '$tech_code'*/
        ORDER BY emp_firstname ASC
        ";

        $result = $mysqli->query($sql);

        $output = '<option value=""> --- ระบุช่าง --- </option>';

                  while ($rs = $result->fetch_assoc()) {
        $output .= '<option value="'.$rs['tech_name'].'">'.$rs['tech_name'].'</option>';
                  }//end while

echo $output;

?>
