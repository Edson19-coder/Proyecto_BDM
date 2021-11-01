$(document).ready(() => {

    getAllCategories();

    var categoryId = null;

    /* GESTIÓN DE CATEGORIAS DEL CURSO */

    $('#InputCategory').click(() => {
        categoryId = $('option:selected').val();
    });

    /* FILTROS */

    $('#btnSearchFilters').on('click', (event) => {
        event.preventDefault();
        
        var title = $('#InputTitleCourse').val() != '' ? $('#InputTitleCourse').val() : null;
        var ownerName = $('#InputOwnerName').val() != '' ? $('#InputOwnerName').val() : null;
        var fromDate = $('#InputInicioDate').val() != '' ? $('#InputInicioDate').val() : null;
        var toDate = $('#InputFinDate').val() != '' ? $('#InputFinDate').val() : null;

        searchForFilters(title, ownerName, fromDate, toDate);
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

    function searchForFilters(title, ownerName, fromDate, toDate) {
        console.log(title);
        console.log(ownerName);
        console.log(fromDate);
        console.log(toDate);
        console.log(categoryId);

        var path = "search.php?";

        if(title != null) {
            path = path + "search=" + title;
        } 

        if(ownerName != null) {
            path = path + "&owner=" + ownerName;
        }

        if(fromDate != null) {
            path = path + "&from=" + fromDate;
        }

        if(toDate != null) {
            path = path + "&to=" + toDate;
        }

        if(categoryId != null) {
            path = path + "&category=" + categoryId;
        }

        window.location.href= path;
    }
})