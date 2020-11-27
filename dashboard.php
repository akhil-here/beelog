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
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <title>Dashboard</title>
</head>

<body>
    <div class="bg-white">
        <?php include 'nav.php';?>
        <div class="container-fluid d-flex flex-xl-row flex-column my-5">
            <div class="create-post col-xl-3 col-12">
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
                </form>
            </div>
            <div class="all-posts col-xl-9 col-12">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 mb-5 rounded">Posts</p>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <div class="media">
                            <img style="height: 3em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                class="shadow-sm mr-3 rounded-circle" alt="Logo" />
                            <div class="media-body">
                                <b>This is some random title</b><br>
                                <small>4:29 pm, Thursday, 19 November 2020 (IST)</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="p-0 m-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem
                            autem recusandae
                            temporibus molestiae iusto sit aut quam accusantium qui, laborum expedita voluptates
                            totam
                            porro, vitae aspernatur? Nam fuga harum sint.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-6">
                                <button class="btn">
                                    <span class="fa fa-heart fa-fw mr-2" style="color: red;"></span>
                                    Like
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <p class="font-weight-bold m-0 p-0">First Last</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <div class="media">
                            <img style="height: 3em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                class="shadow-sm mr-3 rounded-circle" alt="Logo" />
                            <div class="media-body">
                                <b>This is some random title</b><br>
                                <small>4:29 pm, Thursday, 19 November 2020 (IST)</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="p-0 m-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem
                            autem recusandae
                            temporibus molestiae iusto sit aut quam accusantium qui, laborum expedita voluptates
                            totam
                            porro, vitae aspernatur? Nam fuga harum sint.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-6">
                                <button class="btn">
                                    <span class="fa fa-heart fa-fw mr-2" style="color: red;"></span>
                                    Like
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <p class="font-weight-bold m-0 p-0">First Last</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5"></div>
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