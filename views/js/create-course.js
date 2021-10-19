$(document).ready(() => {

    var userId = String($(".sesion").val());

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
});