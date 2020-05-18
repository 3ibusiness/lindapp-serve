<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 5/16/20
 * Time: 12:36 PM
 *
 *  Database credentials. Assuming you are running MySQL
 * server with default setting (user 'root' with no password)
 */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lindapp');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
