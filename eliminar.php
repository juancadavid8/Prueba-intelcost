<?php 

include "conexion.php";

$id = $_POST['id'];

mysqli_query($mysqli,"DELETE FROM mis_bienes WHERE id = $id");

header("Location: index.php");

?>