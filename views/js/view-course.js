$( document ).ready(function() {

    var cant = $(":checkbox:checked").length;
    var checkCant = document.getElementById('lessonList');
    var inputsCant = checkCant.getElementsByTagName('input').length;

    function checkCertificate(){
        if(cant == inputsCant){
        $("#btn-get-certificate").prop('disabled', false);
        }
    }
    
    
    $("#lessonList").click(function(){
        var b = $(event.target);
        if(b.parents().is("a")){
            var lessonId = $(b).parents("a").attr('leccionNumero');
            $("#videoArea").attr('leccionNumero', lessonId);
        }

        if (b.is("input")){
            var lessonId = $(b).attr('value');
            var courseId = $("form.courseId").attr('courseId');
            var userId = $("form.userId").attr('userId');
            var checkboxId = $(b).attr('id');
            var insertLessonViewed = {
                vAction: 'ILV',
                lessonId:lessonId,
                courseId:courseId,
                userId:userId
            }
            
            $.ajax({
                url: '../controllers/view-course.php',
                type: 'POST',
                data: insertLessonViewed,
                dataType: 'json',
                success: function(data){
                    Swal.fire(
                      'You competed this course.',
                      '',
                      'success'
                    )
                    $(b).prop('disabled', true);
                    console.log(checkboxId);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.warn(XMLHttpRequest.responseText);
                alert("Status de papu: " + textStatus); 
                alert("Error papu: " + errorThrown); 
                }
            });
        }
    });

    $(".form-check-input").on('change', function(){
        cant = $(":checkbox:checked").length;
        checkCertificate();
    });
});
