$(document).ready( () => {

    $("#btn-next-course-information").on('click', nextCourseInformation);

    $("#btn-next-course-lesson").on('click', nextCourseLesson);

    $("#btn-prev-course-lesson").on('click', prevCourseLesson);

    $("#btn-prev-payment").on('click', prevPayment);

    //$("#btn-create-course").on('click', createSuccess);

    function nextCourseInformation() {
        if($("#id-course-lessons").hasClass("un-active")){
            $("#id-course-lessons").removeClass("un-active");
            $("#id-course-information").addClass("un-active");
            $("#id-index-course-information").removeAttr('style');
            $("#id-index-course-lessons").attr('style', 'color: #153ff7 !important');
        }
    }

    function nextCourseLesson() {
        if($("#id-price-payment").hasClass("un-active")){
            $("#id-price-payment").removeClass("un-active");
            $("#id-course-lessons").addClass("un-active");
            $("#id-index-course-lessons").removeAttr('style');
            $("#id-index-payment").attr('style', 'color: #153ff7 !important');
        }
    }

    function prevCourseLesson() {
        if($("#id-course-information").hasClass("un-active")){
            $("#id-course-information").removeClass("un-active");
            $("#id-course-lessons").addClass("un-active");
            $("#id-index-course-lessons").removeAttr('style');
            $("#id-index-course-information").attr('style', 'color: #153ff7 !important');
        }
    }

    function prevPayment() {
        if($("#id-course-lessons").hasClass("un-active")){
            $("#id-course-lessons").removeClass("un-active");
            $("#id-price-payment").addClass("un-active");
            $("#id-index-payment").removeAttr('style');
            $("#id-index-course-lessons").attr('style', 'color: #153ff7 !important');
        }
    }

    function createSuccess() {

        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        ).then(function (result) {
            if (result.value) {
                window.location = "index.php";
            }
        });

        $("#id-index-payment").removeAttr('style');
        $("#id-index-course-create").attr('style', 'color: #153ff7 !important');
    }
});
