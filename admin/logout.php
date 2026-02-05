<?php
require __DIR__ . '/../includes/functions.php';
start_session_if_needed();
$_SESSION = [];
session_destroy();
header('Location: /admin/login.php');
exit;
