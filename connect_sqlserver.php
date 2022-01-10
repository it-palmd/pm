<?php
//ส่วนของการเชื่อมต่อ SQLSERVER
  try{
    $conn = new PDO( "sqlsrv:Server=PDSSERV04,1433;Database=ComPDS", "sa", "sa@m1n");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  }
  catch(Exception $e)
  {
    die( print_r( $e->getMessage()));
  }
//End Connect SQLSERVER DB
  $groupCode = trim('G1-PART');
  $tsql = "SELECT * FROM vProduct WHERE ProdGroup = ?";
  $getRS = $conn->prepare( $tsql );
  $getRS->execute( array( $groupCode ) );
  $results = $getRS->fetchAll(PDO::FETCH_BOTH);
  $count = $getRS->rowCount();
  $html = '';

  echo 'จำนวนรายการ: '.$count;
  $html = '<table>';
  $html .= '<tr><th>รหัส</th><th>ชื่อ</th><th>ประเภท</th><th>กลุ่ม</th></tr>';
  foreach($results as $row){
    $html .= '<tr>';
    $html .= '<td>'.$row['ProdCode'].'</td>';
    $html .= '<td>'.$row['ProdTHname'].'</td>';
    $html .= '<td>'.$row['TypeTHname'].'</td>';
    $html .= '<td>'.$row['GroupTHname'].'</td>';
    $html .= '</tr>';
  }
  $html .= '</table>';
  echo $html;
 ?>
