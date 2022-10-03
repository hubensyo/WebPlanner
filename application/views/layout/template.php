<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('layout/header');
?>

<body class="g-sidenav-show  bg-gray-200">

<?php
$this->load->view('layout/side');
?>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
$this->load->view('layout/nav');
?> 

<?php
$this->load->view($body);
?> 

</main>

<?php
$this->load->view('layout/footer');
?> 

</body>

</html>