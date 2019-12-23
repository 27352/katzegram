<html>

<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        <?php require_once("includes/db_select_users.php"); ?>
    </script>
</head>

<body onload="displayUsers(users)">
<form name="signUp" action="db_insert_user.php" method="get">
    <div id="main">
        <?php require_once('includes/menu.php'); ?>
        <div id="users"></div>
        <div id="addNewUser" onclick="displayAddUserForm()">
            <span><img src="icon/add_box-24px.svg"></span>
            <span>Add New User</span>
            
            <div id="addUserForm">
                <table cellspacing=0 cellpadding=10>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Bio:</td>
                        <td><textarea name="bio"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td id="addUserLink" onclick="doSignUp()">
                            <a href="#">Sign Up</a>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</form>
</body>

</html>
