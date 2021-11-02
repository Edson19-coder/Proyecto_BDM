
$('.add-cart').on('click', notificationAddToCart);
//$("#btn-check-out").on('click', checkOutSuccess);

function notificationAddToCart() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'info',
        title: 'Course added to cart'
    })
}

function checkOutSuccess() {

    Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
    )
    .then(function (result) {
        if (result.value) {
            window.location = "index.php";
        }
    })

    $("#id-index-payment").removeAttr('style');
    $("#id-index-course-create").attr('style', 'color: #153ff7 !important');
}
