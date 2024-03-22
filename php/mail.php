<?php
ini_set('display_errors', 1); // Muestra errores para propósitos de desarrollo (remover en producción)
error_reporting(E_ALL); // Reporta todos los errores de PHP (remover en producción)

// Verificar la dirección de correo electrónico del destinatario y otros datos necesarios de la compra
if (isset($_POST['c_email_address']) && !empty($_POST['c_email_address'])) {
    $to = $_POST['c_email_address'];
    $subject = 'Gracias por tu compra';
    $from = 'eduarnossa3156@gmail.com';

    // Construcción de los encabezados del correo
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/".phpversion()."\r\n";

    // Asegúrate de que recibes todos los datos necesarios para el cuerpo del correo
    if (isset($_POST['carrito']) && count($_POST['carrito']) > 0) {
        $carrito = $_POST['carrito']; // Suponemos que el carrito se envía como un array en POST

        $message = '<html><body>';
        $message .= '<h1>Gracias por tu compra!</h1>';
        $message .= '<table style="width: 100%;">';
        $message .= '<tr><th>Nombre del producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>';

        $total = 0;
        foreach ($carrito as $producto) {
            $subtotal = $producto['Precio'] * $producto['Cantidad'];
            $total += $subtotal;

            $message .= "<tr>";
            $message .= "<td>" . htmlspecialchars($producto['Nombre']) . "</td>";
            $message .= "<td>" . htmlspecialchars($producto['Precio']) . "</td>";
            $message .= "<td>" . htmlspecialchars($producto['Cantidad']) . "</td>";
            $message .= "<td>" . htmlspecialchars($subtotal) . "</td>";
            $message .= "</tr>";
        }
        
        $message .= "</table>";
        $message .= "<h3>Total de la compra: $total</h3>";
        $message .= '</body></html>';

        if (mail($to, $subject, $message, $headers)) {
            echo 'El mensaje se envió correctamente.';
        } else {
            echo 'El mensaje no se pudo enviar.';
        }
    } else {
        echo 'El carrito está vacío o los datos de la compra no se han enviado correctamente.';
    }
} else {
    echo 'La dirección de correo electrónico es requerida.';
}
?>