<?php
session_start ();
include('../database/dbcon.php');
if(count($_POST)>0) {
    if($_GET['type'] == "category"){
        $category=$_POST['keyword'];
        echo "<script>window.open('manage_category.php?search=$category', '_self')</script>";   
    } elseif($_GET['type'] == "product"){
        $product=$_POST['keyword'];
        echo "<script>window.open('storage.php?search=$product', '_self')</script>";   
    }
}
?>