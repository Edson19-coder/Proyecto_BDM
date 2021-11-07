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
    <link rel="stylesheet" href="css/sales.css">
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
    <!-- Content -->

    <div class="container col-12 text-center" style="padding: 30px;">

        <div class="sales-content">

            <div class="report-one">
                <h2>Reporte 1</h2>
                <hr>

                <div class="col-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Course</th>
                                <th scope="col">Students</th>
                                <th scope="col">Lesson most completed</th>
                                <th scope="col">Sales</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyReport1">

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Payment method</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Visa</th>
                                        <td id="visaTotal"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">MasterCard</th>
                                        <td id="masterCardTotal"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total</th>
                                        <td class="totalMoney" id="totalMoney"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <br>

            <div class="report-two">
                <h2>Reporte 2</h2>
                <hr>
                <div class="mb-3">
                    <label for="InputAccountType">Course</label>
                    <select class="form-control" id="InputCourses">

                    </select>
                </div>

                <div class="col-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Student</th>
                                <th scope="col">Enrollment date</th>
                                <th scope="col">Percentage completion</th>
                                <th scope="col">Price paid</th>
                                <th scope="col">Payment method</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyReport2">

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Total:</th>
                                        <td class="totalMoney" id="totalMoneyR2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- /Content -->

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/searchBar.js"></script>
    <script src="js/sales.js"></script>
    <script src="models/reports.js"></script>
    <!--<script src="js/validation-settings.js"></script>-->
    <!-- /JS -->
</body>

</html>
