

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
            <input type="text" name="user_email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password" minlength="8" maxlength="12" pattern="[A-Za-z]{.}" title="Password must be min 6 & max 12" required><br>
            <input type="password" name="pwd-repeat" placeholder="Confirm password" minlength="8" maxlength="12" pattern="[A-Za-z]{.}" title="Passwordmust be min 6 & max 12" required><br>
            <button type="submit" name="submit">submit</button>
            <button type="reset">Cancel</button>
    </div>
</body>
</html>