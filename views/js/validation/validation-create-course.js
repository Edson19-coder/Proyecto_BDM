$(document).ready( () => {

    $( "#btn-next-course-information" ).prop( "disabled", true );

    $('.content-menu').keyup( () => {
        if($('#InputTitle').val().length <= 0 || $('#InputShortDescription').val().length <= 0 || $('#InputLongDescription').val().length <= 0) {
            $( "#btn-next-course-information" ).prop( "disabled", true );
        } else {
            $( "#btn-next-course-information" ).prop( "disabled", false );
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
        if($('#InputLessonTitle').val().length <= 0 || $('#InputLessonDescription').val().length <= 0 || $('#InputLessonPrice').val().length <= 0) {
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

    

});