<?php
session_destroy();
include('../config/const.php');
header("location:".SITEURL.'admin/login.php');
?>