<?php
session_start();
if ($_SESSION['status'] == 'a') {
    include("navBarAdmin.php");
} elseif ($_SESSION['status'] == 'c') {
    include("navBarDeco.php");
} else {
    include("navBar.php");
}
?>