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
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->

    <!-- Content -->

    <div class="container col-12 view-course" style="padding: 20px;">
        <div class="row">

            <div class="col-md-8 video-course">

                <div id="content-view">
                    <div class="col-12 title text-start">
                        <h3>Leccion numero 1</h3>
                        <hr>
                    </div>
                    <h3>Video de la clase:</h3><video controls="">
                        <source src="../../api/src/videos/1675prueba.mp4" type="video/mp4">
                    </video>
                    <hr>
                    <h3>Documento de la clase: </h3><a href="../../api/src/files/1821DocumentoDePrueba.docx"
                        class="btn btn-primary" style="color:white;" download="Documento">Descargar Archivo</a>
                    <hr>
                    <h5 class="fw-bold">Description:</h5>
                    <p>Esta es la descripcion de la leccion numero 1</p>
                </div>



            </div>

            <div class="col-md-4 seactions-course">

                <div class="col-12 title text-start">
                    <h3>Content</h3>
                    <hr>
                </div>

                <div id="lessonList"><a class="lessonViewBtn" style="cursor: pointer;" id="25">
                        <div class="card content-course">
                            <div class="card-body col-12 video-seen">
                                <div class="row">
                                    <div class="col-10">
                                        <p>Leccion numero 1</p>
                                        <p></p>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                        </div>
                    </a></div>

                <button type="button" id="btn-get-certificate" disabled="" class="btn btn-primary"
                    style="width: 100%; margin-top: 20px;">GET CERTIFICATE</button>
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
    <!-- /JS -->
</body>

</html>