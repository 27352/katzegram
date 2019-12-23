<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_post.php"); ?>
    </script>
</head>

<body onload="displaySinglePost(post_item[0], true);">
    <div id="main">
        <?php require_once('includes/menu.php'); ?>

        <div id="posts">
        </div>
    </div>
</body>

</html>
