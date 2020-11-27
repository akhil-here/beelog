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
    <title>Friend</title>
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

    <div class="container my-5">
        <div class="row my-5">
            <?php 
            $userid=$_GET['id'];
            $q="select * from accounts where account_id='".$userid."'";
            $res = $conn->query($q);

            $followers = $conn->query("SELECT COUNT(p1) FROM follow WHERE p2 = '".$id."'")->fetch_assoc()['COUNT(p1)'];
            $postcount= $conn->query("select count(*) as post_count from posts where author='".$userid."'")->fetch_assoc()['post_count'];
            while ($row = $res->fetch_assoc())
            echo "<div class='col'>
                <div class='d-flex align-items-center text-center'>
                    <img src='".$row['avatar']."' alt='Admin'
                        class='rounded-circle shadow' width='150'>
                    <span style='flex:0.6' />
                    <div class='mt-3 float-right'>
                        <h4 class='font-weight-bold'>".$row['username']."</h4>
                        <p class='text-muted font-size-sm'><strong>Followers:</strong> ".$followers." <strong
                                class='ml-3'>Posts:</strong> ".$postcount."
                        </p>
                        <button class='btn shadow font-weight-bold' onclick=\"location.href = 'unfollow.php?id=".$userid."'\"
                            style='background-color: red; color:white;'>Unfollow</button>
                    </div>
                </div>
            </div>
            ";

            
            ?>
        </div>
            
        <hr style="height: .12em; background-color: #eee;" class="rounded shadow-lg">
        <div class="d-flex">
            <div class="col-4 border-right">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded">Following</p>
                <div id="friends" class="d-flex flex-wrap justify-content-between">
                <?php
                        $q = "select * from accounts where account_id in (select p2 from follow where p1 = '".$userid."')";
                        $res = $conn->query($q);
                        if ($res->num_rows) {
                            while ($row = $res->fetch_assoc()) {
                            echo "<img style='height: 2.5em;' src=\"".$row['avatar']."\"
                                class='shadow border-0 img-thumbnail m-1' alt='Logo' data-toggle='tooltip' data-placement='top'
                                title=\"".$row['username']."\" />";
                            }
                        } else {
                            echo "Not following anybody 🍕";
                        }
                    ?>

                </div>
            </div>
            <div class="col-8">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded">Posts</p>
                <div id="posts">
                     <!-- card -->
                     <?php 
                    
                    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
                        if (isset($_GET['q']) && isset($_GET['pid'])) {
                            $sql="REPLACE INTO post_upvotes  (post, upvote_by) VALUES ('".$_GET['pid']."', '".$id."')";
                            getConn()->query($sql);
                        }
                    } 
                    
                    // get all posts
                    $friendId = $_GET['id'];
                    $friendData = $conn->query("SELECT * FROM accounts WHERE account_id = '".$friendId."'")->fetch_assoc();

                    $sql = "Select * from posts where author = '".$friendId."'";
                    
                    $res = getConn()->query($sql);
                    if ($res->num_rows > 0) {
                        while($_row = $res->fetch_assoc()) {
                            echo "<div class='card blog-cards mb-4 shadow-sm'>
                                    <div class='card-header'>
                                        <div class='media'>
                                            <img style='height: 3em;' src='".$friendData['avatar']."'
                                                class='shadow-sm mr-3 rounded-circle' alt='Logo' />
                                            <div class='media-body'>
                                                <b>".$_row['title']."</b><br>
                                                <small>".$_row['created']."</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <p class='p-0 m-0'>".$_row['content']."</p>
                                    </div>
                                    <div class='card-footer bg-white'>
                                        <div class='d-flex justify-content-between align-items-center'>
                                            <div class='col text-right'>
                                                <p class='font-weight-bold m-0 p-0'>".$conn->query("select username from accounts where account_id = '".$_row['author']."'")->fetch_assoc()['username']."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "Your friend has made no posts";
                    }
                   ?>
                    <!-- card end -->
                </div>
            </div>
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
    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>

</html>