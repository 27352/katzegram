<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $sql = sprintf(
        "INSERT INTO posts (user_id, image_url, description) "
        ."VALUES ('%d','%d','%d')",
        $_GET["user_id"],
        $_GET["image_url"],
        $_GET["description"]
    );

    $res = $dbconn->query($sql);
    $msg = array("msg", $res ? "success" : "error");

    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
