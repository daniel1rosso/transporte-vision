<section>
  <!--MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo" style="background:
        radial-gradient(black 15%, transparent 16%) 0 0,
        radial-gradient(black 15%, transparent 16%) 8px 8px,
        radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
        radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
        background-color:#282828;
        background-size:16px 16px;">
                <a href="#" style="width: 30%; margin: auto;">
                    <img style="border-radius:50%;" src="<?= $url ?>img/2.jpeg"/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <img alt="" src="<?= $url . 'img/main-team-member-img-3-100x100.jpg' ?>" style="border-radius: 100%; width: 50%; display: block; margin: auto;border-bottom-style: groove;">
                            <span class="" style="text-transform:uppercase; margin: 4% 0%; text-align: center; display: block; padding-top: 5%;" href="#"><?= $user['apellido'] . ', ' . $user['nombreCompleto'] ?></span>
                            <div style="height: 1px; width: 100%; background-color: rgba(243, 251, 4, 1);"></div>
                        </li>
                        <li>
                            <a href="<?= $url ?>envios/listar_envios"  style="text-decoration-line: none; text-align: left;">
                            <i class="fas fa-shipping-fast"></i>Envios</a>
                        </li>
                        <?php if ($user['idNivel'] == 1){  ?>
                            <li>
                                <a href="<?= $url ?>usuarios/listar_usuarios" style="text-decoration-line: none; text-align: left;">
                                <i class="far fa-user"></i>Usuarios</a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
</section>
