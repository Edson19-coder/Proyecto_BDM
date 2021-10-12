$(document).ready( () => {
    $("#btn-check-out").on('click', checkOutSuccess);
})

function checkOutSuccess() {

    Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
    )
    .then(function (result) {
        if (result.value) {
            window.location = "index.html";
        }
    })

    $("#id-index-payment").removeAttr('style');
    $("#id-index-course-create").attr('style', 'color: #153ff7 !important');
}