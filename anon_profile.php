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
    <title>Search people</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="swing-in-top-fwd">
    <?php include 'nav.php';?>

    <div class="container">
        <div class="row mt-3">
            <div class="col py-5">
                <?php 
                $userid=$_GET['id'];
                $q="select * from accounts where account_id='".$userid."'";
                $res = $conn->query($q);
                $postcount=$conn->query("select count(*) as post_count from posts where author='".$userid."'")->fetch_assoc()['post_count'];
                $followcount=$conn->query("select count(p1) as followers from follow where p2 = '".$id."'")->fetch_assoc()['followers'];
                while ($row = $res->fetch_assoc())
                {
                    echo "<div class='d-flex align-iems-center text-center'>
                            <img src='".$row['avatar']."' alt='Admin'
                                class='rounded-circle shadow' width='150'>
                            <span style='flex:0.6' />
                            <div class='mt-3 float-right'>
                                <h4 class='font-weight-bold'>".$row['username']."</h4>
                                <p class='text-muted font-size-sm'><strong>Followers:</strong>".$followcount."    <strong>Posts:</strong>".$postcount."
                                </p>
                                <button class='btn btn-primary font-weight-bold shadow' onclick=\"location.href = 'make_follower.php?userid=".$userid."'\"
                                    style='background-color: royalblue; color: yellow'>Follow</button>
                            </div>
                        </div>";
                }
                ?>
                
            </div>
        </div>
        <hr style="color:black" />
        <div class="row my-5">
            <!-- <h2 class="strong d-flex align-items-center text-center mb-3">Posts</h3> -->
        </div>
        <p class="text-center my-5">Follow the <mark>Beelogger</mark> to see their posts. 🚀</p>


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