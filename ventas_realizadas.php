<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas Realizadas</title>
  <link rel="icon" type="image/icon" href="images/favicon.ico">

  <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <h2 style="text-align: center; color: #0056b3;">Ventas Realizadas</h2>
<?php
// Aquí se realizaría la conexión a tu base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectox";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las ventas realizadas
$sql = "SELECT c.id AS compra_id, c.usuario_id, c.fecha, c.total, d.producto_id, d.cantidad, d.precio
        FROM compras c
        INNER JOIN detalles_compras d ON c.id = d.compra_id
        ORDER BY c.fecha DESC";

// Ejecutar la consulta
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla
    echo "<table style='margin: auto;text-align: center; border: 1px solid #0056b3; border-right: 1px solid #0056b3'>
            <tr>
                <th>ID de Compra</th>
                <th>ID de Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='border: 1px solid #0056b3;'>" . $row["compra_id"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>" . $row["usuario_id"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>" . $row["fecha"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>$" . $row["total"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>" . $row["producto_id"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>" . $row["cantidad"] . "</td>";
        echo "<td style='border: 1px solid #0056b3;'>$" . $row["precio"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    echo "No se encontraron ventas realizadas.";
}

// Cerrar la conexión
$conn->close();
?>
<br><br><br>
<center><a href="admin.php" style="margin-top: 120px; text-align: center; background-color: #0056b3; color:#fff; padding: 10px 7px; text-decoration: none; border-radius: 7px;">Regresar</a></center>
</body>
</html>
