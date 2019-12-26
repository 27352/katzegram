<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $pid = $_GET["post_id"];
    $sql = sprintf("SELECT comments.*, users.username as author_username, "
                    . "users.fullname as author_fullname "
                    . "FROM comments INNER JOIN users ON comments.author_user_id = users.id "
                    . "WHERE comments.post_id = %d ORDER BY comments.comment_id DESC", $pid);

    $res = $dbconn->query($sql);
    $cms = array();

    if ($res->num_rows > 0) {
        while( $row = $res->fetch_assoc() ) {
            array_push($cms, assocToJson($row));
        }
    }

    $cms = implode(',', $cms);
    $sql = sprintf(
            "SELECT posts.*, users.username, users.fullname "
            . "FROM posts INNER JOIN users ON posts.user_id = users.id "
            . "WHERE posts.post_id = %d", $pid);

    $res = $dbconn->query($sql);
    $jsn = array();

    if ($res->num_rows > 0) {
        while( $row = $res->fetch_assoc() ) {
            array_push($jsn, assocToJson($row));
        }
    }

    $json = implode(',', $jsn);
    echo "var post_item = [ {$json} ]; var comments = [ $cms ]";

    require_once("db_disconnect.php");
?>
