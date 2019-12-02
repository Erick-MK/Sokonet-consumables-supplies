<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'ecommerce');

require __DIR__ . '/config/bootstrap.php';
// include '../opt/lampp/lib/php';
// require (realpath(dirname(__FILE__) . '../opt/lampp/htdocs/complete-php7-ecom-website/config/connect.php'));
// require __DIR__ . '/config/connect.php';
// require '/config/connect.php';
// include_once COMPONENTS . 'security.php';
/* Attempt to connect to MySQL database */
// $connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
// Check connection
// if($connection === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }
// // $dotenv = include "/config/.env";
// $link= $dotenv->required(['DB_HOSTNAME', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

/**
 * Load the bootstrap file.
 */
// require __DIR__ . '/config/bootstrap.php';

if (isset($_POST) && !empty($_POST)) {
    // Variables for the query.
    $email = $database->escape($_POST['email']);
    $password = $database->escape($_POST['password']);
    // Setup the query.
    $query = $database->singleSelect("id, email, password", "users", "WHERE `email`='$email'");


    // If the query is true then setup variables for the login else redirect
    // user telling them their email doesn't exist on the system.
    if ($query !== null) {
        $pass = $query['password'];
        $user = $query['id'];
        // Verify the password. Redirect to my-account on successful login, else
        // redirect with an error message status telling the user they have
        // their email and password incorrect.
        if (password_verify($password, $pass)) {
            $_SESSION['customer'] = $email;
            $_SESSION['customerid'] = $user;
            header("location: my-account.php");
        } else {
            header("location: login.php?message=login-error");
        }
    } else {
        header("location: login.php?message=invalid-account");
    }
}

// Initialize the session
// session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: my-account.php");
//     exit;
// }
 
// //Include config file
// // include "/inc/classes/mysqli.php";
 
// // Define variables and initialize with empty values
// $email = $password = "";
// $email_err = $password_err = "";
 
// // Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
 
//     // Check if email is empty
//     if(empty(trim($_POST["email"]))){
//         $email_err = "Please enter email.";
//     } else{
//         $email = trim($_POST["email"]);
//     }
    
//     // Check if password is empty
//     if(empty(trim($_POST["password"]))){
//         $password_err = "Please enter your password.";
//     } else{
//         $password = trim($_POST["password"]);
//     }
    
//     // Validate credentials
//     if(empty($email_err) && empty($password_err)){
//         // Prepare a select statement
//         $sql = "SELECT id, email, password FROM users WHERE email = ?";
        
//         if($stmt = mysqli_prepare($connection, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_email);
            
//             // Set parameters
//             $param_email = $email;
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Store result
//                 mysqli_stmt_store_result($stmt);
                
//                 // Check if email exists, if yes then verify password
//                 if(mysqli_stmt_num_rows($stmt) == 1){                    
//                     // Bind result variables
//                     mysqli_stmt_bind_result($stmt, $id, $email, $hashedPassword);
//                     if(mysqli_stmt_fetch($stmt)){
//                         if(password_verify($password, $hashedPassword)){
//                             // Password is correct, so start a new session
//                             session_start();
                            
//                             // Store data in session variables
//                             $_SESSION["loggedin"] = true;
//                             $_SESSION['customer'] = $email;                  
//                             $_SESSION['customerid'] = $user;                            
                            
//                             // Redirect user to welcome page
//                             header("location: my-account.php");
//                         } else{
//                             // Display an error message if password is not valid
//                             $password_err = "The password you entered was not valid.";
//                         }
//                     }
//                 } else{
//                     // Display an error message if email doesn't exist
//                     $email_err = "No account found with that email.";
//                 }
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }
        
//         // Close statement
//         mysqli_stmt_close($stmt);
//     }
    
//     // Close connection
//     mysqli_close($connection);
// }

?>