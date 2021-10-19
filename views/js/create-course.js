$(document).ready(() => {

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
           //dataType: 'json',
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
           //dataType: 'json',
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

        console.log(lessonList);
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

        console.log(lessonList[indiceEditActive]);
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

    /* TRAER TODAS LAS CATEGORIAS */

    function getAllCategories() {
        var categoryData = {
            vAction: 'SAC'
        };

        $.ajax({     
           url: "../controllers/create-course.php",
           type: "POST",
           data: categoryData,
           //dataType: 'json',
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