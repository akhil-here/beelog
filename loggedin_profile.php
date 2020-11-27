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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include 'nav.php';?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-3 text-center ">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded mb-5">You</p>
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                    class="rounded-circle shadow-sm" width="150">
                <div class="pt-2">
                    <h5 class="font-weight-bold">Vighnesh Naik</h5>
                    <p class="font-weight-">vighnesh.naik@somaiya.edu</p>
                </div>

                <div class="text-left">
                    <hr style="height: .12em; background-color: #eee;" class="shadow-lg">
                    <p class="font-weight-normal">Followers: 17</p>
                    <p class="font-weight-normal">Posts: 23</p>
                    <p class="font-weight-normal">Upvotes: 23</p>
                    <hr style="height: .12em; background-color: #eee;" class="shadow-lg">
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <button type="button" class="btn d-block my-2 btn-light shadow">Change Avatar</button>
                    <button type="button" class="btn d-block my-2 btn-secondary shadow">Change Password</button>
                </div>

            </div>
            <div class="col-7 text-">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded ">Posts</p>
                <div class="container my-5">
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
            </div>
            <div class="col-md-2">
                <p class="text-center font-weight-bold bg-light shadow-sm p-2 rounded mb-5">Following</p>
                <div id="friends" class="d-flex flex-wrap justify-content-between">
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />
                    <img style="height: 2.5em;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                        class="shadow border-0 img-thumbnail m-1" alt="Logo" data-toggle="tooltip" data-placement="top"
                        title="First Last" />

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