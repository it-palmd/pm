<?php

//logout.php
session_start();
unset($_SESSION["pm_user"]);
unset($_SESSION["pm_emp_code"]);
unset($_SESSION["pm_level"]);
unset($_SESSION["pm_emp_fullname"]);
unset($_SESSION["pm_ses_page"]);
// session_destroy();
// header("location:login.php");
echo 0;
?>
