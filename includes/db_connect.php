<?php
    $dbhost = 'remotemysql.com:3306';
    $dbuser = 'wuhlYcf1xv';
    $dbpass = 'WUAVVGNlxg';
    $dbname = 'wuhlYcf1xv';
    $dbconn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
    }
?>
