$(document).ready(() => {

	$('#btn-sign-in').on('click', (event) => {
        event.preventDefault();

        getUser($('#InputEmailLogin').val(), $('#InputPasswordLogin').val());
    });

    function getUser(userEmail, userPassword) {

         var userData = {
            InputEmailLogin: userEmail,
            InputPasswordLogin: userPassword,
        };

        $.ajax({     
           url: "../controllers/login.php",
           type: "POST",
           data: userData,
           dataType: 'json',
            success: function(data) {
                if(data) {
                    window.location = "index.php";
                } else {
                    Swal.fire(
                      'Incorrect data or the user does not exist',
                      '',
                      'error'
                    )
                }
           },
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }  
        });
    }

});