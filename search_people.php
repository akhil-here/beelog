<?php
include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header("Location: login.php");
}
else{}


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



    <title>Search people</title>
</head>

<body>

    <?php include 'nav.php';?>

    <div class="container-fluid mx-auto vh-100 d-flex justify-content-center position-fixed align-items-center">
        <form action="/miniproject/_/search_people_results.php" class="col mb-5">
            <div class="form-group py-5 text-center col-6 mx-auto">
                <p class="typewriter h1 shadow" style="font-weight: 700; color: royalblue; background-color: yellow;">
                    make new
                    friends...</>
            </div>
            <div class="form-group col-8 mx-auto ">
                <div class="input-group">
                    <input type="text" name="q" id="searchbar" autofocus class="form-control shadow-lg border-0"
                        placeholder="Find people">
                    <!-- <div class="input-group-append">
                        <button class="btn"><span class="fa fa-fw fa-search"></span></button>
                    </div> -->
                </div>
            </div>
            <div class="form-group my-5 text-center">
                <button class="btn btn-dark shadow">Search</button>
            </div>
        </form>
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