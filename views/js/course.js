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
			if($(":checkbox:checked").length == 0){
				$("#btn-buy-lessons").prop('disabled', true);
			}else{
				$("#btn-buy-lessons").removeAttr('disabled');
			}
			var checkCant = document.getElementById('formCheckBoxes');
			var inputsCant = checkCant.getElementsByTagName('input').length;
			total = 0;
			for (var i = 1; i <= inputsCant; i++) {
				price = $('#flexCheckDefault' + i).val();
				if($('#flexCheckDefault' + i).prop('checked') && $('#flexCheckDefault' + i).prop('disabled', false)){
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

	$("#btn-buy-lessons").on('click', (event) => {
		cant = $(":checkbox:checked").length;
		if(cant > 0){
			var lessons = new Array();
			$(":checkbox:checked").each(function(){
				lessons.push($(this).attr('value'));
				//alert("Id: " + $(this).attr('value'));
			});
			//console.log(lessons);
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

			console.log(courseBought);
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

		}

	});
});

