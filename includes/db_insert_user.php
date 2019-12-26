<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    // Check if user already exists
    $sql = sprintf("SELECT * FROM users WHERE username = '%s'", $_GET["username"]);
    $res = $dbconn->query($sql);
    $msg = '';

    if ($res->num_rows > 0) {
        $msg = sprintf("%s already exists.", $_GET["username"]);
    } else {
        $sql = sprintf(
            "INSERT INTO users (username, fullname, password, description, photo_url) "
            ."VALUES ('%s','%s', AES_ENCRYPT('%s','secret'), '%s', '%s')",
            $_GET["username"],
            $_GET["fullname"],
            str_replace("'", "\'", $_GET["password"]),
            str_replace("'", "\'", $_GET["description"]),
            $_GET["photo_url"]
        );

        $res = $dbconn->query($sql);
        $msg = $res ? "success" : "error";
    }

    $msg = array("msg" => $msg);
    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
