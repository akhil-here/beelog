<?php

include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id !== NULL) {
    header("Location: dashboard.php");
}

$error_occured = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $result = $auth->register($_POST['username'], $_POST['email'], $_POST['password']);
        if ($result) {
            header("Location: login.php");
        }
    } catch(Exception $e) {
        $error_occured = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg"></div>
    <div class="d-flex">
        <div class="col-6 d-flex align-items-center justify-content-center">
            <img src="syb.gif" alt="Login GIF" class="w-100">
        </div>
        <div class="col-6 text-white d-flex min-vh-100 align-items-center justify-content-center flex-column">
            <form action="" method="POST" class="w-75">
                <div class="form-group">
                    <h1 class="font-weight-bold py-4">Register</h1>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control border-0 shadow">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control border-0 shadow">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control border-0 shadow">
                </div>
                <div class="form-group">
                    <a href="login.php" class="d-block text-white pt-2 form-text">Login</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success shadow my-4">Create</button>
                </div>
                <div class="form-group">
                    <?php
                        if(strcmp($error_occured, "") != 0) {
                            echo '<div class="alert alert-danger" role="alert">'.$error_occured.'</div>';
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>