<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    // Check if user already exists
    $sql = sprintf("SELECT * FROM users WHERE username= '%s'", $_GET["username"]);
    $res = $dbconn->query($sql);
    $jsn = array();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        if (!$row["photo_url"]) {
            $row["photo_url"] = "icon/kat-emoji.png";
        }

        $row["datetime"] = dateToString($row["datetime"]);
        array_push($jsn, assocToJson($row));
    }

    $json = implode(',', $jsn);
    echo "var profile = [ {$json} ][0];";

    require_once("db_disconnect.php");
?>