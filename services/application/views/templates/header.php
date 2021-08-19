    <div class="page-wrapper">
    <!-- HEADER MOVILE -->
        <header class="header-mobile d-block d-lg-none" style="background:
radial-gradient(black 15%, transparent 16%) 0 0,
radial-gradient(black 15%, transparent 16%) 8px 8px,
radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
background-color:#282828;
background-size:16px 16px;">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo">
                            <img class="imagen" src="<?= $url ?>img/2.jpeg" alt="CoolAdmin"/>
                        </a>
                        <button class="hamburger hamburger--slider" id="hamburger" name="hamburger" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled listaDespegable">
                        <li class="has-sub">
                            <a href="<?= $url ?>envios/listar_envios" style="text-decoration-line: none;">
                            <i class="fas fa-shipping-fast"></i>Envios</a>
                        </li>

                        <?php if ($user['idNivel'] == 1){  ?>
                            <li class="has-sub">
                                <a href="<?= $url ?>usuarios/listar_usuarios" style="text-decoration-line: none;">
                                <i class="far fa-user"></i>Usuarios</a>
                            </li>
                        <?php } ?>

                        <li class="has-sub">
                            <a class="botonSalir" href="<?= $url ?>admin/logout" style="padding-top:1%; text-decoration-line: none;" >
                            <i class="fas fa-sign-out-alt" style="color:gray;"></i>Salir</a>

                        </li>

                    </ul>
                </div>
            </nav>

        </header>
        <!-- END HEADER MOBILE-->

        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="background:
radial-gradient(black 15%, transparent 16%) 0 0,
radial-gradient(black 15%, transparent 16%) 8px 8px,
radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
background-color:#282828;
background-size:16px 16px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <!-- NOTIFICACION DE LA DERECHA
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                    ACA TERMINA LA NOTIFICACION DE LA DERECHA-->
                                    <a class="navbar-brand botonSalir"  href="<?= $url ?>admin/logout">Salir</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </header>
        </div>
