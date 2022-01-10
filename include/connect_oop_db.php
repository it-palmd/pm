<?php

$mysqli = mysqli_init();
// ใช้ @ ปิดการแสดง warning ไว้ในกรณีที่เราอยากจะแสดง error message ในแบบของเราเอง
@$mysqli->real_connect('localhost', 'palmd', 'palmd2013', 'palmd');

if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit;
}
// Change character set to utf8
$mysqli->set_charset("utf8");

 ?>
