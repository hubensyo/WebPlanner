<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://stdominiccollege.edu.ph/sdcap/index.php " target="_blank">
            <img src="<?= base_url() ?>assets/img/sdcalogo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">SDCA Students</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white active bg-gradient-primary" href="http://10.0.3.36/tims/index.php/welcome/index" id="studentlist_side" onclick="clicksidenav(this.id)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Student List</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>

            <?php

            if (($this->session->userdata('login')['position']) == "2") {
            ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="http://10.0.3.36/tims/index.php/welcome/admin" id="admin_side" onclick="clicksidenav(this.id)">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="http://10.0.3.36/tims/index.php/welcome/calendar" id="calendar_side" onclick="clicksidenav(this.id)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">calendar_today</i>
                    </div>
                    <span class="nav-link-text ms-1">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="http://10.0.3.36/tims/index.php/login/logout" id="clicklogout" onclick="clicksidenav(this.id)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Log-out</span>
                </a>
            </li>
        </ul>
    </div>

    <script>
        function clicksidenav(id) {
            $('ul.navbar-nav a').removeClass('bg-gradient-primary');
            $('ul.navbar-nav a').removeClass('active');
            $('#' + id).addClass('bg-gradient-primary');
            $('#' + id).addClass('active');
        }

        function clickadmin() {
            clicksidenav("admin_side")
        }

        function clickstudentlist() {
            clicksidenav("studentlist_side")
        }

        function clickcalendar() {
            clicksidenav("calendar_side")
        }

        function clicklogout() {
            clicksidenav("logout")
        }
    </script>

</aside>