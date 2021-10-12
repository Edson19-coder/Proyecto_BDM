$(document).ready(() => {

	$('#btn-sign-up').on('click', (event) => {
        event.preventDefault();

        addUser($('#InputUserRegister').val(), $('#InputNameRegister').val(), $('#InputSecondNameRegister').val(), $('#InputLastNameRegister').val(), 
                $('#InputEmailRegister').val(), $('#InputPasswordRegister').val(), $('#InputAccountType').val());
    });

    function addUser(userName, name, secondName, lastName, userEmail, userPassword, accountType) {

         var userData = {
            InputUserRegister: userName,
            InputNameRegister: name,
            InputSecondNameRegister: secondName,
            InputLastNameRegister: lastName,
            InputEmailRegister: userEmail,
            InputPasswordRegister: userPassword,
            InputAccountType: accountType
        };

        $.ajax({     
           url: "../controllers/register.php",
           type: "POST",
           data: userData,
            success: function(data) {
                Swal.fire(
                  'Account created successfully',
                  '',
                  'success'
                ).then(function (result) {
                    if (result.value) {
                        window.location = "login.php";
                    }
                })
           },
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }  
        });
    }

});


