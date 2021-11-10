$(document).ready(() => {

  var userId = String($(".sesion").val());
  var card_type_name;
  var validateCardB = null;
  var cardSelected = null;

  getCardsByUserId();

  $('#btnAddPaymentMethod').on('click', (event) => {
        event.preventDefault();

        if(validateCardB && cardSelected == null) {
          createCard($('#name_on_card').val(), $('#card_number').val(), $('#expiry_month').val(), $('#expiry_year').val(), $('#cvv').val());
        }
  });

  $('#btnEditPaymentMethod').on('click', (event) => {
        event.preventDefault();

        if(cardSelected != null) {
          updateCard($('#name_on_card').val(), $('#card_number').val(), $('#expiry_month').val(), $('#expiry_year').val(), $('#cvv').val());
        }
  });

  $('#btnRemovePaymentMethod').on('click', (event) => {
        event.preventDefault();

        if(cardSelected != null) {
          deleteCardById();
        }
  });

  $('#btnClear').on('click', (event) => {
        event.preventDefault();

        cardSelected = null;
        clearFormData();

        $('.cardSelectedPM').prop('checked', false);
        $( "#btnEditPaymentMethod" ).prop( "disabled", true );
        $( "#btnRemovePaymentMethod" ).prop( "disabled", true );
  });

  $(document).on('click','.cardSelectedPM', function(){
     cardSelected = $(this).data("cardid");

     if(cardSelected != null) {
       getCardById();
     }
   })

  /* VALIDACIÓN DE TARJETA */

  //card validation on input fields
  $('#paymentForm input[type=text]').on('keyup',function(){
      validateCardB = cardFormValidate();

      if(validateCardB && cardSelected == null) {
        $( "#btnAddPaymentMethod" ).prop( "disabled", false );
      } else {
        $( "#btnAddPaymentMethod" ).prop( "disabled", true );
      }
  });

  function cardFormValidate(){
      var cardValid = 0;

      //card number validation
      $('#card_number').validateCreditCard(function(result){
          if(result.valid){
              $("#card_number").removeClass('required');
              cardValid = 1;
          }else{
              $("#card_number").addClass('required');
              cardValid = 0;
          }
          card_type_name = result.card_type == null ? '-' : result.card_type.name;

      });

      //card details validation
      var cardName = $("#name_on_card").val();
      var expMonth = $("#expiry_month").val();
      var expYear = $("#expiry_year").val();
      var cvv = $("#cvv").val();
      var regName = /^[a-z ,.'-]+$/i;
      var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
      var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
      var regCVV = /^[0-9]{3,3}$/;
      if (cardValid == 0) {
          $("#card_number").addClass('required');
          $("#card_number").focus();
          return false;
      }else if (!regMonth.test(expMonth)) {
          $("#card_number").removeClass('required');
          $("#expiry_month").addClass('required');
          $("#expiry_month").focus();
          return false;
      }else if (!regYear.test(expYear)) {
          $("#card_number").removeClass('required');
          $("#expiry_month").removeClass('required');
          $("#expiry_year").addClass('required');
          $("#expiry_year").focus();
          return false;
      }else if (!regCVV.test(cvv)) {
          $("#card_number").removeClass('required');
          $("#expiry_month").removeClass('required');
          $("#expiry_year").removeClass('required');
          $("#cvv").addClass('required');
          $("#cvv").focus();
          return false;
      }else if (!regName.test(cardName)) {
          $("#card_number").removeClass('required');
          $("#expiry_month").removeClass('required');
          $("#expiry_year").removeClass('required');
          $("#cvv").removeClass('required');
          $("#name_on_card").addClass('required');
          $("#name_on_card").focus();
          return false;
      }else{
          $("#card_number").removeClass('required');
          $("#expiry_month").removeClass('required');
          $("#expiry_year").removeClass('required');
          $("#cvv").removeClass('required');
          $("#name_on_card").removeClass('required');
          return true;
      }
  }

  /* FUNCIONES */

  function createCard(cardHolder, cardNumber, expMonth, expYear, ccv) {

    var cardData = {
       vAction: 'I',
       user_id: userId,
       method: card_type_name,
       cardHolder: cardHolder,
       cardNumber: cardNumber,
       expMonth: expMonth,
       expYear: expYear,
       ccv: ccv
   };

   $.ajax({
      url: "../controllers/payment-method.php",
      type: "POST",
      data: cardData,
      dataType: 'json',
       success: function(data) {
           if(data) {
             getCardsByUserId();
             clearFormData();
           }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
           alert("Status: " + textStatus);
           alert("Error: " + errorThrown);
       }
   });

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

  function getCardById() {
    var cardData = {
       vAction: 'S',
       paymentMethodId: cardSelected
   };

   $.ajax({
      url: "../controllers/payment-method.php",
      type: "POST",
      data: cardData,
      dataType: 'json',
       success: function(data) {
         if(data) {
           $('#name_on_card').val(data.CARD_HOLDER);
           $('#card_number').val(data.CARD_NUMBER);
           $('#expiry_month').val(data.EXPIRATION_MONTH);
           $('#expiry_year').val(data.EXPIRATION_YEAR);
           $('#cvv').val(data.SECURITY_NUMBER);

           $( "#btnAddPaymentMethod" ).prop( "disabled", true );
           $( "#btnEditPaymentMethod" ).prop( "disabled", false );
           $( "#btnRemovePaymentMethod" ).prop( "disabled", false );
         }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
           alert("Status: " + textStatus);
           alert("Error: " + errorThrown);
       }
   });
  }

  function deleteCardById() {
    var cardData = {
       vAction: 'D',
       paymentMethodId: cardSelected
   };

   $.ajax({
      url: "../controllers/payment-method.php",
      type: "POST",
      data: cardData,
      dataType: 'json',
       success: function(data) {
         if(data) {
           getCardsByUserId();

           cardSelected = null;
           clearFormData();
         }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
           alert("Status: " + textStatus);
           alert("Error: " + errorThrown);
       }
   });
  }

  function updateCard(cardHolder, cardNumber, expMonth, expYear, ccv) {

    var cardData = {
       vAction: 'U',
       paymentMethodId: cardSelected,
       method: card_type_name,
       cardHolder: cardHolder,
       cardNumber: cardNumber,
       expMonth: expMonth,
       expYear: expYear,
       ccv: ccv
   };

   $.ajax({
      url: "../controllers/payment-method.php",
      type: "POST",
      data: cardData,
      dataType: 'json',
       success: function(data) {
           if(data) {
             getCardsByUserId();
             clearFormData();
           }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
           alert("Status: " + textStatus);
           alert("Error: " + errorThrown);
       }
   });

  }

  function clearFormData() {
    $('#name_on_card').val('');
    $('#card_number').val('');
    $('#expiry_month').val('');
    $('#expiry_year').val('');
    $('#cvv').val('');

    $( "#btnAddPaymentMethod" ).prop( "disabled", true );
    $( "#btnEditPaymentMethod" ).prop( "disabled", true );
    $( "#btnRemovePaymentMethod" ).prop( "disabled", true );
  }

});
