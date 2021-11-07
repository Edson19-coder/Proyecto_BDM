$(document).ready(() => {

    var userId = String($(".sesion").val());

    var lessonCategories = [];
    var lessonList = [];
    var indiceEditActive = -1;

    validateListIsEmpty();

    getAllCategories();

    /* GESTIÓN DE CATEGORIAS DEL CURSO */

    $('#InputCategory').click(() => {
        var categoryId = $('option:selected').val();

        if(lessonCategories.includes(categoryId)) {
            $('#btn-add-category').prop('disabled', true);

        } else {
            $('#btn-add-category').prop('disabled', false);
        }
    });

    $('#btn-add-category').click( () => {
        var categoryId = $('#InputCategory').val();
        lessonCategories.push(categoryId);
        var categoryName = $('#InputCategory option:selected').text();
        $('#categories-body').append('<span class="badge bg-primary" style="margin-right: 5px;">'+categoryName+'  <i class="fas fa-times btn-delete-category" data-categoryid="'+categoryId+'"></i> </span>');
        $('#btn-add-category').prop('disabled', true);
        validateListCategoriesIsEmpty();
    });

    $('#categories-body').on('click', '.btn-delete-category', function() {
        $(this).closest('span').remove();
        var toRemove = $(this).data("categoryid");

        lessonCategories = lessonCategories.filter(function(item) {
            return parseInt(item,10) !== toRemove
        });

        var categoryId = $('#InputCategory').val();

        if(categoryId == toRemove) {
            $('#btn-add-category').prop('disabled', false);
        }

        validateListCategoriesIsEmpty();
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

        if(videoLesson.files[0] != undefined) {
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

          validateListIsEmpty();
        } else {
          Swal.fire(
              'Select an image for the lesson!',
              '',
              'error'
          );
        }

    });

    /* Borrado de lecciones */

    $('.table tbody').on('click', '.btn-delete-lesson', function() {
        $(this).closest('tr').remove();
        var indiceString = $(this).parents('td').parents('tr').children('td.titleCol').html();
        var indice = lessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })
        lessonList.splice(indice , 1);
        validateListIsEmpty();
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

        var videoLessonEdit = document.getElementById('InputVideoUpdateLessonEdit');
        var imageLessonEdit = document.getElementById('InputImageLessonEdit');
        var docLessonEdit = document.getElementById('InputFileLessonEdit');

        lessonList[indiceEditActive].lessonVideo = videoLessonEdit != undefined ? videoLessonEdit.files[0] : lessonList[indiceEditActive].lessonVideo;
        lessonList[indiceEditActive].lessonImage = imageLessonEdit != undefined ? imageLessonEdit.files[0] : lessonList[indiceEditActive].lessonImage;
        lessonList[indiceEditActive].lessonFile = docLessonEdit != undefined ? docLessonEdit.files[0] : lessonList[indiceEditActive].lessonFile;

        console.log(lessonList);

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

        createCourse($('#InputTitle').val(), $('#InputShortDescription').val(), $('#InputLongDescription').val(), $('#InputPrice').val(), userId);
    });

    var lastIdCourse;

    function createCourse(titleCourse, shortDescriptionCourse, longDescriptionCourse, priceCourse, instructorCourse) {
        var imageCourse = $('#miniature-course')[0].files[0];

        if(imageCourse != undefined){
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
        } else {
          Swal.fire(
              'Select an image for the course!',
              '',
              'error'
          );
        }

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
               async: false,
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
        if(lesson.lessonVideo != undefined) {
            formData.append('InputVideoLesson', lesson.lessonVideo);
        }
        if(lesson.lessonImage != undefined) {
            formData.append('InputImageLesson', lesson.lessonImage);
        }
        if(lesson.lessonFile != undefined) {
            formData.append('InputFileLesson', lesson.lessonFile);
        }
        formData.append('InputLessonId', lastIdLesson);

        $.ajax({
           url: "../controllers/create-course.php",
           async: true,
           type: "POST",
           data: formData,
           processData: false,
            contentType: false,
            success: function(data) {
                if (data) {
                  Swal.fire(
                      'Good job!',
                      'Course created successfully!',
                      'success'
                  ).then(function (result) {
                      if (result.value) {
                          window.location = "index.php";
                      }
                  });

                  $("#id-index-payment").removeAttr('style');
                  $("#id-index-course-create").attr('style', 'color: #153ff7 !important');
                }
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

    function validateListIsEmpty() {
      if(lessonList.length == 0) {
        $('#btn-next-course-lesson').prop('disabled', true);
      } else {
        $('#btn-next-course-lesson').prop('disabled', false);
      }
    }

    function validateListCategoriesIsEmpty() {
      if(lessonCategories.length == 0 || InputsTextEmpty1 == true) {
        $('#btn-next-course-information').prop('disabled', true);
      } else {
        $('#btn-next-course-information').prop('disabled', false);
      }
    }

    var InputsTextEmpty1 = true;

    /* VALIDACIONES */

    $( "#btn-next-course-information" ).prop( "disabled", true );

    $('.content-menu').keyup( () => {
        if($('#InputTitle').val().length <= 0 || $('#InputShortDescription').val().length <= 0 || $('#InputLongDescription').val().length <= 0) {
            InputsTextEmpty1 = true;
            validateListCategoriesIsEmpty();
        } else {
            InputsTextEmpty1 = false;
            validateListCategoriesIsEmpty()
        }
    })

    $('#InputTitle').keyup( () => {
        if($('#InputTitle').val().length <= 0) {
            $('#span-course-title').removeClass('hide');
        }
        else {
            $('#span-course-title').addClass('hide');
        }
    });

    $('#InputShortDescription').keyup( () => {
        if($('#InputShortDescription').val().length <= 0) {
            $('#span-short-description-course').removeClass('hide');
        }
        else {
            $('#span-short-description-course').addClass('hide');
        }
    });

    $('#InputLongDescription').keyup( () => {
        if($('#InputLongDescription').val().length <= 0) {
            $('#span-long-description-course').removeClass('hide');
        }
        else {
            $('#span-long-description-course').addClass('hide');
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $( "#btn-add-lesson" ).prop( "disabled", true );

    $('.content-menu').keyup( () => {
        if($('#InputLessonTitleAdd').val().length <= 0 || $('#InputLessonDescriptionAdd').val().length <= 0 || $('#InputLessonPriceAdd').val().length <= 0) {
            $( "#btn-add-lesson" ).prop( "disabled", true );
        } else {
            $( "#btn-add-lesson" ).prop( "disabled", false );
        }
    })


    $('#InputLessonTitle').keyup( () => {
        if($('#InputLessonTitle').val().length <= 0) {
            $('#span-lesson-title').removeClass('hide');
        }
        else {
            $('#span-lesson-title').addClass('hide');
        }
    });

    $('#InputLessonDescription').keyup( () => {
        if($('#InputLessonDescription').val().length <= 0) {
            $('#span-lessson-description').removeClass('hide');
        }
        else {
            $('#span-lessson-description').addClass('hide');
        }
    });

    $('#InputLessonPrice').keyup( () => {
        if($('#InputLessonPrice').val().length <= 0) {
            $('#span-lessson-price').removeClass('hide');
        }
        else {
            $('#span-lessson-price').addClass('hide');
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $( "#btn-create-course" ).prop( "disabled", true );

    $('#InputPrice').keyup( () => {
        if($('#InputPrice').val().length <= 0) {
            $( "#btn-create-course" ).prop( "disabled", true );
        }
        else {
            $( "#btn-create-course" ).prop( "disabled", false );
        }
    });

});
