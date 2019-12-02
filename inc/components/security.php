<?php

/**
 * This method hashes all the passwords using either Argon2, for PHP >= 7.2.0,
 * or Bcrypt on versions below 7.2.0.
 *
 * @param  string      $pass Password string from $_POST data.
 *
 * @return string|null Returns the Hashed password.
 */
function PasswordHash($pass)
{
    $phpVersion = phpversion();
    if ($phpVersion >= '7.2.0') {
        // This is the Argon2 method which only works on PHP 7.2.* upwards as it
        // was only introduced in 7.2.0.
        $password = password_hash($pass, PASSWORD_ARGON2I);
        return $password;
    } else {
        // Set the options with the cost param. 12 is quite high so if your
        // server is slowing down on login/register then change this to 10. The
        // base of 10 should be fine for most servers.
        $options = [
         'cost' => '12',
     ];
        $password = password_hash($pass, PASSWORD_BCRYPT, $options);
        return $password;
    }
}
