<?php
session_start();
session_destroy();
header("Location: ../studentpage/login.php");
exit();
?>
