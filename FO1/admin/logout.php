<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
exit();
