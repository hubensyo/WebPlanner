<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <title>
        Web Student Planner
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url("assets/css/nucleo-icons.css"); ?>" rel="stylesheet" />
    <link href="<?= base_url("assets/css/nucleo-svg.css"); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url("assets/css/material-dashboard.css"); ?>" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.css" />

</head>

<style>
    .navbar-vertical .navbar-nav>.nav-item .nav-link.active {
        background-color: #9a1a21 !important;
    }

    .bg-gradient-primary {
        background-color: #9a1a21 !important;
    }

    .bg-gradient-primary {
        background-image: linear-gradient(195deg, #9a1a21 0%, #9a1a21 100%);
    }

    .table> :not(:last-child)> :last-child>* {
        color: #9a1a21 !important;
    }

    .btn-primary {
        background-color: #9a1a21 !important;
    }

    .btn-info,
    .btn.bg-gradient-info {
        color: #f8f9fa;
        background-color: #9a1a21 !important;
    }

    .btn-info {
        --bs-btn-color: #f8f9fa !important;
        --bs-btn-bg: #0dcaf0;
        --bs-btn-border-color: #0dcaf0;
        --bs-btn-hover-color: #000;
        --bs-btn-hover-bg: #31d2f2;
        --bs-btn-hover-border-color: #25cff2;
        --bs-btn-focus-shadow-rgb: 11, 172, 204;
        --bs-btn-active-color: #000;
        --bs-btn-active-bg: #3dd5f3;
        --bs-btn-active-border-color: #25cff2;
        --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #000;
        --bs-btn-disabled-bg: #0dcaf0;
        --bs-btn-disabled-border-color: #0dcaf0;
    }
</style>

<?php
if (!empty($this->session->flashdata('success'))) {
    echo "
    <script>
    alert('" . $this->session->flashdata('success') . "');
    </script>
    ";
}

?>