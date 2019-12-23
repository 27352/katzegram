<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $sql = "SELECT posts.*, users.username, users.fullname FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.post_id ASC";
    $res = $dbconn->query($sql);
    $jsn = array();

    if ($res->num_rows > 0) {
        while( $row = $res->fetch_assoc() ) {
            array_push($jsn, assocToJson($row));
        }
    }

    $json = implode(',', $jsn);
    echo "var post_items = [ {$json} ];";

    require_once("db_disconnect.php");
?>
