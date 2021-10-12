$(document).ready( () => {

    var fileInput = document.getElementById("InputImageSettings");

    check();

    $('#InputImageSettings').change(() => {
        check();
    })

    function check() {
        if(fileInput.files.length == 0) {
            $( "#btn-update-image" ).prop( "disabled", true );
        } else {
            $( "#btn-update-image" ).prop( "disabled", false );
        }
    }

    $( "#btn-update" ).prop( "disabled", true );

    $('.settings-content').keyup( () => {
        if($('#InputUserNameSettings').val().length <= 0 || $('#InputFirstNameSettings').val().length <= 0 || $('#InputLastNameSettings').val().length <= 0 || $('#InputEmailSettings').val().length <= 0 || 
            $('#InputPasswordSettings').val().length <= 0 || !validarEmail($('#InputEmailSettings').val()) || !validatePassword($('#InputPasswordSettings').val())) {

            $( "#btn-update" ).prop( "disabled", true );
        
        } else {
        
            $( "#btn-update" ).prop( "disabled", false );
        
        }
    });

    $('#InputUserNameSettings').keyup( () => {
        if($('#InputUserNameSettings').val().length <= 0) {
            $('#span-user-name').removeClass('hide');
        } else {
            $('#span-user-name').addClass('hide');
        }
    });

    $('#InputFirstNameSettings').keyup( () => {
        if($('#InputFirstNameSettings').val().length <= 0) {
            $('#span-name').removeClass('hide');
        } else {
            $('#span-name').addClass('hide');
        }
    });

    $('#InputLastNameSettings').keyup( () => {
        if($('#InputLastNameSettings').val().length <= 0) {
            $('#span-last-name').removeClass('hide');
        } else {
            $('#span-last-name').addClass('hide');
        }
    });

    $('#InputEmailSettings').keyup( () => {
        if($('#InputEmailSettings').val().length <= 0) {
            $('#span-email').removeClass('hide');
        } else {
            $('#span-email').addClass('hide');

            if(validarEmail($('#InputEmailSettings').val())) {
                $('#span-email-2').addClass('hide');
            } else {
                $('#span-email-2').removeClass('hide');
            }
        }
    });

    $('#InputPasswordSettings').keyup( () => {
        if($('#InputPasswordSettings').val().length <= 0) {
            $('#span-password').removeClass('hide');
        } else {
            $('#span-password').addClass('hide');
        }

        if(!validatePassword($('#InputPasswordSettings').val())) {
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
            debugger
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