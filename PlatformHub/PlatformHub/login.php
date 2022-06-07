<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <?php
    require_once('Classes/LoginController.Class.php');
    $login = new LoginController('users');
    ?>
</head>
<body>
    <form action="login.php" method="post">
        <input name="username" type="text" placeholder="Username" />
        <input name="password" type="password" placeholder="Password" />
        <input name="login" type="submit" value="Login" />
    </form>

    <?php
    if(isset($_POST['login']))
    {
        try
        {
            if($login->loginUser($_POST['username'], $_POST['password']))
            {
                $_SESSION['user'] = $_POST['username'];
                header('Location: home.php');
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    ?>
</body>
</html>