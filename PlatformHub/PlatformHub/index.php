<!DOCTYPE html>
<html>
<head>
    <?php
    require_once 'Classes/Login.class.php';
    $db = new Login();
    $db->DBConnect();
    ?>
</head>
<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <td>
                    <input type="submit" name="logout"/>
                </td>
            </tr>
            <tr>
                <td>Gebruiker</td>
                <td>
                    <input type="text" name="user" />
                </td>
            </tr>
            <tr>
                <td>Wachtwoord</td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="login" value="Login" />
                    <a href="register.php">Nieuwe gebruiker</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="home.php">Homepage</a>
                </td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($_POST['logout']))
    {
        unset($_SESSION['user']);
    }

    if (isset($_POST['login']))
    {
        try
        {
            $user = $_POST['user'];
            if ($db->Login($user, $_POST['password']))
            {
                unset($_SESSION['user']);
                $_SESSION['user'] = $user;
                echo "You are logged in as " . $_SESSION['user'];
            }
            else
            {
                echo 'ongeldig user id of wachtwoord<br/>';
                unset($_SESSION['user']);
            }
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage() . "<br/>";
        }
    }
    ?>
</body>
</html>
