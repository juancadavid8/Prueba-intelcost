<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario</title>
</head>

<?php

$data = file_get_contents("data-1.json");
$datos_generales = json_decode($data, true);
$datos_generlaes_individuales = json_decode($data);
$ciudades = array();
for ($i = 0; $i < sizeof($datos_generlaes_individuales); $i++) {
  array_push($ciudades, $datos_generlaes_individuales[$i]->Ciudad);
}
$ciudades_sin_duplicados = array_unique($ciudades);

$tipos = array();
for ($i = 0; $i < sizeof($datos_generlaes_individuales); $i++) {
  array_push($tipos, $datos_generlaes_individuales[$i]->Tipo);
}
$tipos_sin_duplicados = array_unique($tipos);

if (isset($_POST["btnGuardar"])) {
}

?>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="#" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="0" selected>Elige una ciudad</option>
              <?php for ($i = 0; $i < 30; $i++) {
                if ($ciudades_sin_duplicados[$i] != NULL) {
              ?>
                  <option value="<?php echo $ciudades_sin_duplicados[$i] ?>"><?php echo $ciudades_sin_duplicados[$i] ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="0">Elige un tipo</option>
              <?php for ($i = 0; $i < 30; $i++) {
                if ($tipos_sin_duplicados[$i] != NULL) {
              ?>
                  <option value="<?php echo $tipos_sin_duplicados[$i] ?>"><?php echo $tipos_sin_duplicados[$i] ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton" name="btnFiltrar">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <ul>
              <!-- Impresión de datos de la busqueda -->
              <?php foreach ($datos_generales as $casa) { ?>
                <!-- Por cada elemento en los datos le asignaremos la variable casa -->
                <!-- dependiendo de lo seleccionado -->

                <?php if (isset($_POST["btnFiltrar"])) {
                  if ($_POST["ciudad"] != 0 || $_POST["tipo"] != 0) {
                    if ($casa["Ciudad"] == $_POST["ciudad"] || $casa["Tipo"] == $_POST["tipo"]) {
                ?>
                      <li>
                        <img src="img/home.jpg" style="float: left;" width="200" height="150" alt="">
                        <ol style="float: left; padding-left: 10px">
                          <form action="guardar.php" method="post">
                            <li><b>Dirección:</b> <?php echo $casa["Direccion"] ?></li>
                            <li><b>Ciudad:</b> <?php echo $casa["Ciudad"] ?></li>
                            <li><b>Telefono:</b> <?php echo $casa["Telefono"] ?></li>
                            <li><b>Código Postal:</b> <?php echo $casa["Codigo_Postal"] ?></li>
                            <li><b>Tipo:</b> <?php echo $casa["Tipo"] ?></li>
                            <li><b>Precio:</b> <?php echo $casa["Precio"] ?></li>
                            <?php $actual = json_encode($casa) ?>
                            <input type="hidden" name="id" value="<?php echo $casa["Id"] ?>">
                            <button type="submit">Guardar</button>
                          </form>
                        </ol>
                      </li>
                    <?php
                    }
                  } else {
                    ?>

                    <li>
                      <img src="img/home.jpg" style="float: left;" width="200" height="150" alt="">
                      <ol style="float: left; padding-left: 10px">
                        <form action="guardar.php" method="post">
                          <li><b>Dirección:</b> <?php echo $casa["Direccion"] ?></li>
                          <li><b>Ciudad:</b> <?php echo $casa["Ciudad"] ?></li>
                          <li><b>Telefono:</b> <?php echo $casa["Telefono"] ?></li>
                          <li><b>Código Postal:</b> <?php echo $casa["Codigo_Postal"] ?></li>
                          <li><b>Tipo:</b> <?php echo $casa["Tipo"] ?></li>
                          <li><b>Precio:</b> <?php echo $casa["Precio"] ?></li>
                          <?php $actual = json_encode($casa); ?>
                          <input type="hidden" name="id" value="<?php echo $casa["Id"] ?>">
                          <button type="submit">Guardar</button>
                        </form>
                      </ol>
                    </li>

                  <?php
                  }
                } else { ?>
                  <li>
                    <img src="img/home.jpg" style="float: left;" width="200" height="150" alt="">
                    <ol style="float: left; padding-left: 10px">
                      <form action="guardar.php" method="post">
                        <li><b>Dirección:</b> <?php echo $casa["Direccion"] ?></li>
                        <li><b>Ciudad:</b> <?php echo $casa["Ciudad"] ?></li>
                        <li><b>Telefono:</b> <?php echo $casa["Telefono"] ?></li>
                        <li><b>Código Postal:</b> <?php echo $casa["Codigo_Postal"] ?></li>
                        <li><b>Tipo:</b> <?php echo $casa["Tipo"] ?></li>
                        <li><b>Precio:</b> <?php echo $casa["Precio"] ?></li>
                        <?php $actual = json_encode($casa) ?>
                        <input type="hidden" name="id" value="<?php echo $casa["Id"] ?>">
                        <button type="submit">Guardar</button>
                      </form>
                    </ol>
                  </li>
                <?php } ?>

                <div class="divider"></div>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>

      <div id="tabs-2">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <?php

            include "conexion.php";
            $res = mysqli_query($mysqli, "SELECT * FROM mis_bienes");

            mysqli_close($mysqli);

            while ($row = $res->fetch_assoc()) {

            ?>
              <li>
                <img src="img/home.jpg" style="float: left;" width="200" height="150" alt="">
                <ul style="float: left; padding-left: 10px">
                  <form action="eliminar.php" method="post">
                    <li><b>Dirección:</b> <?php echo $row["direccion"] ?></li>
                    <li><b>Ciudad:</b> <?php echo $row["ciudad"] ?></li>
                    <li><b>Telefono:</b> <?php echo $row["telefono"] ?></li>
                    <li><b>Código Postal:</b> <?php echo $row["codigo_postal"] ?></li>
                    <li><b>Tipo:</b> <?php echo $row["tipo"] ?></li>
                    <li><b>Precio:</b> <?php echo $row["precio"] ?></li>
                    <?php $actual = json_encode($row) ?>
                    <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                    <button type="submit">Eliminar</button>
                  </form>
                </ul>
              </li>
            <?php
            }
            ?>
            <div class="divider"></div>
          </div>
        </div>
      </div>

      <div id="tabs-3">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Reportes:</h5>
            <a class="btn white" href="excel.php">Generar Reportes</a>
          </div>
        </div>
      </div>

    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#tabs").tabs();
      });
    </script>
</body>

</html>