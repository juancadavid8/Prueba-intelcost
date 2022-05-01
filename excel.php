<?php
header("Pragma: public");
header("Expires: 0");
$filename = "reporte.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include "conexion.php";
$res = mysqli_query($mysqli, "SELECT * FROM mis_bienes");
mysqli_close($mysqli);
?>
<table>
    <tbody>
        <tr>
            <td>id</td>
            <td>direccion</td>
            <td>ciudad</td>
            <td>telefono</td>
            <td>codigo postal</td>
            <td>tipo</td>
            <td>precio</td>
        </tr>
        <tr>
            <?php
            while ($row = $res->fetch_assoc()) {
            ?>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["direccion"] ?></td>
                <td><?php echo $row["ciudad"] ?></td>
                <td><?php echo $row["telefono"] ?></td>
                <td><?php echo $row["codigo_postal"] ?></td>
                <td><?php echo $row["tipo"] ?></td>
                <td><?php echo $row["precio"] ?></td>
            <?php
            }
            ?>
        </tr>
    </tbody>
</table>