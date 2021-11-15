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
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>
<body>
     <!-- NAVBAR -->
     <?php 
        require_once '../models/search.php';
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->

    <!-- CONTENT -->
    <div class="container col-12 searchBody">
        <div class="row">
            <div class="col-2 filter-container">
                <div class="col-12 title text-center">
                    <h3>Filters</h3>
                    <hr>

                    <form action="">

                        <div class="mb-3">
                            <label for="InputTitleCourse" class="form-label">Titulo:</label>
                            <?php if(isset($_GET['search'])) {?>
                            <input type="text" class="form-control" id="InputTitleCourse" value="<?php echo $_GET['search']; ?>">
                            <?php } else { ?>
                            <input type="text" class="form-control" id="InputTitleCourse" value="">
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label for="InputOwnerName" class="form-label">Instructor:</label>
                            <?php if(isset($_GET['owner'])) {?>
                            <input type="text" class="form-control" id="InputOwnerName" value="<?php echo $_GET['owner']; ?>">
                            <?php } else { ?>
                            <input type="text" class="form-control" id="InputOwnerName">
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label for="InputInicioDate" class="form-label">De:</label>
                            <input type="date" class="form-control" id="InputInicioDate" placeholder="Select Date..">
                            <label for="InputFinDate" class="form-label">A:</label>
                            <input type="date" class="form-control" id="InputFinDate" placeholder="Select Date..">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="InputCategory">Categories</label>
                            <div class="row">
                                <div class="col-12">
                                    <select class="form-control" id="InputCategory">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="categories-body">

                        </div>

                        <button type="button" class="btn btn-primary" id="btnSearchFilters" style="margin-bottom: 10px;">Search</button>

                    </form>

                </div>
            </div>
            <div class="col-10 search-container">
            <div class="col-12 title text-center">
                    <h3>Content</h3>
                    <hr>

                    <div class="col-12 search-courses-content">
                        <div class="row" style="display: flex; justify-content:start;">
                            
                        <?php

                            if(!isset($_GET['owner']) && !isset($_GET['from']) && !isset($_GET['to']) && !isset($_GET['category'])) {
                                
                                if(isset($_GET['search'])) {
                                    $courses = Search::getCourseByTitle($_GET['search']);
                                } else {
                                    $courses = Search::getAllCourses();
                                }
                            
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
                            } else {

                                $title = isset($_GET['search']) ? $_GET['search'] : null;
                                $ownerName = isset($_GET['owner']) ? $_GET['owner'] : null;
                                $fromDate = isset($_GET['from']) ? $_GET['from'] : null;
                                $toDate = isset($_GET['to']) ? $_GET['to'] : null;
                                $categoryId = isset($_GET['category']) ? $_GET['category'] : null;

                                $courses = Search::getCourseByFilter($title, $ownerName, $fromDate, $toDate, $categoryId);

                                if($courses != null) {
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
                                }
                            }

                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="models/lesson.js"></script>
    <script src="js/search.js"></script>
    <script src="js/searchBar.js"></script>
    <!-- /JS -->
</body>
</html>