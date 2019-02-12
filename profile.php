<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Information</title>
</head>
<body>

<h1>Profile Information</h1>
    <table border="1" style="width:25%;">
        <tr>
            <th>Username </th>
            <td><?php echo $_SESSION['username'] ?></td>
        </tr>

        <tr>
            <th>Email </th>
            <td><?php echo $_SESSION['email'] ?></td>
        </tr>

        <tr>
            <th>User ID </th>
            <td><?php echo $_SESSION['id_user'] ?></td>
        </tr>
    </table>

    <a href="dashboard.php"><button>Back</button></a>
</body>
</html>