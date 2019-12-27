<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_post.php"); ?>
    </script>
</head>

<body onload="displayPost(post_item[0]);">
    <center>
        <form name="newCommentForm" id="newCommentForm" action="" method="get">
            <div id="main">
                <?php require_once('includes/menu.php'); ?>

                <div id="posts">
                </div>
                <div id="comments">
                </div>
                <div id="addComment">
                    <a href="javascript: displayForm('addCommentForm')">Add Comment</a>
                </div>
                <div id="addCommentForm">
                    <table cellspacing=0 cellpadding=10>
                        <tr>
                            <td>Your Comment:</td>
                            <td><textarea name="comment_text"></textarea></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="formLink" onclick="doNewComment(post_item[0])">
                                <a href="#">Post It</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </center>
</body>

</html>
