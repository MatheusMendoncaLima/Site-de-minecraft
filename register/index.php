<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu server de minecraft</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .full-height{
            height: 100%;
            min-height: 100%;
        }
        .full-height-md{
            @media only screen and (min-width: 768px) {
            height: 100%;
            min-height: 100%;
            }
            
        }
        .bg-image{
            background-image: url("../_images/fundominezaofinalpng.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>
<body style="background-image:linear-gradient(to bottom right, aqua, blue);">
    <div class=".container-xxl bg-image " >
        <div class="d-flex align-items-center justify-content-center d-md-block col  mx-4 mx-md-0"  style="height: 100vh; padding-left: 0; padding-right:0; ">
            <div class="d-md-flex  p-5 rounded mx-0 align-items-center full-height-md w-100" style="background-color:snow;  max-width: 600px; float:right; max-width:500px" >
        <div class="w-100">
            <h1 class="">Register</h1>
            <?php include("register.php"); ?>

            <form  action="" method="post">
            <div class="mb-2">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Minecraft name">
            </div>
            <div class="mb-2">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Insert your email">
            </div>
            <div class="mb-4">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="text" name="password" id="password" placeholder="Insert your password">
            </div>
            <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" name="premium" id="premium">
            <label class="form-check-label" for="premium">Premium</label>
            </div>

            <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" name="bedrock" id="bedrock">
            <label class="form-check-label" for="bedrock">Bedrock</label>
            </div>

            <input type="submit" class="btn btn-success w-100" value="Registrar">
        </form>
        
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

