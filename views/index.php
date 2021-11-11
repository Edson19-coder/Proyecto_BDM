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
        require_once '../models/course.php';
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->

    <!-- Content -->

<?php if(isset($_SESSION['email'])) { ?>
    <!-- WELCOME BACK -->
    <div class="container col-12" style="padding: 0px 60px;">
        <div class="home welcome col-12">
            <div class="row" style="padding: 12px;">
                <div class="col-12 col-xl-3" style="display: flex; justify-content: center; align-items: center;">
                    <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($_SESSION["profilePicture"]); ?>" class="rounded-circle"
                        height="150px" alt="" loading="lazy" />
                </div>
                <div class="text-welcome col-12 col-xl-9" style="display: flex; align-items: center;">
                    <div class="col-12">
                        <h1>Welcome back <span class="user-name"><?php echo $_SESSION['firstName'] ?></span></h1>
                        <p>Let´s learn something new today.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WELCOME BACK -->
    
 <?php } ?>
    <!-- NEWEST -->
    <div class="home most-new col-12" style="padding: 10px;">
        <div class="col-12 title text-center">
            <h3>Newest</h3>
            <hr>
        </div>

        <div class="col-12 in-progress-learning" style="padding: 10px;">

            <div class="row" style="display: flex; justify-content:start;">
                <?php
                    $courses = Course::selectNewestCourses();

                    foreach ($courses as $key => $value) {
                        if(isset($_SESSION['email'])){
                            echo '<a href="course.php?course='.$value["COURSE_ID"].'" class="a-course">';
                        }else{
                            echo '<a href="#" class="a-course">';
                        }
                        echo ' <div class="card p-0" style="width: 18rem;">
                                    <img src="data:image/jpeg;base64,'.base64_encode($value["COURSE_PICTURE"]).'"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$value["TITLE"].'</h5>
                                        <p class="card-text">
                                            '.$value["SHORT_DESCRIPTION"].'
                                        </p>
                                        <p class="card-text" style="text-align: right;"><small class="cost">'.$value["PRICE"].'</small></p>
                                    </div>
                                </div>
                            </a>';
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- /NEWEST  -->

    <!-- POPULAR -->
    <div class="home most-popular col-12" style="padding: 10px;">
        <div class="col-12 title text-center">
            <h3>Popular</h3>
            <hr>
        </div>

        <div class="col-12 popular-courses" style="padding: 10px;">

            <div class="row" style="display: flex; justify-content:start;">

              <?php
                    $courses = Course::selectPopularCourses();
                    foreach ($courses as $key => $value) {
                        if(isset($_SESSION['email'])){
                            echo '<a href="course.php?course='.$value["COURSE_ID"].'" class="a-course">';
                        }else{
                            echo '<a href="#" class="a-course">';
                        }
                        echo '<div class="card p-0" style="width: 18rem;">
                                    <img src="data:image/jpeg;base64,'.base64_encode($value["COURSE_PICTURE"]).'"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$value["TITLE"].'</h5>
                                        <p class="card-text">
                                            '.$value["SHORT_DESCRIPTION"].'
                                        </p>
                                        <p class="card-text" style="text-align: right;"><small class="cost">'.$value["PRICE"].'</small></p>
                                    </div>
                                </div>
                            </a>';
                    }
                ?>

            </div>
        </div>
    </div>

    <!-- /POPULAR -->

        <!-- MOST LIKED -->
    <div class="home most-popular col-12" style="padding: 10px;">
        <div class="col-12 title text-center">
            <h3>Best Rated</h3>
            <hr>
        </div>

        <div class="col-12 popular-courses" style="padding: 10px;">

            <div class="row" style="display: flex; justify-content:start;">

              <?php
                    $bestRated = Course::selectBestRated();
                    foreach ($bestRated as $key => $value) {
                        if(isset($_SESSION['email'])){
                            echo '<a href="course.php?course='.$value["COURSE_ID"].'" class="a-course">';
                        }else{
                            echo '<a href="#" class="a-course">';
                        }
                        echo '<div class="card p-0" style="width: 18rem;">
                                    <img src="data:image/jpeg;base64,'.base64_encode($value["COURSE_PICTURE"]).'"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$value["TITLE"].'</h5>
                                        <p class="card-text">
                                            '.$value["SHORT_DESCRIPTION"].'
                                        </p>
                                        <p class="card-text" style="text-align: right;"><small class="cost">'.$value["PRICE"].'</small></p>
                                    </div>
                                </div>
                            </a>';
                    }
                ?>

            </div>
        </div>
    </div>

    <!-- /MOST LIKED -->

    <!-- /Content -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/validation/notifications.js"></script>
    <script src="js/searchBar.js"></script>
    <!-- /JS -->
</body>

</html>
