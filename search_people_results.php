<?php
include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header("Location: login.php");
}

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

<body class="swing-in-top-fwd">

    <?php include 'nav.php';?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0">
            <li class="breadcrumb-item"><a href="search_people.php">Search</a></li>
            <li class="breadcrumb-item active" aria-current="page">Results</li>
        </ol>
    </nav>

    <div class="container py-5">
        <p class="text-center h4 pb-4" style="font-weight: 900;">Search results</p>
        <div class="list-group list-group- col-xl-8 mx-auto" id="content">
            <h4 class="py-2">Following</h4>
            <?php 
            $q = "SELECT * from accounts where (accounts.account_id != '".$id."') and (username like '%".$_GET['q']."%') and (accounts.account_id in (SELECT p2 from follow where p1 = '".$id."'))";
            $res = $conn->query($q);
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    echo "<div class='list-group-item btn person-card' onclick=\"location.href = 'friend_profile.php?id=".$row['account_id']."'\">
                        <div class='d-flex align-items-center'>
                            <img style='height: 5em;' src=\"".$row['avatar']."\"
                                class='shadow-sm mr-3 rounded-circle border' alt='Logo' />
                            <p class='pt-3 px-2'>".$row['username']."</p>
                        </div>
                    </div>";
                }
            } else {
                echo "No users";
            }
            ?>
            <h4 class="py-2">People you may follow</h4>
            <?php 
            $q = "SELECT * from accounts where (accounts.account_id != '".$id."') and (username like '%".$_GET['q']."%') and (accounts.account_id not IN (SELECT p2 from follow where p1 = '".$id."'))";
            $res = $conn->query($q);
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    echo "<div class='list-group-item btn person-card' onclick=\"location.href = 'anon_profile.php?id=".$row['account_id']."'\">
                        <div class='d-flex align-items-center'>
                            <img style='height: 5em;' src=\"".$row['avatar']."\"
                                class='shadow-sm mr-3 rounded-circle border' alt='Logo' />
                            <p class='pt-3 px-2'>".$row['username']."</p>
                        </div>
                    </div>";
                }
            } else {
                echo "No users";
            }
            ?>
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