<?php
session_start();
$_SESSION = array();
        $is_admin = false;
header("location: index.php");
exit();
?>