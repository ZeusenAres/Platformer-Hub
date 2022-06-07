<!DOCTYPE html>
<html>
<head>
    <title>homepage</title>
    <?php
    session_start();
    echo $_SESSION['user'];
    ?>
</head>
<body>
    <div></div>
    <a href="register.php">register</a><br />
    <a href="login.php">login</a>
</body>
</html>