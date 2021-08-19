<div>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top container-fluid" style="position: fixed;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xs-6">
          <a href="#" class="logo">
            <img class="imagen" src="<?= $url ?>img/2.jpeg"/>
          </a>
        </div>

        <!--<div class="desplegable">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>-->

        <!--<div class="collapse navbar-collapse" id="navbarResponsive">-->
        <ul class="navbar-nav ml-auto col-md-6 col-xs-6 botonEscritorio" >
          <li class="nav-item">
            <!--<a class="nav-link show-modal" data-toggle="modal" href="#modal1"  onclick="vaciado_login()">Entrar</a>-->
            <a href="#modal1" class="btn fourth" data-toggle="modal" onclick="vaciado_login()" alt="Ingresar">Ingresar</a>
          </li>
        </ul>
        <!--</div>-->


      </div>




    </div>
  </nav>

  <section id="seccion1" style="background-color:black;">
      <div class="container1">

      <div class ="botonResponsive col-12">
        <div></br></br></br></div>
        <div>
          <ul class="navbar-nav nav-responsive">
            <li class="nav-item item-responsive">
              <!--<a class="nav-link show-modal" data-toggle="modal" href="#modal1"  onclick="vaciado_login()">Entrar</a>-->
              <a href="#modal1" class="btn fourth" data-toggle="modal" onclick="vaciado_login()" alt="Ingresar">Ingresar</a>
            </li>
          </ul>
        </div>

      </div>
        <!--
        <video class="video" muted autoplay loop> <source src="<?= $url?>img/TransporteVision.mp4" type="video/mp4"></video>
        <video class="videoResponsive" muted autoplay playsinline loop> <source src="<?= $url?>img/videoResponsiveT.mp4" type="video/mp4"></video>
        -->
        <video class="video" muted autoplay loop> <source src="<?= $url?>img/1.mp4" type="video/mp4"></video>
        <video class="videoResponsive" muted autoplay playsinline loop> <source src="<?= $url?>img/videoResponsive.mp4" type="video/mp4"></video>


      </div>


  </section>
<!--
  <section id="seccion3">
    <div class="container3">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2 col-sm-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="<?= $url?>img/3.jpeg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-2 col-sm-6">
          <div class="p-5">
            <h2 class="display-4">Misi&oacuten</h2>
            <p>Como empresa nuestra principal misi&oacuten es ser tu partner log&iacutestico, actuando r&aacutepido y eficiente a la hora de entregar tus pedidos, siendo su real y principal objetivo, incrementar tus ventas con la ayuda de un servicio de entregas de excelencia.</p>
            <p>Despreocúpate de tus envíos, somos tu aliado para poder hacer crecer tu negocio y llegar a mas clientes!</p>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="seccion4">
    <div class="container4">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2 col-sm-6">
          <div class="p-5">
            <img class="imagenSeccion4 img-fluid rounded-circle" src="<?= $url?>img/8.jpeg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1 col-sm-6">
          <div class="p-5">
            <h2 class="display-4">Visi&oacuten</h2>
            <p>Llegar a ser tu primera opci&oacuten a la hora de elegir tu despacho. Ser referentes en el corto plazo otorgando un valor agregado en cada servicio de nuestros clientes.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="seccion2">
    <div class="container2">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2 col-sm-6">
            <img class="imagenCotizador img-fluid rounded-square" src="<?= $url?>img/23.jpeg" alt="">
        </div>
        <form class="col-lg-6 order-lg-1 col-sm-6" id="cotizador" method="POST" enctype="multipart/form-data">
          <div class="p-5 align-items-center">
            <h2 class="display-4">¡Cotiz&aacute Tu Env&iacuteo!</h2>
            <p>Nos preocupamos de entregar tu pedido en menos de <b>24 horas</b>. Despreoc&uacutepate, retiramos en tu hogar, bodega o donde lo necesites y entregamos tu producto.<hr color="#ED05BF"/></p>

            <div class="cotizador">
              <div class="cantidadCaja align-items-center text-center">
                <b class="textoCantidad">Cantidad De Cajas:</b>
                <input type="number" name="cantidadCajas" id="cantidadCajas" class="inputCantidadCajas" placeholder="Cantidad">
              </div>

              <div class="tamañoCaja align-items-center text-center">
                <b class="textoTipoCaja">Tipo De Caja:</b>
                <select name="tamañoCaja" id="comboTamañoCaja" class="comboTamañoCaja">
                  <option hidden selected>Tamaño</option>
                  <option value="Chica">Chica: (35cm X 35cm) </option>
                  <option value="Mediana">Mediana: (25cm X 25cm) </option>
                  <option value="Grande">Grande: (15cm X 15cm) </option>
                </select>
              </div>

              <div class="zonaOrigen align-items-center text-center">
                <b class="textoZonaO">Zona Origen:</b>
                <select name="desde" id="comboDesde" class="comboDesde">
                  <option hidden selected>Origen</option>
                  <?php
                    if (isset($comunas)) :
                      for ($i = 0; $i < count($comunas); $i++) :
                        echo '<option value="' . $comunas[$i]['idComuna'] . '">' . $comunas[$i]['nombre'] . '</option>';
                      endfor;
                    endif;
                  ?>
                </select>
              </div>

              <div class="zonaDestino align-items-center text-center">
                <b class="textoZonaD">Zona Destino:</b>
                <select name="hasta" id="comboHasta" class="comboHasta">
                  <option hidden selected>Destino</option>

                  <?php
                    if (isset($comunas)) :
                      for ($i = 0; $i < count($comunas); $i++) :
                        echo '<option value="' . $comunas[$i]['idComuna'] . '">' . $comunas[$i]['nombre'] . '</option>';
                      endfor;
                    endif;
                  ?>
                </select>
              </div>
</form>
              <input type="button" name="calcular" class="btnCalcularCotizacion" value="Calcular Cotizaci&oacute;n" id="cotizar" data-toggle="modal">
            </div>

          </div>

      </div>
    </div>
  </section>

  <section id="seccion5">
    <div class="container5">
      <div class="row">
        <div class="contactos col-lg-6 order-lg-1">
          <a class="textoFormulario1">Cont&aacutectanos</a>

          <div class="direccion">
            <img class="iconDireccion" src="<?= $url?>img/icon/direccion.png">
            <a class="textoDireccion">Pedro De Valdivia 3601, Santiago, Chile<hr color="#ED05BF"/></a>
          </div>

          <div class="whatsapp">
            <img class="iconWhatsapp" src="<?= $url?>img/icon/whatsapp.png">
            <a class="textoWhatsapp">+56994896233 / +56962462080<hr color="#ED05BF"/></a>
          </div>

          <div class="instagram">
            <img class="iconInstagram" src="<?= $url?>img/icon/instagram.png">
            <a class="textoInstagram" href="https://www.instagram.com/saki_service/" target="_blank">@saki_service<hr color="#ED05BF"/></a>
          </div>
        </div>

        <div class="col-lg-6 order-lg-2">
            <form class="formulario" action="<?= $url ?>contactenos/contact_form" id="contact" role="form" method="POST">
              <a class="textoFormulario2">D&eacutejanos tu mensaje</a>
              <input type="text" id="nombre" placeholder="Escribe Tu Nombre" required name="nombre">

              <input type="email" id="email" placeholder="Escribe Tu Email" required name="email">

              <textarea id="mensaje" placeholder="Escribe Un Mensaje" required name="mensaje"></textarea>

              <input type="button" id="enviar" value="Enviar">
            </form>
        </div>
      </div>
    </div>
  </section>
-->
