<body>
<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PPDB SMK 05 PALEMBANG</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php
                $CI = get_instance();
                $username = $CI->session->userdata('username');
                if (isset($username)) {
                    ?>
                    <li>
                        <a href="<?php echo(base_url()) ?>">
                            <i class="material-icons">home</i>Home
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="ganti_pasword()">
                            <i class="material-icons">home</i>Ganti Password
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo(base_url() . "keluar") ?>">
                            <i class="material-icons">home</i>Keluar
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black"
         data-image="<?php echo(base_url()) ?>assets/img/register.jpg">
        <div class="container">
            <div class="container-fluid">