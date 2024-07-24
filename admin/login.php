<?php

include_once("../helper/config.php");
include_once("../helper/functions.php");

$login = cekSession();
if($login){
    redirect("index.php");
}

if(isset($_POST['login'])){
    $username = post('username');
    $password = post('password');

    $login = login($username, $password);
    
    if ($login) {
        redirect('index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container py-5 h-100">
        <div class="row">
            <div class="col-xl-12 d-flex justify-content-center align-items-center h-100">
                <div class="card rounded mt-2">
                    <div class="card-header text-center">
                        Login Administrator
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="from-label mb-2">Username</label>
                                <input name="username" type="text" class="form-control mb-3" />
                                <label class="form-label mb-2">Password</label>
                                <input name="password" type="password" class="form-control mb-3" />
                                <input name="login" type="submit" value="Login" class="btn btn-sm btn-success w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>