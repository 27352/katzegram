<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    // Check if user already exists
    $sql = "SELECT * FROM users";
    $res = $dbconn->query($sql);
    $jsn = array();

    if ($res->num_rows > 0) {
        while( $row = $res->fetch_assoc() ) {
            array_push($jsn, assocToJson($row));
        }
    }

    $json = implode(',', $jsn);
    echo "var users = [ {$json} ];";

    require_once("db_disconnect.php");
?>
