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
        str_replace("'", "\'", $_GET["description"])
    );

    $res = $dbconn->query($sql);
    $msg = $res ? "success" : "error";
    $msg = array("msg" => $msg);

    if ($res) {
        $sel = sprintf("SELECT COUNT(*) as post_count FROM posts WHERE user_id = %d", $_GET["user_id"]);
        $sql = sprintf(
            "UPDATE users JOIN (%s) temp " .
            "ON users.id = %d " .
            "SET users.post_count = (temp.post_count)",
            $sel,
            $_GET["user_id"]
        );
        $res = $dbconn->query($sql);
    }

    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
