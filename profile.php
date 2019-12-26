<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script><?php require_once("includes/db_select_profile.php"); ?></script>
</head>

<body onload="displayPosts(posts);">
    <center>
    <form name="newPostForm" id="newPostForm" action="" method="get">
    <div id="main">
        <?php require_once('includes/menu.php'); ?>
        <div class="headerText">
            <?php echo $row['fullname']; ?>
        </div>
        <div id="userProfile">
            <span id="userInfo">
                <table cellspacing=0 cellpadding=10>
                    <tr>
                        <td>
                            <img id="userPhoto" src="<?php echo $row['photo_url']; ?>">
                        </td>
                        <td>
                        <table cellspacing=0 cellpadding=10>
                            <tr>
                                <td>Bio:</td>
                                <td><?php echo $row['description']; ?></td>
                            </tr>
                            <tr>
                                <td>Posts:</td>
                                <td><?php echo $row['post_count']; ?></td>
                            </tr>
                            <tr>
                                <td>Joined:</td>
                                <td><?php echo $row['datetime']; ?></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
            </span>
        </div>
        <div id="addNewPost">
            <a href="javascript: displayForm('addNewPostForm')">Add New Post</a>
        </div>
        <div id="addNewPostForm">
            <table cellspacing=0 cellpadding=10>
                <tr>
                    <td>Image Url:</td>
                    <td><input type="text" name="image_url"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="formLink" onclick="doNewPost(<?php echo $row["id"]; ?>)">
                        <a href="#">Post It</a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="posts">
        </div>
    </div>
    </form>
    </center>
</body>

</html>
