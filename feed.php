<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_posts.php"); ?>
    </script>
</head>

<body onload="displayPosts(post_items);">
    <center>
        <div id="main">
            <?php require_once('includes/menu.php'); ?>
            <div id="posts"></div>
        </div>
    </center>
</body>

</html>
