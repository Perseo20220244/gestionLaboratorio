<?php
// Inicia la sesión si no se ha iniciado aún
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige al usuario a index.php después de cerrar la sesión
header("Location: index.php");
exit;
?>
