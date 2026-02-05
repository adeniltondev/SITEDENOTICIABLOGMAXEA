<?php
require __DIR__ . '/../includes/functions.php';
start_session_if_needed();
$_SESSION = [];
session_destroy();
header('Location: ' . base_url('admin/login.php'));
exit;
