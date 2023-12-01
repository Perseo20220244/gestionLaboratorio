<?php
// Verifica si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario POST
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

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

    // Consulta SQL para buscar al usuario por correo y contraseña
    $sql = "SELECT * FROM vwLogin WHERE correo = '$correo' AND contraseña = '$contraseña'";

    // Ejecuta la consulta y obtiene el resultado
    $result = $conn->query($sql);

    // Verifica si se encontró algún usuario con ese correo y contraseña
    if ($result->num_rows > 0) {
        // Autenticación exitosa
        // Obtén la información del usuario
        $usuario = $result->fetch_assoc();
        
        // Verifica el tipo de usuario
        $tipoUsuario = $usuario['id_tipoUsuarios'];
        
        // Dependiendo del tipo de usuario, redirige a la página correspondiente
        if ($tipoUsuario == 1 or $tipoUsuario == 2) { // Supongamos que 'administrador' tiene el id 1
            header("Location: panel_admin.php");
            exit(); // Asegura la terminación del script después de redirigir
        } //else {
            // Otros roles, redireccionar a sus respectivas páginas
            // Ejemplo: header("Location: panel_otro_rol.php");
        //}
        //echo "¡Inicio de sesión exitoso!";
        // Aquí puedes redirigir al usuario a su página correspondiente
        // header("Location: usuario.php");
    } else {
        // Usuario o contraseña incorrectos
        echo "Correo electrónico o contraseña incorrectos.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
