<?php

if (!isset($_COOKIE["BS"])) {
    header("Location: /miniproject/_/login.php");
}

$user = $_COOKIE["BS"];

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beelog";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpass = $_POST["oldPassword"];
    $newpass = $_POST["newPassword"];
    $sql = "SELECT username, password FROM userdata WHERE username='$user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                if (strcmp($row["password"], $oldpass) !== 0) {
                    echo "Incorrect old password";
                } else {
                    $update="UPDATE userdata SET password='".$_POST['newPassword']."' WHERE username= '$user'";
                    if($conn->query($update)){
                         echo "Password changed";
                    } else {
                        echo "Error changing password";
                    }
            }
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <title>Change Password</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
    ::selection {
        background-color: lightblue;
    }

    * {
        scroll-behavior: smooth;
        font-family: "Inter", sans-serif;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
    <?php include 'nav.php';?>

    <div class="container my-5">
        <div class="form-group py-4">
            <h1 class="font-weight-bold">Change password</h1>
        </div>
        <form action="changepass.php" method="POST" autocomplete="off">
            <div class="form-group">
                <div class="oldPassword">
                    <label for="oldPassword">Old Password</label>
                    <input class="form-control" type="password" name="oldPassword" id="oldPassword">
                </div>
            </div>
            <div class="form-group">
                <div class="newPassword">
                    <label for="newPassword">New Password</label>
                    <input class="form-control" type="password" name="newPassword" id="newPassword">
                </div>
            </div>
            <div class="form-group text- py-5">
                <button type="submit" class="btn shadow font-weight-bold"
                    style="color: yellow; background-color: royalblue;">Update
                    password</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>