<html>

<head>
    <?php require_once("includes/header.php"); ?>
</head>

<body>
    <form name="startUpForm" id="startUpForm" action="" method="get">
    <center>
    <div id="main">
        <?php require_once('includes/menu.php'); ?>
        <div class="headerText">
            <a href="javascript: displayForm('loginForm')">Login</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript: displayForm('signUpForm')">Sign Up</a>
        </div>
        <div id="signUpForm">
            <table cellspacing=0 cellpadding=10>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="fullname"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password""></td>
                </tr>
                <tr>
                    <td>Photo Url:</td>
                    <td><input type="text" name="photo_url"></td>
                </tr>
                <tr>
                    <td>Bio:</td>
                    <td><textarea name="bio"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="formLink" onclick="doStartUp('signup')">
                        <a href="#">Sign Up</a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="loginForm">
            <table cellspacing=0 cellpadding=10>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="formLink" onclick="doStartUp('login')">
                        <a href="#">Login</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </center>
    </form>
</body>

</html>
