<?php

include('auth.php');

$auth = new Account();

$id = $auth->check();

if ($id === NULL) {
    header("Location: login.php");
}

// echo session_id();
// print_r($auth->getInfo());

$conn = getConn();

$err = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ((isset($_GET['like'])) && ($_GET['like'] == 1) && (isset($_GET['pid']))) {
        $q = "replace into post_upvotes (post, upvote_by) values ('".$_GET['pid']."', '".$id."')";
        $conn->query($q);
    } else if ((isset($_GET['like'])) && ($_GET['like'] == 0) && (isset($_GET['pid']))) {
        $q = "delete from post_upvotes where (post = '".$_GET['pid']."') and (upvote_by = '".$id."')";
        $conn->query($q);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['title']) && !empty($_POST['content']))
    {    
        $time=date('Y-m-d h:i:s');
        $sql="insert into posts (title,created,content,author ) values ('".$_POST['title']."','".$time."','".$_POST['content']."','".$id."')";
        if ($conn->query($sql) === TRUE) {
            $err="Post created";
            $ac='success';
          } else {
            $err="Error creating post";
            $ac="danger";
          } 
    }
    else{
        $err="Don't leave fields blank";
        $ac = "danger";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <title>Dashboard</title>
</head>

<body class="swing-in-top-fwd">
    <div class="bg-white">
        <?php include 'nav.php';?>
        <div class="container-fluid d-flex flex-xl-row flex-column my-5">
            <div class="create-post col-xl-3 col-12">
                <div style="position: sticky; left: 2em; top: 7em;">
                    <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded mb-5">Create post</p>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea rows="8" name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success shadow">Post</button>
                        </div>
                        <div class="form-group">
                            <?php
                            if(strcmp($err, "") != 0) {
                                echo '<div class="alert alert-'.$ac.'" role="alert">'.$err.'</div>';
                            }
                        ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="all-posts col-xl-9 col-12">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 mb-5 rounded">Posts</p>
                
                <?php                     
                    // $sql1 = "select * from posts, accounts, follow where (follow.p1 = ".$id.") AND (follow.p2=accounts.account_id)";
                    $sql1 = "SELECT * from posts, accounts where (accounts.account_id = posts.author) and (author in (select p2 from follow where p1 = '".$id."'))";
                    // $sql1 = "SELECT post_id, title, avatar, created, username, content, author, count(upvote_by) from posts, accounts, post_upvotes where (post_upvotes.post = posts.post_id) and (accounts.account_id = posts.author) and (author in (select p2 from follow where p1 = '".$id."'))";
                    $res = getConn()->query($sql1);
                    // print_r($res->fetch_assoc());
                    if ($res->num_rows) {
                        while($row = $res->fetch_assoc()) {
                            $likes = getConn()->query("select count(*) as likes from post_upvotes where post = '".$row['post_id']."'")->fetch_assoc()['likes'];
                            $like = getConn()->query("select count(*) as _like from post_upvotes where (upvote_by = '".$id."') and (post = '".$row['post_id']."')")->fetch_assoc()['_like'];
                            // print_r($row);
                            echo "<div class='card blog-cards mb-4 shadow-sm'>
                                    <div class='card-header'>
                                        <div class='media'>
                                            <img style='height: 3em;' src='".$row['avatar']."'
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
                                            <div class='col'>
                                                <button class='btn ".(($likes == 0) ? 'btn-success' : '')."' ".($like == 1 ? 'disabled' : '')." onclick=\"location.href = 'dashboard.php?like=1&pid=".$row['post_id']."'\">
                                                    <span class='fa fa-heart fa-fw mr-2' style='color: red;'></span>
                                                    ".$likes." Likes
                                                </button>
                                            </div>
                                            <div class='col'>
                                                <button class='btn' ".($like == 1 ? '' : 'disabled')."  onclick=\"location.href = 'dashboard.php?like=0&pid=".$row['post_id']."'\">
                                                    <span class='fa fa-trash  fa-fw mr-2' style='color: red;'></span>
                                                    Dislike
                                                </button>
                                            </div>
                                            <div class='col text-right'>
                                                <p class='font-weight-bold m-0 p-0'>".$row['username']."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "You've made no posts";
                    }
                ?>

            </div>
            <div class="my-5"></div>
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