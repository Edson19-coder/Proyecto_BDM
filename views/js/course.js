$(document).ready(() => {
	var userId = $("#InputUserIdHidden").val();
	var courseId = $("#InputCourseIdHidden").val();
	var price = 0;

	var cant = 0;
	var total = 0;

	var cardSelected = null;
	var cardSelectedNumber = null;
	var cardTypeSelect = null;
	var cardCvvNumber = null;

	getCardsByUserId();

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

		if(confirmCards()) {
			//Primero para la compra de un Curso
			cant = $(":checkbox:checked").length;
			if(!(cant > 0)){
				var costoCurso = $(this).attr('value');
				courseId = $("#InputCourseIdHidden").val();
				userId = $("#InputUserIdHidden").val();

				var courseBought = {
					vAction: 'I',
					userId: userId,
					courseId: courseId,
					cardType: cardTypeSelect
				};

				$.ajax({
					url: '../controllers/purchase.php',
					type: 'POST',
					data: courseBought,
					dataType: 'json',
					success: function(data){
						if(data) {
							Swal.fire(
	              'You bought this course.',
	              '',
	              'success'
	            ).then(function (result) {
	                if (result.value) {
	                    window.location.reload();
	                }
	            })
						}
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
							lessonId: idLesson,
							cardType: cardTypeSelect
						};

						$.ajax({
						url: '../controllers/purchase.php',
						type: 'POST',
						data: lessonBought,
						dataType: 'json',
						success: function(data){
							if(data) {
								Swal.fire(
	                'You bought this course.',
	                '',
	                'success'
	              ).then(function (result) {
	                  if (result.value) {
	                      window.location.reload();
	                  }
	              })
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
						console.warn(XMLHttpRequest.responseText);
		                alert("Status de papu: " + textStatus);
		                alert("Error papu: " + errorThrown);
		            	}
					});
				}
			}
		} else {
			Swal.fire(
				'The payment method cannot be processed.',
				'',
				'error'
			);

			$('#cvv').val('');
			$( "#btn-check-out" ).prop( "disabled", true );
		}

	});

	$(document).on('click','.cardSelectedPM', function(){
     cardSelected = $(this).data("cardid");
		 cardSelectedNumber = $(this).data("cardnumber");
		 cardTypeSelect = $(this).data("cardtype");

		 checkValCardSelect();
   });

	 $('#cvv').on('keyup',function() {
		 cardCvvNumber = $('#cvv').val();
		 checkValCardSelect();
	 })

	 function checkValCardSelect() {
		 if($('#cvv').val().length >= 3 && cardSelected != null && cardSelectedNumber != null) {
			 $( "#btn-check-out" ).prop( "disabled", false );
		 } else {
			 $( "#btn-check-out" ).prop( "disabled", true );
		 }
	 }

	function getCardsByUserId() {

		var cardData = {
			 vAction: 'SAU',
			 user_id: userId
	 };

	 $.ajax({
			url: "../controllers/payment-method.php",
			type: "POST",
			data: cardData,
			dataType: 'json',
			 success: function(data) {
				 if(data)
					 $('#payment-method-cards').empty();

					 data.forEach(card => {
							 var newCard = new Card(card.PAYMENT_METHOD_ID, card.METHOD, card.CARD_HOLDER, card.CARD_NUMBER, card.EXPIRATION_MONTH, card.EXPIRATION_YEAR);

							 $('#payment-method-cards').append(newCard.getHtml());
					 });
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
					 alert("Status: " + textStatus);
					 alert("Error: " + errorThrown);
			 }
	 });

	}

	function confirmCards() {

		var valConfirmCard = null;

		var cardData = {
			 vAction: 'VPM',
			 paymentMethodId: cardSelected,
			 cardNumber: cardSelectedNumber,
			 ccv: cardCvvNumber
	 };

	 $.ajax({
			url: "../controllers/payment-method.php",
			type: "POST",
			data: cardData,
			dataType: 'json',
			async: false,
			 success: function(data) {
				 valConfirmCard = data ? true : false;
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
					 alert("Status: " + textStatus);
					 alert("Error: " + errorThrown);
			 }
	 });

	 return valConfirmCard;

	}

});
