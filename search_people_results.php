<?php
include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header("Location: login.php");
}
else{}

$conn = getConn();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



    <title>Search results</title>
</head>

<body>

    <?php include 'nav.php';?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0">
            <li class="breadcrumb-item"><a href="#">Search</a></li>
            <li class="breadcrumb-item active" aria-current="page">Results</li>
        </ol>
    </nav>

    <div class="container">
        <p class="text-center h4 pb-4" style="font-weight: 900;">Search results</p>
        <div class="list-group list-group- col-xl-8 mx-auto" id="content">
            <div class="list-group-item btn person-card">
                <div class="d-flex align-items-center">
                    <img style="height: 5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow-sm mr-3 rounded-circle border" alt="Logo" />
                    <p class="pt-3 px-2">First Last</p>
                </div>
            </div>
            <div class="list-group-item btn person-card">
                <div class="d-flex align-items-center">
                    <img style="height: 5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow-sm mr-3 rounded-circle border" alt="Logo" />
                    <p class="pt-3 px-2">First Last</p>
                </div>
            </div>
            <div class="list-group-item btn person-card">
                <div class="d-flex align-items-center">
                    <img style="height: 5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow-sm mr-3 rounded-circle border" alt="Logo" />
                    <p class="pt-3 px-2">First Last</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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