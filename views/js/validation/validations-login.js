$(document).ready( () => {

    $( "#btn-sign-in" ).prop( "disabled", true );

    $('.login-content').keyup( () => {
        if($('#InputPasswordLogin').val().length <= 0 || $('#InputEmailLogin').val().length <= 0 || !validarEmail($('#InputEmailLogin').val())) {
            $( "#btn-sign-in" ).prop( "disabled", true );
        } else {
            $( "#btn-sign-in" ).prop( "disabled", false );
        }
    })
    

    $('#InputPasswordLogin').keyup( () => {
        if($('#InputPasswordLogin').val().length <= 0) {
            $('#span-password').removeClass('hide');
        }
        else {
            $('#span-password').addClass('hide');
        }
    });

    $('#InputEmailLogin').keyup( () => {
        if($('#InputEmailLogin').val().length <= 0) {
            $('#span-email').removeClass('hide');
        }
        else {
            $('#span-email').addClass('hide');

            if(validarEmail($('#InputEmailLogin').val())) {
                $('#span-email-2').addClass('hide');
            } else {
                $('#span-email-2').removeClass('hide');
            }
        }
    });


    function validarEmail(valor){
        re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
        
        return !re.exec(valor) ? false : true; 
    
    }

});
