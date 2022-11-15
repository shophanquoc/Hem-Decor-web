<?php
session_start ();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
if(count($_POST)>0) {
    $keyword=$_POST['keyword'];
    $sort = $_SESSION['sort'];
    echo "<script>window.open('manage_orders.php?sort=$sort&search=$keyword', '_self')</script>";   
}
?>