<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>

<body>

    <!-- NAVBAR -->
    <?php 
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->

    <!-- Content -->

    <div class="container col-12 text-center" style="padding: 30px;">

        <div class="profile-content">
            <div class="col-12">
                <img id="user-image-view" src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                    class="rounded-circle" height="200" alt="" loading="lazy">
            </div>
            <div class="col-12" style="padding: 20px;">
                <h1 id="user-name-view">Edson Lugo Sanchez</h1>
            </div>
            <div class="col-4" style="margin-left: auto; margin-right: auto;">
                <div class="row">
                    <div class="col-6">
                        <h4 id="user-username-view">@Edson19</h4>
                    </div>
                    <div class="col-6">
                        <h4 id="user-rol-view">Instructor</h4>
                    </div>
                </div>
            </div>

            <!-- MY COURSES -->
            <div class="home most-new col-12" style="padding: 10px;">
                <div class="col-12 title text-center">
                    <h3>My courses</h3>
                    <hr>
                </div>

                <div class="col-12 in-progress-learning" style="padding: 10px;">

                    <div class="row" style="display: flex; justify-content:start;">


                    </div>

                </div>

                <div class="card-footer" style="text-align: right;">
                    <a href="#">See more</a>
                </div>
            </div>
            <!-- /MY COURSES  -->

            <!-- MY LEARNINGS -->
            <div class="home most-new col-12" style="padding: 10px;">
                <div class="col-12 title text-center">
                    <h3>My learnings</h3>
                    <hr>
                </div>

                <div class="col-12 in-progress-learning" style="padding: 10px;">

                    <div class="row" style="display: flex; justify-content:start;">


                    </div>

                </div>

                <div class="card-footer" style="text-align: right;">

                </div>
            </div>
            <!-- /MY LEARNINGS  -->

        </div>
    </div>


    <!-- /Content -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/notifications.js"></script>
    <!-- /JS -->
</body>

</html>