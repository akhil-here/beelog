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
<!-- 
photo 
name
friend list 
post list
change pass
  -->
<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-3 text-center">
                    <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded mb-5">You</p>
                    <img src=<?php echo $auth->getInfo()['avatar'];?> alt="Admin"
                        class="rounded-circle shadow-sm" width="150">
                    <div class="pt-2">
                        <h5 class="font-weight-bold"><?php echo $auth->getInfo()['username']?></h5>
                        <p class="font-weight-"><?php echo $auth->getInfo()['email']?></p>
                    </div>

                    <div class="text-left">
                        <hr style="height: .12em; background-color: #eee;" class="shadow-lg">
                        <p class="font-weight-normal">Followers: <?php print_r($conn->query("select count(p1) as followers from follow where p2 = '".$id."'")->fetch_assoc()['followers']); ?></p>
                        <p class="font-weight-normal">Posts: <?php print_r($conn->query("select count(*) as posts from posts where author = '".$id."'")->fetch_assoc()['posts']); ?></p>
                        <p class="font-weight-normal">Upvotes: <?php print_r($conn->query("select count(*) as upvotes from post_upvotes where post in (select post_id from posts where author = '".$id."')")->fetch_assoc()['upvotes']); ?></p>
                        <hr style="height: .12em; background-color: #eee;" class="shadow-lg">
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                    <?php include('change_avatar.php');?>
                        <button type="button" class="btn d-block my-2 btn-light shadow" data-toggle="modal" data-target="#change-avatar-modal">Change Avatar</button>
                        <button type="button" class="btn d-block my-2 btn-secondary shadow" onclick="location.href = 'changepass.php'">Change Password</button>
                    </div>
            </div>
            <div class="col-7 text-">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded ">Posts</p>
                <div class="container my-5">
                    
                    <!-- card -->
                    <?php 
                    
                    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
                        if (isset($_GET['q']) && isset($_GET['pid'])) {
                            $sql="DELETE FROM posts WHERE post_id='".$_GET['pid']."'";
                            getConn()->query($sql);
                        }
                    } 
                    
                    // get all posts
                    $sql = "Select * from posts where author = '".$id."'";
                    $res = getConn()->query($sql);
                    // print_r($res);
                    if ($res->num_rows > 0) {
                        while($row = $res->fetch_assoc()) {
                            echo "<div class='card blog-cards mb-4 shadow-sm'>
                                    <div class='card-header'>
                                        <div class='media'>
                                            <img style='height: 3em;' src='".$auth->getInfo()['avatar']."'
                                                class='shadow-sm mr-3 rounded-circle' alt='Logo' />
                                            <div class='media-body'>
                                                <b>".$row['title']."</b><br>
                                                <small>".$row['created']."</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <p class='p-0 m-0'>".$row['content']."</p>
                                    </div>
                                    <div class='card-footer bg-white'>
                                        <div class='d-flex justify-content-between align-items-center'>
                                            <div class='col text-left'>
                                                <button class='btn' onclick=\"location.href = 'loggedin_profile.php?q=delete&pid=".$row['post_id']."'\">
                                                    <span class='fa fa-trash fa-fw mr-2' style='color: black;'></span>
                                                    Delete
                                                </button>
                                            </div>
                                            <div class='col text-right'>
                                                <p class='font-weight-bold m-0 p-0'>".$auth->getInfo()['username']."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "You've made no posts";
                    }
                   ?>
                    <!-- card end -->
                    
                </div>
            </div>
            <div class="col-md-2">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded mb-5">Following</p>
                <div id="friends" class="d-flex flex-wrap justify-content-between">
                    <?php
                        $q = "select * from accounts where account_id in (select p2 from follow where p1 = '".$id."')";
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