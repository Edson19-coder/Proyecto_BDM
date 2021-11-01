$(document).ready(() => {
	var userId = $("#InputUserIdHidden").val();
	var courseId = $("#InputCourseIdHidden").val();
	var price = 0;

	console.log(userId);
	var cant = 0;
	var total = 0;

	if(userId != undefined){
		if($(":checkbox:checked").length == 0){
			$("#btn-buy-lessons").prop('disabled', true);
		}
	}else{
		$("#btn-buy-lessons").prop('disabled', true);
	}

	if(userId === undefined){
		$("#btn-buy-course").prop('disabled', true);
	}else{
		$("#btn-buy-course").prop('disabled', false);
	}

	if(userId === undefined){
		$("#divCheckbox .form-check-input").prop('disabled', true);
	}

	if(userId != undefined){
		$("#formCheckBoxes").on('change', function(){
			var checkCant = document.getElementById('formCheckBoxes');
			var inputsCant = checkCant.getElementsByTagName('input').length;

			for (var i = 1; i <= inputsCant; i++) {
				if($('#flexCheckDefault' + i).attr('checked') && $('#flexCheckDefault' + i).attr('disabled')){
					console.log($('#flexCheckDefault' + i).val() + ' disabled');
					$('#flexCheckDefault' + i).removeAttr('disabled');
					$('#flexCheckDefault' + i).attr('disabled', true);
				}
			}

			if($(":checkbox:checked").length == 0){
				$("#btn-buy-lessons").prop('disabled', true);
			}else if ($(":checkbox:checked").length > 0){
				$("#btn-buy-lessons").removeAttr('disabled');
			}

			total = 0;
			var lmao = 1;
			for (var i = 1; i <= inputsCant; i++) {
				price = $('#flexCheckDefault' + i).val();
				
				if($('#flexCheckDefault' + i).is(":checked")){
					total += parseInt($('#lessonIndividualPrice' + i).attr('value'), 10);
				}
			}
			$("#SubtotalPrice").text(total);
		});
	}

	$("#btn-buy-course").on('click', (event) => {
		cant = $(":checkbox:checked").length;
		if(!(cant > 0)){
			price = $("#CoursePrice").val();
			price = parseInt(price, 10);
			$("#SubtotalPrice").text(price);
		}
	});

	$("#btn-check-out").on('click', (event) =>{
		//Primero para la compra de un Curso
		cant = $(":checkbox:checked").length;
		if(!(cant > 0)){
			var costoCurso = $(this).attr('value');
			courseId = $("#InputCourseIdHidden").val();
			userId = $("#InputUserIdHidden").val();

			var courseBought = {
				vAction: 'I',
				userId: userId,
				courseId: courseId
			};

			$.ajax({
				url: '../controllers/purchase.php',
				type: 'POST',
				data: courseBought,
				dataType: 'json',
				success: function(data){
					Swal.fire(
                      'You bought this course.',
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
		}else{
			for(var index = 1; index <= $(":checkbox:checked").length; index++){
					var idLesson = $('#flexCheckDefault' + index).attr('value');
					userId = $("#InputUserIdHidden").val();

					var lessonBought = {
						vAction: 'IL',
						userId: userId,
						lessonId: idLesson
					};

					$.ajax({
					url: '../controllers/purchase.php',
					type: 'POST',
					data: lessonBought,
					dataType: 'json',
					success: function(data){
						Swal.fire(
	                      'You bought this course.',
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
		}

	});
});

