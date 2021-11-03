$(document).ready(() => {

  var userId = String($("#sesion").val());
  var courseId = String($("#courseId").val());

  var listCategories = [];
  var lessonList = [];
  var indiceEditActive = -1;

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

  /* CREACIÓN DE CATEGORIAS: */

  $('#btnCategoryAdd').click(() => {
      var categoryName = $('#InputNameCategoryAdd').val();
      checkCategory(categoryName);
      $('#InputNameCategoryAdd').val('');
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
              console.log(data);
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
            console.log(data);
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

});
