$( document ).ready(function() {

    var cant = $(":checkbox:checked").length;
    var checkCant = document.getElementById('lessonList');
    var inputsCant = checkCant.getElementsByTagName('input').length;

    var student = String($(".sesionFirstName").val()+" "+$(".sesionLastName").val());
    var teacher = null;
    var courseName = null;

    checkCertificate();

    $('#btn-get-certificate').click(() => {
        var userId = $("form.userId").attr('userId');
        window.location.href = "./services/DiplomaService/DiplomaGenerate.php?user="+student+"&nomcourse="+courseName+"&nommaestro="+teacher;
    })

    function checkCertificate(){
        console.log();
        if(cant == inputsCant){
            if($(".userHasCommentedForm").attr('value') != "1"){
                $("#btn-send-comment").prop('disabled', false);
            }
            $("#btn-get-certificate").prop('disabled', false);
            getCertData();
        }
    }
    
    $(".btnEditar").click(function(){
        var xd = $(event.target);
        console.log(xd);
        if(xd.parents().is("button.btnEditar")){
            var noteName = $(xd).attr('id');
            $("#"+noteName).modal('show');
            console.log(noteName);
        }
    });
  
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

    $("#btn-qualify-course").on('click', function(){
        var courseId = $("form.courseId").attr('courseId');
        var userId = $("form.userId").attr('userId');
        var content = $("#txtComment").val();
        var qualification = $("#txtQualification").val();

        var insertComment = {
            vAction: 'I',
            courseId:courseId,
            userId:userId,
            content:content,
            qualification:qualification
        }

        $.ajax({
            url: '../controllers/comments.php',
            type: 'POST',
            data: insertComment,
            dataType: 'json',
            success: function(data){
                Swal.fire(
                      'Thank you for your opinion.',
                      '',
                      'success'
                    )
                $("#btn-send-comment").prop('disabled', true);
                console.log("NO ENTRO PERO SI ENTRO");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.warn(XMLHttpRequest.responseText);
            $("#btn-send-comment").prop('disabled', true);
            }
        });
        console.log(insertComment);
    });

    function getCertData() {
        var course = $("form.courseId").attr('courseId');

        var reportData = {
            vAction: 'CERT',
            courseId: course
        };

        $.ajax({
           url: "../controllers/reports.php",
           type: "POST",
           data: reportData,
           dataType: 'json',
            success: function(data) {
              teacher = String(data.FIRST_NAME+" "+data.LAST_NAME);
              courseName = data.TITLE;
           },
           error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    }
});
