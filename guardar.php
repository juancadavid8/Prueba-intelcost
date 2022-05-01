<?php

include "conexion.php";

$id = $_POST["id"];
$data = file_get_contents("data-1.json");
$datos_generales = json_decode($data, true);

$idTabla = 0;
$direccionTabla = "";
$ciudadTabla = "";
$telefonoTabla = "";
$codigoPostalTabla = "";
$tipoTabla = "";
$precioTabla = "";

foreach ($datos_generales as $datos) {
    if ($datos["Id"] == $id) {
        $idTabla = $datos["Id"];
        $direccionTabla = $datos["Direccion"];
        $ciudadTabla = $datos["Ciudad"];
        $telefonoTabla = $datos["Telefono"];
        $codigoPostalTabla = $datos["Codigo_Postal"];
        $tipoTabla = $datos["Tipo"];
        $precioTabla = $datos["Precio"];
    }
}

$sql = "INSERT INTO `mis_bienes` (`id`, `direccion`, `ciudad`, `telefono`, `codigo_postal`, `tipo`, `precio`) 
VALUES ($idTabla, '$direccionTabla', '$ciudadTabla', '$telefonoTabla', '$codigoPostalTabla', '$tipoTabla', '$precioTabla');";

mysqli_query($mysqli,$sql);

header("Location: index.php");

?>