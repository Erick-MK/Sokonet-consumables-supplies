<?php

 
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    trigger_error('Your PHP version must be equal or higher than 7.0.0 to use this app.' . PHP_EOL, E_USER_ERROR);
}
