<?php
if (function_exists('mysqli_connect')) {
    echo "MySQLi is enabled and working!";
} else {
    echo "MySQLi is not enabled.";
}
?>
