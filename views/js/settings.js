$(document).ready(() => {
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

		$.ajax({
			url: '../controllers/settings.php',
			data: formData,
			type: 'POST',
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function(data){
				if(data){
					alert("YA SE HIZO EL PEDO");
				}else{
					alert("HUBO UN PEDOTEEEEE");
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
		});
	}
});