<?php

$username = 'root';
$password = '';
try {
  /// Handler for MySQL
$connection = new PDO( 'mysql:host=localhost;dbname=pds_pm', $username, $password );
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
