<?php

require __DIR__ . '/config/bootstrap.php';

unset($_SESSION['cart']);
unset($_SESSION['customer']);
header('location: login.php');
