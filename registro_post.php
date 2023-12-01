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

    // Realizar la lógica de validación y verificación de contraseñas (como ya lo estás haciendo)

    // Conexión a la base de datos

    // Consulta SQL para insertar un nuevo usuario
    $sqlPersona = "INSERT INTO personas (nombreCompleto, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    $sqlUsuario = "INSERT INTO usuarios (fk_id_persona, fk_id_tipoUsuarios, contraseña) VALUES ((SELECT id_persona FROM personas WHERE correo = '$correo' LIMIT 1), '$tipoUsuario', '$contraseña')";

    // Ejecutar las consultas SQL
    if ($conn->query($sqlPersona) === TRUE && $conn->query($sqlUsuario) === TRUE) {
        // Retornar una respuesta JSON en lugar de un mensaje directo al navegador
        $response = array(
            "success" => true,
            "message" => "¡Usuario registrado exitosamente!"
        );
        http_response_code(201); // Código 201 para indicar creación exitosa
        echo json_encode($response);
    } else {
        // Retornar un mensaje de error en formato JSON
        $response = array(
            "success" => false,
            "message" => "Error al registrar usuario: " . $conn->error
        );
        http_response_code(500); // Código 500 para indicar error interno del servidor
        echo json_encode($response);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
