$(document).ready(() => {

    var lessonCategories = [];

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
    });

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
})