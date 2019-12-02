<?php

error_reporting(0);

/**
 * Get and Set the environment variables.
 */
// $dbHost     = getenv("DB_HOST");
// $dbUsername = getenv("DB_USERNAME");
// $dbPassword = getenv("DB_PASSWORD");
// $database   = getenv("DB_DATABASE");

// $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $database);

// if ($connection->connect_error && $debug == true) {
//     echo "Error: Unable to connect to MySQL.<br>" . PHP_EOL;
//     echo "Debug Error Number: " . mysqli_connect_errno() . "<br>" . PHP_EOL;
//     echo "Debug Error: " . mysqli_connect_error() . "<br>" . PHP_EOL;
//     exit;
// } elseif ($connection->connect_error) {
//     echo "Error: Unable to connect to the Database Server.<br>" . PHP_EOL;
// }

$connection = mysqli_connect('localhost', 'root', '', 'ecommerce');
if(mysqli_connect_error()) {
    echo "Failed to connect " . mysqli_connect_error();
    exit();
}
