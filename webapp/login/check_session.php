<?php

//check_session.php

session_start();

if(isset($_SESSION["pm_user"]))
{
 echo '0';
}
else
{
 echo '1';
}

?>
