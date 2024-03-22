<?php
// Importar la conexión y las dependencias necesarias
require '../php/conexion.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$response = [];

try {
    // Comprobar si hay un POST y si se subió un archivo
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileExcel'])) {
        $archivo = $_FILES['fileExcel']['tmp_name'];
        $spreadsheet = IOFactory::load($archivo);
        $worksheet = $spreadsheet->getActiveSheet();
        $filas = $worksheet->toArray();

        // Omitiendo la fila de encabezados
        foreach ($filas as $index => $fila) {
            if ($index === 0) continue;

            // Asumiendo que tus columnas están configuradas de esta manera
            // en el archivo Excel: Nombre | Descripción | Precio | etc.
            $nombre = $conexion->real_escape_string($fila[0]);
            $descripcion = $conexion->real_escape_string($fila[1]);
            $precio = (float)$fila[2];
            $imagen = $conexion->real_escape_string($fila[3]); // Asegúrate de manejar el archivo de imagen correctamente
            $inventario = (int)$fila[4];
            $categoria = $conexion->real_escape_string($fila[5]);
            $talla = $conexion->real_escape_string($fila[6]);
            $color = $conexion->real_escape_string($fila[7]);

            // Aquí añade la lógica para obtener el ID de la categoría, si es necesario
            $stmt = $conexion->prepare("SELECT id FROM categorias WHERE nombre = ?");
            $stmt->bind_param('s', $categoria);
            $stmt->execute();
            $result = $stmt->get_result();
            $categoriaData = $result->fetch_assoc();
            $id_categoria = $categoriaData['id'];
            $stmt->close();

            // Aquí añade la lógica para insertar los datos en la base de datos
            if ($id_categoria) {
                $stmt = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, inventario, id_categoria, talla, color) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssdsiiis', $nombre, $descripcion, $precio, $imagen, $inventario, $id_categoria, $talla, $color);
                $stmt->execute();
                $stmt->close();
            }
        }

        $response['status'] = 'success';
        $response['message'] = 'Los productos se han importado correctamente';
    } else {
        throw new Exception('No se ha enviado ninguna solicitud POST válida con un archivo.');
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

// Devolviendo la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>