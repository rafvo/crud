<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CRUD</title>

    <link href="assets/external/fontawesome-free-5.12.0-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/external/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="assets/external/datatables/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="assets/external/bootstrap-5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/internal/css/modal.css" rel="stylesheet">
    <link href="assets/internal/css/buttons.css" rel="stylesheet">
    <link href="assets/internal/css/forms.css" rel="stylesheet">
    <link href="assets/internal/css/cards.css" rel="stylesheet">
    <link href="assets/internal/css/tables.css" rel="stylesheet">
    <link href="assets/internal/css/global.css" rel="stylesheet">
    <link href="assets/internal/css/style.css" rel="stylesheet">
</head>
<body id="page-top">

    <script src="assets/external/popper/popper.min.js"></script>
    <script src="assets/external/jquery-3.5.1/jquery-3.5.1.min.js"></script>
    <script src="assets/external/bootstrap-5.0/js/bootstrap.min.js"></script>
    <script src="assets/external/bootstrap-5.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/external/bootstrap-datepicker/js/bootstrap-datepicker.js" crossorigin="anonymous"></script>
    <script src="assets/external/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js" crossorigin="anonymous"></script>
    <script src="assets/external/datatables/datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/external/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
    <script src="assets/external/jquery-validation-1.19.1/dist/additional-methods.min.js"></script>
    <script src="assets/external/jquery-mask/jquery.mask.min.js"></script>
    <script src="assets/external/notify-js/notify.min.js"></script>

    <div id="wrapper">
        <div class="container-fluid">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <div class="load"></div>
    <script src="assets/internal/js/global.js"></script>
</body>
</html>