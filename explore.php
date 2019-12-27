<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_users.php"); ?>
    </script>
</head>

<body onload="displayPeople()">
    <center>
        <div id="main">
            <?php require_once('includes/menu.php'); ?>
            <div class="headerTextLeft">
                Discover People
            </div>
            <div id="people"></div>
            <div class="headerTextLeft">
                Explore
            </div>
            <div id="posts">a</div>
        </div>
    </center>
</body>

</html>
