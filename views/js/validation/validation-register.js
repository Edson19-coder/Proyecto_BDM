$(document).ready( () => {

    $( "#btn-sign-up" ).prop( "disabled", true );

    $('.register-content').keyup( () => {
        if($('#InputUserRegister').val().length <= 0 || $('#InputNameRegister').val().length <= 0 || $('#InputLastNameRegister').val().length <= 0 || $('#InputEmailRegister').val().length <= 0 || 
            $('#InputPasswordRegister').val().length <= 0 || !validarEmail($('#InputEmailRegister').val()) || !validatePassword($('#InputPasswordRegister').val())) {
            $( "#btn-sign-up" ).prop( "disabled", true );
        } else {
            $( "#btn-sign-up" ).prop( "disabled", false );
        }
    });

    $('#InputUserRegister').keyup( () => {
        if($('#InputUserRegister').val().length <= 0) {
            $('#span-user-name').removeClass('hide');
        } else {
            $('#span-user-name').addClass('hide');
        }
    });

    $('#InputNameRegister').keyup( () => {
        if($('#InputNameRegister').val().length <= 0) {
            $('#span-name').removeClass('hide');
        } else {
            $('#span-name').addClass('hide');
        }
    });

    $('#InputLastNameRegister').keyup( () => {
        if($('#InputLastNameRegister').val().length <= 0) {
            $('#span-last-name').removeClass('hide');
        } else {
            $('#span-last-name').addClass('hide');
        }
    });

    $('#InputEmailRegister').keyup( () => {
        if($('#InputEmailRegister').val().length <= 0) {
            $('#span-email').removeClass('hide');
        } else {
            $('#span-email').addClass('hide');

            if(validarEmail($('#InputEmailRegister').val())) {
                $('#span-email-2').addClass('hide');
            } else {
                $('#span-email-2').removeClass('hide');
            }
        }
    });

    $('#InputPasswordRegister').keyup( () => {
        if($('#InputPasswordRegister').val().length <= 0) {
            $('#span-password').removeClass('hide');
        } else {
            $('#span-password').addClass('hide');
        }

        if(!validatePassword($('#InputPasswordRegister').val())) {
            $('#span-password-2').removeClass('hide');
        } else {
            $('#span-password-2').addClass('hide');
        }
    });

    function validarEmail(valor){
        re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
        
        return !re.exec(valor) ? false : true; 
    
    }

    function validatePassword(password)
    {
        if(password.length >= 8)
        {
            var capitalLetter = false;
            var lowerCase = false;
            var number = false;
            var special = false;

            for(var i = 0;i<password.length;i++)
            {
                if(password.charCodeAt(i) >= 65 && password.charCodeAt(i) <= 90)
                {
                    capitalLetter = true;
                }
                else if(password.charCodeAt(i) >= 97 && password.charCodeAt(i) <= 122)
                {
                    lowerCase = true;
                }
                else if(password.charCodeAt(i) >= 48 && password.charCodeAt(i) <= 57)
                {
                    number = true;
                }
                else
                {
                    special = true;
                }
            }
            if(capitalLetter == true && lowerCase == true && special == true && number == true)
            {
                return true;
            }
        }
        return false;
    }

});