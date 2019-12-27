<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $sql = sprintf(
        "INSERT INTO comments (post_id, author_id, comment_text) "
        ."VALUES ('%d', '%d', '%s')",
        $_GET["post_id"],
        $_GET["author_id"],
        str_replace("'", "\'", $_GET["comment_text"])
    );

    $res = $dbconn->query($sql);
    $msg = array("msg" => $res ? "success" : "error");

    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
