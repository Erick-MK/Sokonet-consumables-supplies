<?php


/**
 * Use the DS to separate the directories in other defines.
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * The full path to the directory WITHOUT a trailing DS.
 */
define('ROOT', dirname(__DIR__));

/**
 * Path to the config directory.
 */
define('CONFIG', ROOT . DS . 'config' . DS);

/**
 * Path to the vendor directory.
 */
define('VENDOR', ROOT . DS . 'vendor' . DS);

/**
 * Path to the includes directory.
 */
define('INC', ROOT . DS . 'inc' . DS);

/**
 * Path to the classes include directory.
 */
define('CLASSES', INC . 'classes' . DS);

/**
 * Path to the components include directory.
 */
define('COMPONENTS', INC . 'components' . DS);

/**
 * Path to the Admin includes directory.
 */
define('ADMIN_INC', ROOT . DS . 'admin' . DS . 'inc' . DS);
