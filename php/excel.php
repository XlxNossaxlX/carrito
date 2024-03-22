<?php
session_start();
include "../php/conexion.php";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=productos.xls");

// Aquí realizas la consulta a la base de datos con el JOIN a categorias
$resultado = $conexion->query("
    SELECT productos.*, categorias.nombre AS catego FROM productos 
    INNER JOIN categorias ON productos.id_categoria = categorias.id
    ORDER BY productos.id DESC") or die($conexion->error);
?>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Inventario</th>
            <th>Categoria</th>
            <th>Talla</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($f = mysqli_fetch_array($resultado)){
        ?>
            <tr>
                <td><?php echo $f['id']; ?></td>
                <td><?php echo $f['nombre']; ?></td>
                <td><?php echo $f['descripcion']; ?></td>
                <td>$<?php echo number_format($f['precio'], 2, '.', ''); ?></td>
                <td><?php echo $f['inventario']; ?></td>
                <td><?php echo $f['catego']; ?></td>
                <td><?php echo $f['talla']; ?></td>
                <td><?php echo $f['color']; ?></td>
            </tr>
        <?php 
        }
        ?>
    </tbody>
</table>
