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
        include 'navbar.php';
    ?>
    <!-- /NAVBAR -->

    <!-- CONTENT -->
    <div class="message-body container col-12">
        <div class="row">
            <div class="col-4" style="padding: 10px; background-color: white; border: 1px solid black;">
                <h2>Chats</h2>
                <input type="text" name="" id="" class="form-control" style="margin-bottom: 10px;" placeholder="Search Chats">
                <!-- PREVIEW MESSAGE -->
                <div class="card col-12 preview" style="padding: 8px;">
                    <div class="row">
                        <div class="col-2">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="50" alt="" loading="lazy" />
                        </div>
                        <div class="col-10">
                            <div class="col-12 user_name">
                                <h5>Nombre de Usurio</h5>
                            </div>
                            <div class="col-12 text-muted">
                                <!-- MAX 34 CHARACTERS -->
                                Hola bienvenido al curso de html..
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12 preview" style="padding: 8px;">
                    <div class="row">
                        <div class="col-2">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="50" alt="" loading="lazy" />
                        </div>
                        <div class="col-10">
                            <div class="col-12 user_name">
                                <h5>Nombre de Usurio</h5>
                            </div>
                            <div class="col-12 text-muted">
                                <!-- MAX 34 CHARACTERS -->
                                Hola bienvenido al curso de html..
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /PREVIEW MESSAGE -->
            </div>
            <div class="col-8" style="padding: 10px; background-color: white; border: 1px solid black;">

                <!-- Body of messages -->
				<div class="container global" style="padding: 20px 50px 50px 50px;">

					<!-- friend -->
					<div class="card">
						<div class="card-header message-f">
							<div class="col-12">
                                <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="50" alt="" loading="lazy" /> Osmar Lugo
							</div>
						</div>
						<div class="card-body">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Non tempore temporibus sunt modi praesentium, laborum porro cumque quaerat, minima culpa corporis quibusdam libero, esse voluptas quae? Porro repudiandae odit modi?
						</div>
            <div class="card-footer" style="text-align: right;">
                <p class="card-text"><small class="text-muted">Recivido: 2021-10-13 23:38:35</small></p>
            </div>
					</div>
					<!-- /friend -->

					<!-- Me -->
					<div class="card">
						<div class="card-header message-m">
							<div class="col-12" style="text-align: right;">
								Edson Lugo   <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="50" alt="" loading="lazy" />
							</div>
						</div>
						<div class="card-body">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt nihil unde excepturi reprehenderit vitae quibusdam accusamus suscipit, a ut iusto voluptatum sequi cumque at corporis quam quos exercitationem autem nobis?
						</div>
            <div class="card-footer" style="text-align: right;">
                <p class="card-text"><small class="text-muted">Enviado: 2021-10-13 23:38:35</small></p>
            </div>
					</div>
					<!-- /Me -->

				</div>
				<!-- /Body of messages -->

                <!-- Create message -->
				<form action="">
					<div class="container">
						<div class="col-12" style="padding-top: 20px;">
							<div class="col-12" style="padding: 10px; border-radius: 10px;">
								<div class="row">
									<div class="col-10">
										<textarea class="form-control" placeholder="What's in your mind?"></textarea>
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
    <script src="js/messages.js"></script>
    <!-- /JS -->
</body>

</html>
