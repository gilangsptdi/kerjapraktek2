<?php
include('../include/config.php');
include('./MySQLSessionHandler.php');


session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

session_unset();
session_destroy();

header('Location: ../');
exit;
?>