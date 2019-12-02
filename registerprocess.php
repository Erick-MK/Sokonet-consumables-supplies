<?php

require __DIR__ . '/config/bootstrap.php';

/**
 * Load the security component to hash the password.
 */
include_once COMPONENTS . 'security.php';

// Check that the passwords match and this is a $_POST request before we even
// think about doing anything.
if (isset($_POST) && !empty($_POST) && $_POST['password'] === $_POST['password_again']) {
    // Sanitise the input methods for XSS Attacks.
    $email = $database->escape($_POST['email']);
    $password = $database->escape($_POST['password']);

    // Set the password using a hash.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Setup the insert statement.
    $tableName = 'users';
    $data = array(
    	'email' => $email,
    	'password' => $hashedPassword
    );
    $query = $database->insert($tableName, $data);

    if ($query === TRUE) {
        $_SESSION['customer'] = $email;
        $_SESSION['customerid'] = $database->insert_id;
        header("location: my-account.php");
    } else {
        header("location: login.php?message=general-error");
    }
} else {
    // Redirect back to login with the password error message.
    header("location: login.php?message=password-mismatch");
}
