<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

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

    if ($_GET["start"] == 1) {
        echo "setCookie({username: profile.username});";
    }

    // Select user posts
    $sql = sprintf(
        "SELECT posts.*, users.username, users.fullname FROM posts "
        . "INNER JOIN users ON posts.user_id = users.id "
        . "WHERE users.username = '%s'", $_GET["username"]);
    $res = $dbconn->query($sql);
    $jsn = array();

    if ($res->num_rows > 0) {
        while( $post = $res->fetch_assoc() ) {
            array_push($jsn, assocToJson($post));
        }
    }

    $json = implode(',', $jsn);
    echo "var posts = [ {$json} ];";

    require_once("db_disconnect.php");
?>
