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
    <link rel="stylesheet" href="css/messages.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>

<body>
    <!-- NAVBAR -->
    <?php
        require_once('../models/messages.php');
        include 'navbar.php';
    ?>

    <!-- /NAVBAR -->
    <input type="hidden" class="sesion" id="sesion" value="<?php echo $_SESSION['id'] ?>"></input>
    <!-- CONTENT -->
    <div class="message-body container col-12">
        <div class="row">
            <div class="col-4" style="padding: 10px; background-color: white; border: 1px solid black;">
                <h2>Chats</h2>
                <input type="text" name="" id="InputSearchUser" class="form-control" style="margin-bottom: 10px;" placeholder="Search Chats">
                <!-- PREVIEW MESSAGE -->
                <div class="previewMessages">

                </div>
            </div>
            <div class="col-8" style="padding: 10px; background-color: white; border: 1px solid black;">

        <!-- Body of messages -->
				<div class="container global" style="padding: 20px 50px 50px 50px;">

          <div style="text-align: center; padding: 100px">
            <h1>Bienvenido al chat de</h1>
            <h2 class="fw-bold d-none-d-sm-block flex-shrink-0">Crealink Digital<span
                    class="text-primary">.</span></h2>
            <p>Selecciona o busca a una persona para comunicarte.</p>
          </div>

				</div>
				<!-- /Body of messages -->

        <!-- Create message -->
				<form action="" id="formMessageInput">
					<div class="container">
						<div class="col-12" style="padding-top: 20px;">
							<div class="col-12" style="padding: 10px; border-radius: 10px;">
								<div class="row">
									<div class="col-10">
										<textarea class="form-control" id="contentMessage" placeholder=""></textarea>
									</div>
									<div class="col-2" style="text-align: center;">
										<input type="button" value="Enviar"
													class="btn btn-primary publicar-btn" style="line-height: 35px;">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- /Create message -->
            </div>
        </div>
    </div>
    <!-- CONTENT -->
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validation/messages.js"></script>
    <script src="models/message.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/searchBar.js"></script>
    <!-- /JS -->
</body>

</html>
