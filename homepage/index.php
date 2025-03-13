
<?php include("homepage.php")?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a{
            text-decoration:none;
            color: black;
            padding: 15px;
            background-color: greenyellow;
            border: 1px solid black;
            border-radius: 15px;
        }

    </style>
</head>
<body>
    <img width=64 src="<?php echo $avatar ?>"></img>
    <a href=../logout.php>logout</a>
</body>
</html>