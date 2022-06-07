<!DOCTYPE html>
<html>
<head>
    <title>register</title>
    <?php
    require_once('Classes/RegisterController.Class.php');
    $register = new RegisterController('users');
    ?>
</head>
<body>
    <form action="#" method="post">
        <input name="username" type="text" placeholder="Username" />
        <input name="password" type="password" placeholder="Password" />
        <input name="repeatPassword" type="password" placeholder="Repeat Password" />
        <input name="register" type="submit" value="Register" />
    </form>

    <?php
    if(isset($_POST['register']))
    {
        try
        {
            $register->registerUser($username, $password, $repeatPassword);
            header('Location: home.php');
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    ?>
</body>
</html>