<?php
    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    // Check if user already exists
    $sql = sprintf("SELECT password FROM users WHERE username = '%s'", $_GET["username"]);
    $res = $dbconn->query($sql);
    $msg = '';

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $sql = sprintf("SELECT AES_DECRYPT('%s', 'secret') as pswd", $row["password"]);
        $res = $dbconn->query($sql);
        $row = $res->fetch_assoc();

        if ($row["pswd"] == $_GET["password"]) {
            $sql = sprintf("UPDATE users SET logged_in = TRUE WHERE username = '%s'", $_GET["username"]);
            $res = $dbconn->query($sql);
            $msg = $res ? "success" : "error";
        } else {
            $msg = sprintf("Password doesn't match for user %s", $_GET["username"]);
        }

    } else {
        $msg = sprintf("%s doesn't exist!", $_GET["username"]);
    }

    $msg = array("msg" => $msg);
    echo assocToJson($msg);

    require_once("db_disconnect.php");
?>
