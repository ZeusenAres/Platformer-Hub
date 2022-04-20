<!DOCTYPE html>
<html>
<head>
    <?php
    require_once 'Classes/Register.class.php';
    $db = new Register();
    $db->DBConnect();
    ?>
</head>
<body>
    <form action="register.php" method="post">
        <table>
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
                <td>Herhaal wachtwoord</td>
                <td>
                    <input type="password" name="repeatedPassword" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="newUser" value="Opslaan" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
if (isset($_POST['newUser']))
{
    try
    {
        $db->CreateUser($_POST['user'], $_POST['password'], $_POST['repeatedPassword']);
        header('Location: index.php');
    }
    catch (Exception $ex)
    {
        echo $ex->getMessage() . "<br />";
    }
}
?>
