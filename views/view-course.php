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
    <link rel="stylesheet" href="css/view-course.css">
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
    ?>
    <!-- /NAVBAR -->
    <input type="hidden" class="sesionFirstName" id="sesionFirstName" value="<?php echo $_SESSION['firstName'] ?>"></input>
    <input type="hidden" class="sesionLastName" id="sesionLastName" value="<?php echo $_SESSION['lastNames'] ?>"></input>
    <!-- Content -->
    <?php
    $i = 1;
        $courseId = $_GET['course'];
        $lessons = Lesson::getLessonsDataFromCourse($courseId);
        if(isset($_GET['lesson'])){ $ln = $_GET['lesson'] - 1; }
    ?>
    <form type="hidden" class="courseId" courseId="<?php echo $_GET['course']; ?>"></form>
    <form type="hidden" class="userId" userId="<?php echo $_SESSION['id']; ?>"></form>
    <div class="container col-12 view-course" style="padding: 20px;">
        <div class="row">
            <div class="col-md-8 video-course">
                <div id="content-view">
                    <div class="col-12 title text-start">
                        <h3>Leccion numero <?php if(isset($_GET['lesson'])){ echo $_GET['lesson']; }else{ echo "1"; } ?> </h3>
                        <hr>
                    </div>
                    <?php
                            if(isset($_GET['lesson'])){
                                if($lessons[$ln]["VIDEO"] != null){
                                    echo '<h3>Video de la clase:</h3><video controls="" id="videoArea">
                                    <source src="'.$lessons[$ln]['VIDEO'].'" type="video/mp4">
                                    </video>';
                                }else{
                                    echo '<h5>This lesson has no video.</h5>';
                                }
                            }else if($lessons[0]["VIDEO"] != null){
                                echo '<h3>Video de la clase:</h3><video controls="" id="videoArea">
                                <source src="'.$lessons[$ln]['VIDEO'].'" type="video/mp4">
                                </video>';
                            }else{
                                echo '<h5>This lesson has no video.</h5>';
                            }
                        ?>
                    <hr>

                    <!-- RESOURCES -->
                    <div class="accordion accordion-flush" id="accordionLessonResources">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Lesson Resources
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionLessonResources">
                                <div class="accordion-body">

                                    <h5>Lesson document: </h3>
                                    <?php
                                         if(isset($_GET['lesson'])){
                                            if($lessons[$ln]["DOCUMENT"] != null){
                                                echo '<a href="'.$lessons[$ln]["DOCUMENT"].'" class="btn btn-primary" style="color:white;" download="Documento">Descargar Archivo</a>';
                                            }else{
                                                echo "<h5>Ths lesson does not have a document no download.</h5>";
                                            }
                                        }else if($lessons[0]["DOCUMENT"] != null){
                                            echo '<a href="'.$lessons[0]["DOCUMENT"].'" class="btn btn-primary" style="color:white;" download="Documento">Descargar Archivo</a>';
                                        }else{
                                            echo "<h5>Ths lesson does not have a document no download.</h5>";
                                        }
                                    ?>
                                    <br>
                                    <br>
                                    <?php
                                    if(isset($_GET['lesson'])){
                                        if($lessons[$ln]['IMAGES'] != null){
                                            echo '<h5>Lesson Image: </h3>
                                            <img src="data:image/jpeg;base64,'.base64_encode($lessons[$ln]["IMAGES"]).'" style="max-width: 815px; max-height: 476px;" class="card-img-top" alt="...">';
                                        }else{
                                            echo '<h5>No image available.</h5>';
                                        }
                                    }else{
                                        echo '<h5>No image available.</h5>';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /RESOURCES -->

                    <hr>
                    <h5 class="fw-bold">Description:</h5>
                    <p><?php
                    if(isset($_GET['lesson'])){
                        echo $lessons[$ln]["DESCRIPTION"];
                    }else{
                        echo $lessons[0]["DESCRIPTION"];
                    } ?></p>
                </div>
            </div>

            <div class="col-md-4 seactions-course">
                <div class="col-12 title text-start">
                    <h3>Content</h3>
                    <hr>
                </div>

                <div id="lessonList">
                    <?php
                        foreach ($lessons as $key => $value) {
                            $lessonsViewed = Lesson::getLessonViewed($_SESSION['id'], $_GET['course'], $value["LESSON_ID"]);
                            if($lessonsViewed != null){
                                if($lessonsViewed["ID_LESSON"] == $value["LESSON_ID"]){
                                    echo '<a class="lessonViewBtn" href="view-course.php?course='.$_GET['course'].'&lesson='.$i.'" style="cursor: pointer;" id="'.$i.'" value="'.$value["LESSON_ID"].'" leccionNumero="'.$value["LESSON_ID"].'">
                                    <div class="card content-course">
                                        <div class="card-body col-12 video-seen">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="lessonName">'.$value["TITLE"].'</p>
                                                </div>
                                                <div class="col-2">
                                                    <div id="divCheckbox">
                                                        <input class="form-check-input" id="'.$i.'" type="checkbox" value="'.$value["LESSON_ID"].'" disabled checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                                }
                            }else{
                                echo '<a class="lessonViewBtn" href="view-course.php?course='.$_GET['course'].'&lesson='.$i.'" style="cursor: pointer;" id="'.$i.'" value="'.$value["LESSON_ID"].'" leccionNumero="'.$value["LESSON_ID"].'">
                                    <div class="card content-course">
                                        <div class="card-body col-12 video-seen">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="lessonName">'.$value["TITLE"].'</p>
                                                </div>
                                                <div class="col-2">
                                                    <div id="divCheckbox">
                                                        <input class="form-check-input" id="'.$i.'" type="checkbox" value="'.$value["LESSON_ID"].'">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                            }

                                $i++;
                        }
                    ?>

                </div>

                <button type="button" id="btn-get-certificate" disabled class="btn btn-primary" style="width: 100%; margin-top: 20px;">
                GET CERTIFICATE
                </button>
                <button  type="button" id="btn-send-comment" disabled class="btn btn-primary" style="width: 100%; margin-top: 20px;" data-bs-toggle="modal" data-bs-target="#modalCommentCourse">
                            Qualificate Course
                    </button>
                <!-- Modal CALIFICAR Lesson -->
                    <div class="modal fade" id="modalCommentCourse" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="xdlmaolol" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="xdlmaolol">Tell us what you think!<span class="text-primary"></span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Calificación:</h5>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <input type="number" min="0" step="0.5" max="10" id="txtQualification" class="form-control" maxlength="3" placeholder="10">
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Comentario:</h5>
                                            <div class="col-12 mb-3">
                                                <input type="text" id="txtComment" class="form-control" maxlength="500" placeholder="Comentario...">
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="btn-qualify-course" data-bs-dismiss="modal" class="btn btn-primary">Subir comentario</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal CALIFICAR Lesson -->
            </div>
        </div>
    </div>

    <!-- /Content -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/searchBar.js"></script>
    <script src="js/view-course.js"></script>
    <!-- /JS -->
</body>

</html>
