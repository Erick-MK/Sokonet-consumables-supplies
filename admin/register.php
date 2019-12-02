<?php


/**
 * Load the bootstrap file.
 */
require '../config/bootstrap.php';

/**
 * Load the security component to hash the password.
 */
// include_once COMPONENTS . 'security.php';

    // Sanitise the input methods for XSS Attacks.
    $firstname= 'barry';
    $lastname= 'allen';
    $email = 'admin@gmail.com';
    $password = 'pass';

    // Set the password using a hash.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Setup the insert statement.
    $tableName = 'admin';
    $data = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
    	'email' => $email,
        'password' => $hashedPassword
        
    );
    $query = $database->insert($tableName, $data);
    if($query) {
        echo "Created admin";
    } else {
        echo "Could not create admin"; 
    }
