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
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- /CSS -->
</head>

<body>

    <!-- NAVBAR -->
    <?php 

        require_once '../models/user.php';
        include 'navbar.php';    
    ?>
    <!-- /NAVBAR -->
    <input type="hidden" class="sesion" id="sesion" value="<?php echo $_SESSION['id'] ?>"></input>
    <!-- Content -->

    <div class="container col-12 text-center" style="padding: 30px;">

        <div class="settings-content">
            <div class="col-12">
                <?php

                if(isset($_SESSION['profilePicture'])){
                    echo '<img id="user-image-view" src="data:image/jpg;base64,'.base64_encode($_SESSION['profilePicture']).'" class="rounded-circle" height="200" alt="..." loading="lazy" />';
                    }else{
                        echo "PAPUS";
                    }
                ?>
                
            </div>
            <div class="col-12" style="padding: 20px;">
                <div class="mb-3">
                    <label for="InputUserNameSettings" class="form-label">Last update: 7/09/2021</label>
                </div>
            </div>
            <div class="form-content col-6" style="margin-left: auto; margin-right: auto;">
                
                <form class="col-10" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="InputUserNameSettings" class="form-label">User image</label>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" name="foto" onclick="check()" id="InputImageSettings">
                    </div>
                    
                    <button id="btn-update-image" type="submit" class="col-12 btn btn-primary"
                        style="margin-bottom: 20px ;">Update image</button>
                </from>

                    <form class="col-10">
                        <div class="mb-3">
                            <label for="InputUserNameSettings" class="form-label">User name</label>
                            <input type="text" class="form-control" id="InputUserNameSettings">
                            <span class="hide" id="span-user-name" style="color: red">*User name is required</span>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputFirstNameSettings" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="InputFirstNameSettings">
                                        <span class="hide" id="span-name" style="color: red">*Name is required</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputSecondNameSettings" class="form-label">Second name</label>
                                        <input type="text" class="form-control" id="InputSecondNameSettings">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="InputLastNameSettings" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="InputLastNameSettings">
                            <span class="hide" id="span-last-name" style="color: red">*Last name is required</span>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputCountrySettings" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="InputCountrySettings">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputStateSettings" class="form-label">State</label>
                                        <input type="text" class="form-control" id="InputStateSettings">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputCitySettings" class="form-label">City</label>
                                        <input type="text" class="form-control" id="InputCitySettings">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="InputPCSettings" class="form-label">Postal code</label>
                                        <input type="text" class="form-control" id="InputPCSettings">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="InputEmailSettings" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="InputEmailSettings"
                                aria-describedby="emailHelp">
                            <span class="hide" id="span-email" style="color: red">*Email is required</span>
                            <span class="hide" id="span-email-2" style="color: red">*Email invalid</span>
                        </div>
                        <div class="mb-3">
                            <label for="InputPasswordSettings" class="form-label">Password</label>
                            <input type="password" minlength="8" class="form-control" id="InputPasswordSettings">
                            <span class="hide" id="span-password" style="color: red">*Password is required</span>
                            <span class="hide" id="span-password-2" style="color: red">
                                *The password must be at least 8 characters including an uppercase, lowercase, number and space character
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="InputAccountType">Account type</label>
                            <select class="form-control" id="InputAccountType">
                                <option value="0">Student</option>
                                <option value="1">Instructor</option>
                            </select>
                        </div>
                        <button id="btn-update" type="submit" class="col-12 btn btn-primary"
                            style="margin-bottom: 20px ;">Update information</button>
                    </form>
            </div>
        </div>
    </div>

    <!-- /Content -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/settings.js"></script>
    <script src="js/validation/validation-settings.js"></script>
    <!-- /JS -->
</body>

</html>