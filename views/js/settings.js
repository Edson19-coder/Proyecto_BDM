$(document).ready(() => {

	var id = String($(".sesion").val());
	var userData = {
		vAction: 'S',
		userId: id
	};

	$.ajax({
		url: '../controllers/user.php',
		type: "POST",
		data: userData,
		dataType: 'json',
		success: function(data){
			console.log(data);
			$("#InputUserNameSettings").val(data.USERNAME);
			$("#InputFirstNameSettings").val(data.FIRST_NAME);
			$("#InputSecondNameSettings").val(data.SECOND_NAME);
			$("#InputLastNameSettings").val(data.LAST_NAME);
			$("#InputCountrySettings").val(data.COUNTRY);
			$("#InputStateSettings").val(data.STATE);
			$("#InputCitySettings").val(data.CITY);
			$("#InputPCSettings").val(data.POSTAL_CODE);
			$("#InputEmailSettings").val(data.EMAIL);
			$("#InputPasswordSettings").val(data.USER_PASSWORD);
			$("#InputAccountType").val(data.ACCOUNT_TYPE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.warn(XMLHttpRequest.responseText);
                alert("Status de papu: " + textStatus); 
                alert("Error papu: " + errorThrown); 
                //window.location.reload();
            }
	});

	$("#btn-update-image").on('click', (event) =>{
		event.preventDefault();

		var usr = $(".sesion").val();
		updateProfilePicture(usr);
	});

	function updateProfilePicture(user){
		var image = $("#InputImageSettings")[0].files[0];

		var formData = new FormData();
		formData.append('vAction', 'UPP');
		formData.append('user_id', user);
		formData.append('InputImageSettings', image);

		for (var value of formData.keys()) {
		   console.log(value);
		}

		for (var value of formData.values()) {
		   console.log(value);
		}

		$.ajax({
			url: '../controllers/settings.php',
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: 'text',
			success: function(data){
				if(!data){
					window.location.reload();
					//alert("YA SE HIZO EL PEDO" + data);
				}else{
					alert("HUBO UN PEDOTEEEEE" + data);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.warn(XMLHttpRequest.responseText);
                alert("Status de papu: " + textStatus); 
                alert("Error papu: " + errorThrown); 
                window.location.reload();
            }
		});
	}

	$("#btn-update").on('click', (event) =>{
		event.preventDefault();

		var user_id = $(".sesion").val();
		var username = $("#InputUserNameSettings").val();
		var first_name = $("#InputFirstNameSettings").val();
		var second_name = $("#InputSecondNameSettings").val();
		var last_name = $("#InputLastNameSettings").val();
		var country = $("#InputCountrySettings").val();
		var state = $("#InputStateSettings").val();
		var city = $("#InputCitySettings").val();
		var postal_code = $("#InputPCSettings").val();
		var email = $("#InputEmailSettings").val();
		var password = $("#InputPasswordSettings").val();
		var account_type = $("#InputAccountType").val();

		updateUserInformation(user_id, username, first_name, second_name, last_name, country, state, city, postal_code, email, password, account_type);
	});

	function updateUserInformation(user_id, username, first_name, second_name, last_name, country, state, city, postal_code, email, password, account_type){
		var userData = {
			vAction: 'U',
			userId: user_id,
			username: username,
			firstName: first_name,
			secondName: second_name,
			lastName: last_name,
			country: country,
			state: state,
			city: city,
			postalCode: postal_code,
			email: email,
			password: password,
			accountType: account_type
		};

		$.ajax({
			url: '../controllers/user.php',
			type: "POST",
			data: userData,
			dataType: 'json',
			success: function(data){
				Swal.fire(
                      'Your information has been updated.',
                      '',
                      'success'
                    )
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.warn(XMLHttpRequest.responseText);
                alert("Status de papu: " + textStatus); 
                alert("Error papu: " + errorThrown); 
            }
		});
	}

});