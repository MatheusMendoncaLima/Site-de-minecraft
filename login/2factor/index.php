<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" >
            <input name="code" type="text">
            <input type="submit" value="submit">
        </form>

        <form action="" method="post" >
            <input name="resend" value="true" type="text" hidden>
            <input type="submit" value="sendmail">
        </form>

    </div>
    <?php include("2factor.php")?>

</body>
</html>