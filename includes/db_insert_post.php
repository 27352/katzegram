<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $sql = sprintf(
        "INSERT INTO posts (user_id, image_url, description) "
        ."VALUES ('%d','%s','%s')",
        $_GET["user_id"],
        $_GET["image_url"],
        $_GET["description"]
    );

    $res = $dbconn->query($sql);
    $msg = $res ? "success" : "error";
    $msg = array("msg" => $msg);
    
    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
