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
    <link rel="stylesheet" href="css/course.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>

<body>
    <!-- NAVBAR -->
    <?php 
        require_once('../models/course.php');
        require_once('../models/lesson.php');

        include 'navbar.php';

        if(isset($_GET['course'])){
            echo '<input type="hidden" class="InputCourseIdHidden" id="InputCourseIdHidden" value="'.$_GET['course'].'"></input>';
        }
        if(isset($_SESSION['id'])){
            echo '<input type="hidden" class="InputUserIdHidden" id="InputUserIdHidden" value="'.$_SESSION['id'].'"></input>';
        }
    ?>
    <!-- /NAVBAR -->

    <!-- CONTENT -->

    <?php
        $course = Course::selectCourseById($_GET['course']);
        if(isset($_SESSION['id'])){
            $userHasCourse = Course::userHasCourse($_GET['course'], $_SESSION['id']);
        }else{
            $userHasCourse["Bool"] = 0;
        }
    ?>

    <div class="container col-12" style="padding: 20px;">
        <div class="row">
            <div class="col-md-8 description-course">
                <h2><?php echo $course["TITLE"]; ?></h2>
                <p><i class="fas fa-user-alt"></i><?php echo $course["FIRST_NAME"]." ".$course["LAST_NAME"]; ?></p>
                <p><i class="fas fa-calendar"></i>Created <?php 
                $creation_date = date_create($course["CREATION_DATE"]);
                echo date_format($creation_date, 'd/m/Y'); ?></p>
                <p><i class="fas fa-calendar"></i>Last update <?php
                $last_update_date = date_create($course["LAST_UPDATE_DATE"]);
                echo date_format($last_update_date, 'd/m/Y'); ?></p>
                <p><i class="fas fa-user-graduate"></i><?php
                if($course["PARTICIPANTS"] != 0){
                    echo $course["PARTICIPANTS"]; 
                }else{
                    echo "Este curso aún no tiene estudiantes inscritos.";
                }
                ?></p>
                <p><i class="fas fa-thumbs-up"></i><?php 
                if($course["QUALIFICATION"] != null){
                    echo $course["QUALIFICATION"]."/10"; 
                }else{
                    echo "Este curso aún no tiene calificaciones.";
                }
                ?></p>
                <h5>
                    <?php echo $course["SHORT_DESCRIPTION"]; ?>
                </h5>
                <p>
                <p class="fw-bold">Description:</p>
                <?php echo $course["LONG_DESCRIPTION"]; ?>
                </p>
                <hr>
                <div class="col-12">
                    <h1 style="text-align: center;">Comments</h1>

                    <div class="col-12">

                        <div class="container global container-comments" style="padding: 10px 50px;">
                            <div class="card" style="margin-top: 20px">
                                <div class="card-header message-m">
                                    <div class="col-12" style="text-align: right;">Edson19 <img
                                            src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                                            class="rounded-circle" height="50" alt="" loading="lazy"> 
                                    </div>
                                </div>
                                <div class="card-body">Este es un bonito comentario - 2021-05-22</div>
                            </div>
                        </div>

                        <form action="">
                            <div class="container">
                                <div class="col-12" style="padding-top: 20px;">
                                    <div class="col-12" style="padding: 10px; border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-10">
                                                <textarea class="form-control"
                                                    placeholder="Comment on the course"></textarea>
                                            </div>
                                            <div class="col-2" style="align-items: center;">
                                                <input type="button" value="Send" class="btn btn-primary publicar-btn"
                                                    style="line-height: 35px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($course["COURSE_PICTURE"]); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">Course:</div>
                                <div class="col-6">
                                    <input type="hidden" id="CoursePrice" value="<?php echo $course["PRICE"]; ?>">
                                    <h5 class="card-title" style="text-align: center; color: green;">$<?php echo $course["PRICE"]; ?> MXN</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">Lesson:</div>
                                <div class="col-6">
                                    <?php
                                    $lessonCourse = Lesson::getAllLessonsFromCourse($_GET['course']);
                                    ?>
                                    <input type="hidden" id="IndividualLessonPrice" value="<?php echo $lessonCourse[0]["PRICE"]; ?>">
                                    <h5 class="card-title" style="text-align: center; color: green;">$<?php echo $lessonCourse[0]["PRICE"]; ?> MXN</h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <?php
                                if($userHasCourse["Bool"] == 0){
                            ?>
                            <button id="btn-buy-course" type="button" class="col-12 btn-shop btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuyNow">
                                Buy now
                            </button>
                            <?php }else if($userHasCourse["Bool"] == 1){ ?>
                             <button id="btn-course-bought" type="button" class="col-12 btn-shop btn btn-primary" disabled>
                                You already have this course
                            </button>   
                        <?php } ?>
                            <!-- Modal Buy Lesson -->
                            <div class="modal fade" id="modalBuyNow" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold" id="staticBackdropLabel">RESUME<span
                                                    class="text-primary">.</span></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="col-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5>Price:</h5>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <h5 class="SubtotalPrice" id="SubtotalPrice" style="color: green;"></h5>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h5>Card</h5>
                                                    <form class="credit-card-div">
                                                        <div class="col-12 mb-3">
                                                            <input type="number" class="form-control" name="" id="card-number" placeholder="Enter Card Number">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 mb-3">
                                                                <span class="help-block text-muted small-font">Expiration Month</span>
                                                                <input type="number" minlength="0" max="2" name="" id="card-mouth" class="form-control" placeholder="MM">
                                                            </div>
                                                            <div class="col-4 mb-3">
                                                                <span class="help-block text-muted small-font">Expiration Year</span>
                                                                <input type="number" name="" id="card-year" class="form-control" placeholder="YYYY">
                                                            </div>
                                                            <div class="col-4 mb-3">
                                                                <span class="help-block text-muted small-font">CCV</span>
                                                                <input type="number" name="" id="card-ccv" class="form-control" placeholder="CCV">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="text" class="form-control" name="" id="card-titular" placeholder="Name On The Card">
                                                        </div>
                                                    </form>
                                                    <hr>
                                                    <p style="font-size: x-small;">
                                                        Crealink Digital está obligado por ley a recaudar los impuestos
                                                        sobre las
                                                        transacciones de las compras realizadas en determinadas
                                                        jurisdicciones fiscales.
                                                        <br>
                                                        Al completar la compra, aceptas las Condiciones de uso.
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" id="btn-check-out" data-bs-dismiss="modal"
                                                        class="btn btn-primary">Check out</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal Buy Lesson -->

                            <hr>
                            <h3 style="text-align: center;">Lessons</h3>
                            <br>
                            <form id="formCheckBoxes">
                            <?php
                            $i = 1;
                            foreach ($lessonCourse as $key => $value) {
                                if(isset($_SESSION["id"])){
                                    $userHasLesson = Lesson::userHasLesson($value["LESSON_ID"], $_SESSION["id"]);
                                }else{
                                    $userHasLesson["Bool"] = 0;
                                }
                                //print_r($userHasCourse["Bool"]);
                                //print_r($userHasLesson["Bool"]);
                                if($userHasLesson["Bool"] == 0){
                                echo '<div class="card content-course">
                                        <div class="card-body col-12 video-seen">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>'.$value["TITLE"].'</p>
                                                </div>
                                                <div class="col-4" id="divCheckbox">
                                                    <input class="form-check-input" type="checkbox" value="'.$value["LESSON_ID"].'"
                                                        id="flexCheckDefault'.$i.'"'; if($userHasCourse["Bool"] != 0 || $userHasLesson["Bool"] != 0){ echo ' checked disabled';}  echo '>
                                                </div>
                                                <div id="lessonIndividualPrice'.$i.'" value="'.$value["PRICE"].'" class="col-2">
                                                    <p>'.$value["PRICE"].'</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                                    $i++;
                                    }
                                } ?>
                            </form>
                            <br>
                            <?php if($userHasCourse["Bool"] == 0){ ?>
                            <button id="btn-buy-lessons" type="button" class="col-12 btn-shop btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalBuyNow">
                                Buy Lesson(s)
                            </button>
                            <?php }else {?>
                                <button id="btn-lessons-bought" type="button" class="col-12 btn-shop btn btn-primary" disabled>
                                You already have this lessons
                            </button>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/validation/course-notifications.js"></script>
    <script src="js/course.js"></script>
    <script src="js/searchBar.js"></script>
    <!-- /JS -->
</body>

</html>