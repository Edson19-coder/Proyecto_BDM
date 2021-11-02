<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/payment-method.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>

<body>
    <!-- NAVBAR -->
    <?php
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->
    <input type="hidden" class="sesion" id="sesion" value="<?php echo $_SESSION['id'] ?>"></input>
    <!-- CONTENT -->
    <div class="container col-12 my-learning" style="padding: 20px;">
        <div class="col-12" style="background-color: white; padding: 20px;">

            <div class="row">

              <div class="col-12 title text-center">
                  <h3>Paymeny method</h3>
                  <hr>
              </div>

                <div class="col-8 card" style="overflow-y: scroll; height: 440px;">
                    <div class="px-4" id="payment-method-cards">

                    </div>
                </div>

                <div class="col-4" id="payment-method-orgin">

                  <form class="credit-card-div" id="paymentForm">
                      <div class="col-12 mb-3">
                          <span class="help-block text-muted small-font">Enter Card Number</span>
                          <input type="text" class="form-control" name="" id="card_number" maxlength="16" placeholder="1234 5678 9012 3456">
                      </div>
                      <div class="row">
                          <div class="col-4 mb-3">
                              <span class="help-block text-muted small-font">Expiration Month</span>
                              <input type="text" minlength="0" max="2" name="" id="expiry_month" class="form-control" maxlength="2" placeholder="MM">
                          </div>
                          <div class="col-4 mb-3">
                              <span class="help-block text-muted small-font">Expiration Year</span>
                              <input type="text" name="" id="expiry_year" class="form-control" maxlength="4" placeholder="YYYY">
                          </div>
                          <div class="col-4 mb-3">
                              <span class="help-block text-muted small-font">CCV</span>
                              <input type="text" name="" id="cvv" class="form-control" maxlength="3" placeholder="123">
                          </div>
                      </div>
                      <div class="col-12">
                          <span class="help-block text-muted small-font">Name On The Card</span>
                          <input type="text" class="form-control" name="" id="name_on_card" placeholder="Name On The Card">
                      </div>
                      <div class="col-12" style="padding-top:10px;">
                        <div class="row">
                            <div class="col-4">
                                <input type="button" class="form-control btn btn-primary" value="Edit" id="btnEditPaymentMethod" disabled>
                            </div>
                            <div class="col-4">
                                <input type="button" class="form-control btn btn-danger" value="Remove" id="btnRemovePaymentMethod" disabled>
                            </div>
                            <div class="col-4">
                                <input type="button" class="form-control btn btn-success" value="Add" id="btnAddPaymentMethod" disabled>
                            </div>
                        </div>
                      </div>
                      <div class="col-12" style="padding-top:10px;">
                        <input type="button" class="form-control btn btn-secondary" value="Clear" id="btnClear">
                      </div>
                  </form>

                </div>

            </div>

        </div>
    </div>

    <!-- /CONTENT -->
    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/validation/jquery.creditCardValidator.js"></script>
    <script src="js/payment-method.js"></script>
    <script src="models/paymentCard.js"></script>
    <!-- /JS -->

</body>

</html>
