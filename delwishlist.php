<?php

/**
 * Load the bootstrap file.
 */
require __DIR__ . '/config/bootstrap.php';

// We use ouput buffering here because we want to modify the headers after
// sending the content when we redirect the user to the login page.
ob_start();
$uid = $_SESSION['customerid'];
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}

if (isset($_GET['id']) & !empty($_GET['id'])) {
    $id = $_GET['id'];
    echo $sql = "DELETE FROM wishlist WHERE id=$id";
    $res = mysqli_query($connection, $sql);
    if ($res) {
        header('location: wishlist.php');
        //echo "redirect to wish list page";
    }
} else {
    header('location: wishlist.php');
}

/**
 * Flush the object cache.
 */
ob_flush();
