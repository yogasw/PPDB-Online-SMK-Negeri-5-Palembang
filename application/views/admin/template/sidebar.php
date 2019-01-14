<body>
<div class="wrapper">
    <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?php echo(base_url())?>assets/img/sidebar-1.jpg">
        <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
        <?php $pg = substr ($_SERVER['PHP_SELF'], 17); ?>


        <div class="logo">
            <a href="#" class="simple-text">
                Arioki Dev
            </a>
        </div>
        <div class="logo logo-mini">
            <a href="#" class="simple-text">
                AD
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="<?php echo(base_url())?>assets/img/faces/avatar.jpg"/>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        Yoga Setiawan
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li <?php if($pg=="home") echo('class="active"'); ?>>
                    <a href="<?php echo(base_url())?>admin/home">
                        <i class="material-icons">home</i>
                        <p>Home</p>
                    </a>
                </li>
                <li <?php if($pg=="datasiswa") echo('class="active"'); ?>>
                    <a href="<?php echo(base_url())?>admin/datasiswa">
                        <i class="material-icons">assignment_ind</i>
                        <p>Data Siswa</p>
                    </a>
                </li>
                <li <?php if($pg=="jurusan") echo('class="active"'); ?>>
                    <a href="<?php echo(base_url())?>admin/jurusan">
                        <i class="material-icons">folder</i>
                        <p>Jurusan</p>
                    </a>
                </li>
                <li <?php if($pg=="kriteria") echo('class="active"'); ?>>
                <a href="<?php echo(base_url())?>admin/kriteria">
                        <i class="material-icons">folder_special</i>
                        <p>Kriteria</p>
                    </a>
                </li>
                <li <?php if($pg=="akun") echo('class="active"'); ?>>
                    <a href="<?php echo(base_url())?>admin/akun">
                        <i class="material-icons">account_circle</i>
                        <p>Akun</p>
                    </a>
                </li>
                <li <?php if($pg=="logout") echo('class="active"'); ?>>
                    <a href="<?php echo(base_url())?>admin/logout">
                        <i class="material-icons">directions_walk</i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> Widgets </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">notifications</i>
                                <span class="notification">0</span>
                                <p class="hidden-lg hidden-md">
                                    Notifications
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Test Uji Coba</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group form-search is-empty">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <!-- AWAL ISI WEB DI SINI -->