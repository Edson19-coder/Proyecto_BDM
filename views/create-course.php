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
    <link rel="stylesheet" href="css/create-course.css">
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
    
    <!-- CONTENT -->
    <div class="col-12 container" style="padding: 20px;">
        <div class="row">

            <div class="col-2 options-list">
                <ul>
                    <p class="fw-bold">Create Course</p>

                    <a class="nav-link" id="id-index-course-information" style="color: #153ff7 !important;">Course
                        information</a>
                    <a class="nav-link" id="id-index-course-lessons">Course lessons</a>
                    <a class="nav-link" id="id-index-payment">Price and payment destination</a>
                    <a class="nav-link" id="id-index-course-create">Create</a>
                </ul>
            </div>

            <div class="col-10 content-menu" style="padding: 20px;">

                <div id="id-course-information">
                    <!-- Course information -->
                    <div class="col-12 title text-start">
                        <h4 class="fw-bold">Course information<span class="text-primary">.</span></h4>
                        <hr>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="InputTitle" class="form-label">Course title</label>
                            <input type="text" class="form-control" id="InputTitle">
                            <span class="hide" id="span-course-title" style="color: red">*Course title is required</span>
                        </div>
                        <div class="mb-3">
                            <label for="InputShortDescription" class="form-label">Short Description</label>
                            <input type="text" class="form-control" id="InputShortDescription">
                            <span class="hide" id="span-short-description-course" style="color: red">*Short Description is required</span>
                        </div>
                        <div class="mb-3">
                            <label for="InputLongDescription" class="form-label">Long Description</label>
                            <textarea class="form-control" id="InputLongDescription"></textarea>
                            <span class="hide" id="span-long-description-course" style="color: red">*Long Description is required</span>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="InputCategory">Categories</label>
                            <div class="row">
                                <div class="col-10">
                                    <select class="form-control" id="InputCategory">
                                    </select>
                                </div>
                                <div class="col-2">
                                  <button type="button" class="btn btn-primary" id="btn-add-course"> <i class="fas fa-plus"></i> </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategory"> <i class="fas fa-edit"></i> </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="categories-body">

                        </div>

                        <!-- Modal Add Category -->
                        <div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="staticBackdropLabel">ADD CATEGORY<span
                                                class="text-primary">.</span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="InputLessonTitle" class="form-label">Category name</label>
                                            <input type="text" class="form-control" id="InputNameCategoryAdd">
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                                id="btnCategoryAdd">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal Add Category -->

                        <div class="mb-3 form-group">
                            <label for="miniature-course">Miniature of the course</label>
                            <input type="file" class="form-control-file form-control" accept="image/*" id="miniature-course">
                        </div>
                        <div class="text-end">
                            <button type="button" id="btn-next-course-information" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>

                <div class="un-active" id="id-course-lessons">
                    <!-- Course lessons -->
                    <div class="col-12 title text-start">
                        <h4 class="fw-bold">Course lessons<span class="text-primary">.</span></h4>
                        <hr>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                        data-bs-target="#addLesson">
                        <i class="fas fa-plus"></i> Add lesson
                    </button>

                    <!-- Modal Add lesson -->
                    <div class="modal fade" id="addLesson" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">ADD LESSON<span
                                            class="text-primary">.</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="InputLessonTitleAdd" class="form-label">Lesson title</label>
                                            <input type="text" class="form-control" id="InputLessonTitleAdd">
                                            <span class="hide" id="span-lesson-title" style="color: red">*Lesson title is required</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="InputLessonDescriptionAdd" class="form-label">Description</label>
                                            <textarea class="form-control" id="InputLessonDescriptionAdd"></textarea>
                                            <span class="hide" id="span-lessson-description" style="color: red">*Description is required</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="InputLessonPriceAdd" class="form-label">Price</label>
                                            <input type="number" min="0" class="form-control" name="" id="InputLessonPriceAdd">
                                            <span class="hide" id="span-lessson-price" style="color: red">*Price is required</span>
                                            <p style="color: #ff0000;">* If the cost is $0 it will marked as FREE</p>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="InputVideoLessonAdd">Video lesson</label>
                                            <input type="file" class="form-control-file form-control" accept="video/*" id="InputVideoLessonAdd">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="InputImageLessonAdd">Image lesson</label>
                                            <input type="file" class="form-control-file form-control" accept="image/*" id="InputImageLessonAdd">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="InputFileLessonAdd">File lesson</label>
                                            <input type="file" class="form-control-file form-control" accept= "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf" id="InputFileLessonAdd">
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btn-add-lesson">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Add lesson -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lesson title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="lessonTBody">
                            
                        </tbody>
                    </table>

                    <!-- Modal Edit Lesson -->
                    <div class="modal fade" id="editLesson" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">EDIT LESSON<span
                                            class="text-primary">.</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="InputLessonTitleAdd" class="form-label">Lesson title</label>
                                            <input type="text" class="form-control" id="InputLessonTitleEdit">
                                            <span class="hide" id="span-lesson-title" style="color: red">*Lesson title is required</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="InputLessonDescriptionAdd" class="form-label">Description</label>
                                            <textarea class="form-control" id="InputLessonDescriptionEdit"></textarea>
                                            <span class="hide" id="span-lessson-description" style="color: red">*Description is required</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="InputLessonPriceAdd" class="form-label">Price</label>
                                            <input type="number" min="0" class="form-control" name="" id="InputLessonPriceEdit">
                                            <span class="hide" id="span-lessson-price" style="color: red">*Price is required</span>
                                            <p style="color: #ff0000;">* If the cost is $0 it will marked as FREE</p>
                                        </div>
                                        <!--
                                        <div class="mb-3 form-group">
                                            <label for="InputVideoLessonAdd">Video lesson</label>
                                            <input type="file" class="form-control-file form-control" accept="video/*" id="InputVideoLessonEdit">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="InputImageLessonAdd">Image lesson</label>
                                            <input type="file" class="form-control-file form-control" accept="image/*" id="InputImageLessonEdit">
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="InputFileLessonAdd">File lesson</label>
                                            <input type="file" class="form-control-file form-control" accept= "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf" id="InputFileLessonEdit">
                                        </div>
                                        -->
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btn-edit-lesson">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Edit Lesson -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" id="btn-prev-course-lesson"
                                    class="btn btn-primary">Previous</button>
                                <button type="submit" id="btn-next-course-lesson" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="un-active" id="id-price-payment">
                    <!-- Price and payment destination -->
                    <div class="col-12 title text-start">
                        <h4 class="fw-bold">Price and payment destination<span class="text-primary">.</span></h4>
                        <hr>
                    </div>

                    <h5 class="mb-3">Price:</h5>
                    <div class="col-3 mb-3">
                        <input type="number" min="0" class="form-control" name="" id="InputPrice">
                    </div>
                    <p style="color: #ff0000;">* If the cost is $0 it will marked as FREE</p>
                    <h5 class="mb-3">Payment destination:</h5>
                    <form class="credit-card-div">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="" id="" placeholder="Enter Card Number">
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 credit-card-inp">
                                <span class="help-block text-muted small-font">Expiry Month</span>
                                <input type="text" name="" id="" class="form-control" placeholder="MM">
                            </div>
                            <div class="col-4 credit-card-inp">
                                <span class="help-block text-muted small-font">Expiry Year</span>
                                <input type="text" name="" id="" class="form-control" placeholder="YYYY">
                            </div>
                            <div class="col-4 credit-card-inp">
                                <span class="help-block text-muted small-font">CCV</span>
                                <input type="text" name="" id="" class="form-control" placeholder="CCV">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="" id="" placeholder="Name On The Card">
                        </div>
                    </form>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" id="btn-prev-payment" class="btn btn-primary">Previous</button>
                                <button type="submit" id="btn-create-course" class="btn btn-primary">Create</button>
                            </div>
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
    <script src="js/validation/notification-create-course.js"></script>
    <script src="js/validation/validation-create-course.js"></script>
    <script src="models/lesson.js"></script>
    <!-- <script src="js/create-course.js"></script> -->

    <script type="text/javascript">

        var lessonCategories = [];
        var lessonList = [];
        var indiceEditActive = -1;
        
        getAllCategories();

        /* GESTIÓN DE CATEGORIAS DEL CURSO */

        $('#InputCategory').click(() => {
            var categoryId = $('option:selected').val();

            if(lessonCategories.includes(categoryId)) {
                $('#btn-add-course').prop('disabled', true);

            } else {
                $('#btn-add-course').prop('disabled', false);        
            }
        });

        $('#btn-add-course').click( () => {
            var categoryId = $('#InputCategory').val();
            lessonCategories.push(categoryId);
            var categoryName = $('#InputCategory option:selected').text();
            $('#categories-body').append('<span class="badge bg-primary" style="margin-right: 5px;">'+categoryName+'  <i class="fas fa-times btn-delete-category" data-categoryid="'+categoryId+'"></i> </span>');
            $('#btn-add-course').prop('disabled', true);
        });

        $('#categories-body').on('click', '.btn-delete-category', function() {
            $(this).closest('span').remove();
            var toRemove = $(this).data("categoryid");

            lessonCategories = lessonCategories.filter(function(item) {
                return parseInt(item,10) !== toRemove
            });

            var categoryId = $('#InputCategory').val();

            if(categoryId == toRemove) {
                $('#btn-add-course').prop('disabled', false);   
            }
        });

        /* CREACIÓN DE CATEGORIAS: */

        $('#btnCategoryAdd').click(() => {
            var categoryName = $('#InputNameCategoryAdd').val();
            checkCategory(categoryName);
            $('#InputNameCategoryAdd').val('');
        });

        function createCategory(categoryName) {
            var categoryData = {
                vAction: 'IC',
                InputNameCategoryAdd: categoryName
            };

            $.ajax({     
               url: "../controllers/create-course.php",
               type: "POST",
               data: categoryData,
               dataType: 'json',
                success: function(data) {
                    $('#InputCategory').empty();
                    getAllCategories();

                    Swal.fire(
                      'Category created successfully',
                      '',
                      'success'
                    )
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }

        function checkCategory(categoryName) {
            var categoryData = {
                vAction: 'CC',
                InputNameCategoryAdd: categoryName
            };

            $.ajax({     
               url: "../controllers/create-course.php",
               type: "POST",
               data: categoryData,
               dataType: 'json',
                success: function(data) {
                    if(data == null) {
                        createCategory(categoryName);
                    } else {
                        Swal.fire(
                          'Category already existing',
                          '',
                          'error'
                        )
                    }
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }


        /* GESTIÓN DE LECCIÓNES */
        
        $('#btn-add-lesson').on('click', (event) => {
            event.preventDefault();

            var videoLesson = document.getElementById('InputVideoLessonAdd');
            var imageLesson = document.getElementById('InputImageLessonAdd');
            var docLesson = document.getElementById('InputFileLessonAdd');

            var newLesson = new Lesson($('#InputLessonTitleAdd').val(), $('#InputLessonDescriptionAdd').val(), $('#InputLessonPriceAdd').val(), videoLesson.files[0], imageLesson.files[0], docLesson.files[0]);

            lessonList.push(newLesson);
            newLesson.setId(lessonList.length);
            $('#lessonTBody').append(newLesson.getHtml());

            console.log(lessonList);

            $('#addLesson').modal('toggle');

            $('#InputLessonTitleAdd').val('');
            $('#InputLessonDescriptionAdd').val('');
            $('#InputLessonPriceAdd').val('');
            $('#InputVideoLessonAdd').val('');
            $('#InputImageLessonAdd').val('');
            $('#InputFileLessonAdd').val('');
        });

        /* Borrado de lecciones */

        $('.table tbody').on('click', '.btn-delete-lesson', function() {
            $(this).closest('tr').remove();
            var indiceString = $(this).parents('td').parents('tr').children('td.titleCol').html();
            var indice = lessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })
            lessonList.splice(indice , 1);
        });

        /* Edición de lecciones */

        $('.table tbody').on('click', '.btn-edit-lesson', function() {
            var indiceString = $(this).parents('td').parents('tr').children('td.titleCol').html();
            indiceEditActive = lessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })

            $('#InputLessonTitleEdit').val(lessonList[indiceEditActive].lessonTitle);
            $('#InputLessonDescriptionEdit').val(lessonList[indiceEditActive].lessonDescription);
            $('#InputLessonPriceEdit').val(lessonList[indiceEditActive].lessonPrice);
            
            var videoLesson = document.getElementById('InputVideoLessonAdd');
            var imageLesson = document.getElementById('InputImageLessonAdd');
            var docLesson = document.getElementById('InputFileLessonAdd');
        });

        $('#btn-edit-lesson').on('click', (event) => {
            event.preventDefault();

            lessonList[indiceEditActive].lessonTitle = $('#InputLessonTitleEdit').val(); 
            lessonList[indiceEditActive].lessonDescription = $('#InputLessonDescriptionEdit').val();
            lessonList[indiceEditActive].lessonPrice = $('#InputLessonPriceEdit').val();

            $(".table tbody tr").remove(); 

            for(let lesson of lessonList) {
                var newLesson = new Lesson(lesson.lessonTitle, lesson.lessonDescription, lesson.lessonPrice, "", "", "");
                newLesson.setId(lesson.id);
                $('#lessonTBody').append(newLesson.getHtml());
            }

            $('#editLesson').modal('toggle');
        });

        /* CREACIÓN DEL CURSO */

        $('#btn-create-course').on('click', (event) => {
            event.preventDefault();

            createCourse($('#InputTitle').val(), $('#InputShortDescription').val(), $('#InputLongDescription').val(), $('#InputPrice').val(), <?php echo $_SESSION['id'] ?>);
        });

        var lastIdCourse;

        function createCourse(titleCourse, shortDescriptionCourse, longDescriptionCourse, priceCourse, instructorCourse) {
            var imageCourse = $('#miniature-course')[0].files[0];

            var formData = new FormData();
            formData.append('vAction','I');
            formData.append('InputTitle', titleCourse);
            formData.append('InputShortDescription', shortDescriptionCourse);
            formData.append('InputLongDescription', longDescriptionCourse);
            formData.append('InputPrice', priceCourse);
            formData.append('InputImage', imageCourse);
            formData.append('InstructorCourse', parseInt(instructorCourse));

            $.ajax({     
               url: "../controllers/create-course.php",
               async: true,
               type: "POST",
               data: formData,
               processData: false, 
                contentType: false,
                dataType: 'json',
                success: function(data) {
                    lastIdCourse = data.LAST_ID;

                    if(lastIdCourse != null) {
                        createCourseCategories();
                        createLesson();
                    }
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }

        /* CREACIÓN DE CATEGORIAS DEL CURSO */

         function createCourseCategories() {

            for(let category of lessonCategories) {

               var lessonData = {
                    vAction: 'ICC',
                    InputCategoryId: category,
                    InputCourseId: lastIdCourse
                };

                var promsie = $.ajax({     
                   url: "../controllers/create-course.php",
                   type: "POST",
                   data: lessonData,
                   dataType: 'json',
                    success: function(data) {
                        console.log(data);
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }  
                });
            }
        }

        /* CREACIÓN DE LECCIONES DEL CURSO */

        function createLesson() {
            var lastIdLesson;

            for(let lesson of lessonList) {

                var lessonData = {
                    vAction: 'IL',
                    InputLessonTitle: lesson.lessonTitle,
                    InputLessonDescription: lesson.lessonDescription,
                    InputLessonPrice: lesson.lessonPrice,
                    InputCourseId: lastIdCourse
                };

                var promsie = $.ajax({     
                   url: "../controllers/create-course.php",
                   type: "POST",
                   data: lessonData,
                   dataType: 'json',
                    success: function(data) {
                        createMediLesson(data.LAST_LESSON_ID, lesson);
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }  
                });


            }
        }

        /* Creación de material multimedia de la lección */

        function createMediLesson(lastIdLesson, lesson) {

            var formData = new FormData();
            formData.append('vAction','IML');
            formData.append('InputVideoLesson', lesson.lessonVideo);
            formData.append('InputImageLesson', lesson.lessonImage);
            formData.append('InputFileLesson', lesson.lessonFile);
            formData.append('InputLessonId', lastIdLesson);

            $.ajax({     
               url: "../controllers/create-course.php",
               async: true,
               type: "POST",
               data: formData,
               processData: false, 
                contentType: false,
                success: function(data) {
                    console.log(data);
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }

        /* TRAER TODAS LAS CATEGORIAS */

        function getAllCategories() {
            var categoryData = {
                vAction: 'SAC'
            };

            $.ajax({     
               url: "../controllers/create-course.php",
               type: "POST",
               data: categoryData,
               dataType: 'json',
                success: function(data) {
                   data.forEach(category => {
                        $('#InputCategory').append($('<option>', {
                            value: category.CATEGORY_ID,
                            text: category.CATEGORY_NAME
                        }));
                   });
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }

    </script>
    <!-- /JS -->
</body>

</html>