<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    /**
     * UPDATE posts JOIN 
     * (SELECT likes FROM posts WHERE post_id = 1) temp
     * ON posts.post_id = 1
     * SET posts.likes = (temp.likes + 1)
     */

    $pid = $_GET["post_id"];
    $sel = sprintf("SELECT likes FROM posts WHERE post_id = %d", $pid);
    $sql = sprintf(
        "UPDATE posts JOIN (%s) temp " .
        "ON posts.post_id = %d " .
        "SET posts.likes = (temp.likes + 1)",
        $sel,
        $pid
    );

    // Update likes
    $res = $dbconn->query($sql);

    // Select likes from db
    $res = $dbconn->query($sel);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_GET["likes"] = $row["likes"];

        // Output Json Object for the webapp
        echo $res ? assocToJson($_GET) : "error";
    }

    require_once("db_disconnect.php");
?>
