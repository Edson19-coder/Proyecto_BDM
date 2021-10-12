$(document).ready(() => {

    informationExist();

    $('.shopping-cart-container').keyup( () =>{
        informationExist();
    });

});

function informationExist() {
    if ($('#card-number').val().length <= 0 || $('#card-mouth').val().length <= 0 || 
        $('#card-year').val().length <= 0 || $('#card-ccv').val().length <= 0 || 
        $('#card-titular').val().length <= 0) {
        $("#btn-check-out").prop("disabled", true);
    } else {
        $("#btn-check-out").prop("disabled", false);
    }
}