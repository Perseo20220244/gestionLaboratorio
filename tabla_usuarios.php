<?php
// Conexión a la base de datos (debes llenar los datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_de_laboratorio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los registros de la tabla 'personas'
$sql = "SELECT id_persona, nombreCompleto, correo, telefono, tipoUsuario FROM vwAdmin";
$result = $conn->query($sql);

// Mostrar los resultados en una tabla HTML
if ($result->num_rows > 0) {

    // Mostrar cada fila de resultados
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id_persona"] . "</td><td>" . $row["nombreCompleto"] . "</td><td>" . $row["correo"] . "</td><td>" . $row["telefono"] . "</td><td>". $row["tipoUsuario"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión
$conn->close();
?>
