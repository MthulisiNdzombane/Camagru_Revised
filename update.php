<?php
ini_set('display_errors', 1);
include './config/database.php';
require_once './classes/Database.php';

function update($password, $email) {
    $db = new Database();
    $params = [$password, $email];
    $query = "UPDATE users SET password=? WHERE email=?";
    if ($db->insertRow($query, $params)){
        return TRUE;
    }
    return FALSE;
}

if (isset($_POST['submit']))
{
    if($_POST['password'] != $_POST['repeat_password']){
        header('refresh: 0.0; URL=update.php');
    }
    if($_POST['password'] == $_POST['repeat_password']) {
        $password = trim($_POST['password']);
        if (update(password_hash($password, PASSWORD_DEFAULT), $_POST['email']) == TRUE){
            echo '<meta http-equiv="refresh" content="0;join.php"/>';
        }
    }
}
?>
<!DOCTYPE html>
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Update</title>
</head>
<body>
    <form action="" method="POST">
    <?php echo '<input type="text" placeholder="email" name="email" value="'.$_GET['email'].'"><br>' ?>
    <input type="text" placeholder="Type new password" name="password"><br>
    <input type="text" placeholder="Confirm new password" name="repeat_password"><br>
    <input type="submit" name="submit">
    </form>
</body>
</html>