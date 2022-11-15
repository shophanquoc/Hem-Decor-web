<?php
session_start();
session_destroy();

header('location: ../anon/homepage.php');

?>