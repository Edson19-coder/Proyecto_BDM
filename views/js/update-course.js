$(document).ready(() => {

  var userId = String($("#sesion").val());
  var courseId = String($("#courseId").val());

  var listCategories = [];
  var lessonList = [];
  var newLessonList = [];
  var indiceEditActive = -1;

  $( "#loader" ).hide();

  getCourseInformationUpdate();
  getAllCategories();
  getAllCategoriesByCourse();
  getLessonInformationUpdate();

  $('#InputCategory').click(() => {
    validationButtonAddCategorie();
  });

  $('#btn-add-category').click( () => {
      var categoryId = $('#InputCategory').val();
      listCategories.push(categoryId);
      var categoryName = $('#InputCategory option:selected').text();
      $('#categories-body').append('<span class="badge bg-primary" style="margin-right: 5px;">'+categoryName+'  <i class="fas fa-times btn-delete-category" data-categoryid="'+categoryId+'"></i> </span>');
      $('#btn-add-category').prop('disabled', true);
      createCourseCategories(categoryId);
  });

  $('#categories-body').on('click', '.btn-delete-category', function() {
      $(this).closest('span').remove();
      var toRemove = $(this).data("categoryid");

      listCategories = listCategories.filter(function(item) {
          return parseInt(item,10) !== toRemove
      });

      var categoryId = $('#InputCategory').val();

      if(categoryId == toRemove) {
          $('#btn-add-category').prop('disabled', false);
      }

      deleteCourseCategories(toRemove);
  });

  $('#btn-edit-course').on('click', (event) => {
      event.preventDefault();

      updateCourse($('#InputTitle').val(), $('#InputShortDescription').val(), $('#InputLongDescription').val(), $('#InputPrice').val(), courseId);
  });

  function validationButtonAddCategorie() {
    var categoryId = $('option:selected').val();

    if(listCategories.includes(categoryId)) {
        $('#btn-add-category').prop('disabled', true);

    } else {
        $('#btn-add-category').prop('disabled', false);
    }
  }

  /* Edición de lecciones */

  $('.table tbody').on('click', '.btn-edit-lesson-u', function() {
      var indiceString = $(this).parents('td').parents('tr').children('td.titleCol').html();
      indiceEditActive = lessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })

      $('#InputUpdateLessonTitleEdit').val(lessonList[indiceEditActive].lessonTitle);
      $('#InputUpdateLessonDescriptionEdit').val(lessonList[indiceEditActive].lessonDescription);
      $('#InputUpdateLessonPriceEdit').val(lessonList[indiceEditActive].lessonPrice);

  });

  $('#btn-edit-update-lesson').on('click', (event) => {
      event.preventDefault();

      $( "#loader" ).show();

      var titleEdit = $('#InputUpdateLessonTitleEdit').val();
      var descriptionEdit = $('#InputUpdateLessonDescriptionEdit').val();
      var priceEdit = $('#InputUpdateLessonPriceEdit').val();

      updateLesson(lessonList[indiceEditActive].lessonId, titleEdit, descriptionEdit, priceEdit);

      $('#editUpdateLesson').modal('toggle');

      $('#InputUpdateLessonTitleEdit').val('');
      $('#InputUpdateLessonDescriptionEdit').val('');
      $('#InputUpdateLessonPriceEdit').val('');
      $('#InputVideoUpdateLessonEdit').val('');
      $('#InputImageUpdateLessonEdit').val('');
      $('#InputFileUpdateLessonEdit').val('');
  });

  /* CREACIÓN DE CATEGORIAS: */

  $('#btnCategoryAdd').click(() => {
      var categoryName = $('#InputNameCategoryAdd').val();
      checkCategory(categoryName);
      $('#InputNameCategoryAdd').val('');
  });

  /* GESTIÓN DE LECCIÓNES NUEVAS */

  $('#btn-add-lesson').on('click', (event) => {
      event.preventDefault();

      var videoLesson = document.getElementById('InputVideoLessonAdd');
      var imageLesson = document.getElementById('InputImageLessonAdd');
      var docLesson = document.getElementById('InputFileLessonAdd');

      var newLesson = new Lesson($('#InputLessonTitleAdd').val(), $('#InputLessonDescriptionAdd').val(), $('#InputLessonPriceAdd').val(), videoLesson.files[0], imageLesson.files[0], docLesson.files[0]);

      newLessonList.push(newLesson);
      newLesson.setId(newLessonList.length);
      $('#newLessonTBody').append(newLesson.getHtml());

      console.log(newLessonList);

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
      var indice = newLessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })
      newLessonList.splice(indice , 1);
      console.log(newLessonList);
  });

  /* Edición de lecciones */

  $('.table tbody').on('click', '.btn-edit-lesson', function() {
      var indiceString = $(this).parents('td').parents('tr').children('td.titleCol').html();
      indiceEditActive = newLessonList.findIndex(function(o) { return o.lessonTitle === indiceString; })

      $('#InputLessonTitleEdit').val(newLessonList[indiceEditActive].lessonTitle);
      $('#InputLessonDescriptionEdit').val(newLessonList[indiceEditActive].lessonDescription);
      $('#InputLessonPriceEdit').val(newLessonList[indiceEditActive].lessonPrice);

  });

  $('#btn-edit-lesson').on('click', (event) => {
      event.preventDefault();

      newLessonList[indiceEditActive].lessonTitle = $('#InputLessonTitleEdit').val();
      newLessonList[indiceEditActive].lessonDescription = $('#InputLessonDescriptionEdit').val();
      newLessonList[indiceEditActive].lessonPrice = $('#InputLessonPriceEdit').val();

      var videoLessonEdit = document.getElementById('InputVideoLessonEdit').files[0];
      var imageLessonEdit = document.getElementById('InputImageLessonEdit').files[0];
      var docLessonEdit = document.getElementById('InputFileLessonEdit').files[0];

      newLessonList[indiceEditActive].lessonVideo = videoLessonEdit != undefined ? videoLessonEdit : newLessonList[indiceEditActive].lessonVideo;
      newLessonList[indiceEditActive].lessonImage = imageLessonEdit != undefined ? imageLessonEdit : newLessonList[indiceEditActive].lessonImage;
      newLessonList[indiceEditActive].lessonFile = docLessonEdit != undefined ? docLessonEdit : newLessonList[indiceEditActive].lessonFile;

      $(".table tbody#newLessonTBody tr").remove();

      for(let lesson of newLessonList) {
          var newLesson = new Lesson(lesson.lessonTitle, lesson.lessonDescription, lesson.lessonPrice, "", "", "");
          newLesson.setId(lesson.id);
          $('#newLessonTBody').append(newLesson.getHtml());
      }
      console.log(newLessonList);
      $('#editLesson').modal('toggle');
  });

  function updateCourse(titleCourse, shortDescriptionCourse, longDescriptionCourse, priceCourse, courseId) {
      var imageCourse = $('#miniature-course')[0].files[0];

      var formData = new FormData();
      formData.append('vAction','UCI');
      formData.append('InputTitle', titleCourse);
      formData.append('InputShortDescription', shortDescriptionCourse);
      formData.append('InputLongDescription', longDescriptionCourse);
      formData.append('InputPrice', priceCourse);
      if(imageCourse != undefined) {
        formData.append('InputImage', imageCourse);
      }
      formData.append('courseId', parseInt(courseId));

      $.ajax({
         url: "../controllers/update-course.php",
         async: true,
         type: "POST",
         data: formData,
         processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data) {
              if(data && newLessonList.length > 0) {
                createLesson();
              }
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  /* TRAER TODAS LA INFORMACIÓN DEL CURSO A EDITAR */

  function getLessonInformationUpdate() {
      var categoryData = {
          vAction: 'SALC',
          courseId: courseId
      };

      $.ajax({
         url: "../controllers/update-course.php",
         type: "POST",
         data: categoryData,
         dataType: 'json',
          success: function(data) {
            $('#lessonTBody').empty();
            data.forEach(lesson => {
              var updateLesson = new LessonUpdate(lesson.LESSON_ID, lesson.TITLE, lesson.DESCRIPTION, lesson.PRICE, null, null, null)
              lessonList.push(updateLesson);
              updateLesson.setId(lessonList.length);
              $('#lessonTBody').append(updateLesson.getHtml());
            });
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  /* TRAER TODAS LA INFORMACIÓN DEL CURSO A EDITAR */

  function getCourseInformationUpdate() {
      var categoryData = {
          vAction: 'SUC',
          courseId: courseId
      };

      $.ajax({
         url: "../controllers/update-course.php",
         type: "POST",
         data: categoryData,
         dataType: 'json',
          success: function(data) {
            $('#InputTitle').val(data.TITLE);
            $('#InputShortDescription').val(data.SHORT_DESCRIPTION);
            $('#InputLongDescription').val(data.LONG_DESCRIPTION);
            $('#InputPrice').val(data.PRICE);
            $('#btn-next-course-information').prop('disabled', false);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  /* TRAER TODAS LAS CATEGORIAS DEL CURSO A EDITAR */

  function getAllCategoriesByCourse() {
      var categoryData = {
          vAction: 'SCC',
          courseId: courseId
      };

      $.ajax({
         url: "../controllers/update-course.php",
         type: "POST",
         data: categoryData,
         dataType: 'json',
          success: function(data) {
            data.forEach(category => {
              $('#categories-body').append('<span class="badge bg-primary" style="margin-right: 5px;">'+category.CATEGORY_NAME+'  <i class="fas fa-times btn-delete-category" data-categoryid="'+category.CATEGORY_ID+'"></i> </span>');
              listCategories.push(category.CATEGORY_ID);
              validationButtonAddCategorie();
            });
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
         url: "../controllers/update-course.php",
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

  /* CREACIÓN DE CATEGORIAS: */

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

  function createCourseCategories(categoryId) {

    var lessonData = {
         vAction: 'ICC',
         InputCategoryId: categoryId,
         InputCourseId: courseId
     };

     $.ajax({
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

  function deleteCourseCategories(categoryId) {

    var categoryData = {
         vAction: 'DCC',
         courseId: courseId,
         categoryId: categoryId
     };

     $.ajax({
        url: "../controllers/update-course.php",
        type: "POST",
        data: categoryData,
        dataType: 'json',
         success: function(data) {
             console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
             alert("Status: " + textStatus); alert("Error: " + errorThrown);
         }
     });

  }

  /* ACTUALIZACION DE LECCION DEL CURSO */

  function updateLesson(lessonId, lessonTitle, lessonDescription, lessonPrice) {

        var lessonData = {
            vAction: 'ULD',
            InputLessonTitle: lessonTitle,
            InputLessonDescription: lessonDescription,
            InputLessonPrice: lessonPrice,
            lessonId: lessonId
        };

        var promsie = $.ajax({
           url: "../controllers/update-course.php",
           type: "POST",
           data: lessonData,
           dataType: 'json',
           async: false,
            success: function(data) {
                if(data) {
                  lessonList = [];
                  getLessonInformationUpdate();

                  var imageLessonEdit = document.getElementById('InputImageUpdateLessonEdit').files[0];
                  var videoLessonEdit = document.getElementById('InputVideoUpdateLessonEdit').files[0];
                  var docLessonEdit = document.getElementById('InputFileUpdateLessonEdit').files[0];

                  if(imageLessonEdit != undefined || videoLessonEdit != undefined || docLessonEdit != undefined) {
                    updateMediLesson(lessonId, imageLessonEdit, videoLessonEdit, docLessonEdit);
                  } else {
                    $( "#loader" ).hide();
                    Swal.fire(
                        'Good job!',
                        'Lesson updated successfully!',
                        'success'
                    );
                  }

                }
           },
           error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
  }

  /* Edición de material multimedia de la lección */

  function updateMediLesson(lessonId, imageLessonEdit, videoLessonEdit, docLessonEdit) {

      var formData = new FormData();
      formData.append('vAction','UML');
      if(videoLessonEdit != undefined) {
          formData.append('InputVideoLessonEdit', videoLessonEdit);
      }
      if(imageLessonEdit != undefined) {
          formData.append('InputImageLessonEdit', imageLessonEdit);
      }
      if(docLessonEdit != undefined) {
          formData.append('InputFileLessonEdit', docLessonEdit);
      }
      formData.append('lessonId', lessonId);

      $.ajax({
        xhr: function() {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                      var percentComplete = ((evt.loaded / evt.total) * 100);
                      if(percentComplete == 100) {
                        $( "#loader" ).hide();
                        Swal.fire(
                            'Good job!',
                            'Lesson updated successfully!',
                            'success'
                        );
                      }
                  }
              }, false);
              return xhr;
          },
         url: "../controllers/update-course.php",
         type: "POST",
         data: formData,
         processData: false,
          contentType: false,
          success: function(data) {
              if(!data) {
                Swal.fire(
                    'Oh no!',
                    'Lesson not updated correctly!',
                    'error'
                );
              }
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  /* CREACIÓN DE LECCIONES NUEVAS DEL CURSO */

  function createLesson() {

      for(let lesson of newLessonList) {

          var lessonData = {
              vAction: 'IL',
              InputLessonTitle: lesson.lessonTitle,
              InputLessonDescription: lesson.lessonDescription,
              InputLessonPrice: lesson.lessonPrice,
              InputCourseId: courseId
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
              console.log(data);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

});
