<?php
    $destination = "../images/";
    $target_file = $destination . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $isFileMoved = false;

    $form_data = array(
        "image_url" => "images/" . basename($_FILES["image_file"]["name"]),
        "user_id" => $_POST["user_id"],
        "description" => $_POST["description"]
    );

    // print_r($_FILES);
    // print_r($target_file);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image_file"]["tmp_name"]);

        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image_file"]["name"]). " has been uploaded.";
            $isFileMoved = true;
        }
    }

    print_r($form_data);

    if (!$isFileMoved) {
        echo "Sorry, there was an error uploading your file.";
        return;
    }

    require_once("db_connect.php");
    require_once("util.php");

    if (!$dbconn) {
        die(mysqli_error());
    }

    $sql = sprintf(
        "INSERT INTO posts (user_id, image_url, description) "
        ."VALUES ('%d','%s','%s')",
        $form_data["user_id"],
        $form_data["image_url"],
        str_replace("'", "\'", $form_data["description"])
    );

    $res = $dbconn->query($sql);
    $msg = $res ? "success" : "error";
    $msg = array("msg" => $msg);

    if ($res) {
        $sel = sprintf("SELECT COUNT(*) as post_count FROM posts WHERE user_id = %d", $form_data["user_id"]);
        $sql = sprintf(
            "UPDATE users JOIN (%s) temp " .
            "ON users.id = %d " .
            "SET users.post_count = (temp.post_count)",
            $sel,
            $form_data["user_id"]
        );
        $res = $dbconn->query($sql);
    }

    require_once("db_disconnect.php");

    header("Location: ../profile.php?username=" . $_POST["username"]);
    exit;
?>
