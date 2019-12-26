<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_post.php"); ?>
    </script>
</head>

<body onload="displayPost(post_item[0]);">
    <center>
        <div id="main">
            <?php require_once('includes/menu.php'); ?>

            <div id="posts">
            </div>
            <div id="comments">
            </div>
        </div>
    </center>
</body>

</html>
