<!-- REGISTRO FUNCIONAL ORIGINAL-->

<?php
// Verifica si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario POST
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $tipoUsuario = $_POST['tipoUsuario'];

    // Realiza la conexión a tu base de datos (reemplaza estos valores con los tuyos)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion_de_laboratorio";

    // Crea la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verifica si las contraseñas coinciden
    if ($contraseña !== $confirmarContraseña) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
        exit; // Detiene el registro si las contraseñas no coinciden
    }

    // Prepara la consulta SQL para insertar datos en las tablas 'personas' y 'usuarios'
    $sqlPersona = "INSERT INTO personas (nombreCompleto, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    $sqlUsuario = "INSERT INTO usuarios (fk_id_persona, fk_id_tipoUsuarios, contraseña) VALUES ((SELECT id_persona FROM personas WHERE correo = '$correo' LIMIT 1), '$tipoUsuario', '$contraseña')";

    // Ejecuta las consultas y verifica si se realizaron con éxito
    if ($conn->query($sqlPersona) === TRUE && $conn->query($sqlUsuario) === TRUE) {
        echo "¡Usuario registrado exitosamente!";
        // Redirecciona al panel_admin.php después de 2 segundos
        header("refresh:2;url=panel_admin.php");
    } else {
        echo "Error: " . $sqlPersona . "<br>" . $conn->error;
        // Redirecciona al panel_admin.php después de 2 segundos
        header("refresh:2;url=panel_admin.php");
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
