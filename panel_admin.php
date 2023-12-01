<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/personal.css">

    <title>Panel Administrador</title>
</head>
<body>
    <?php include 'barra_navegacion.php'?>

    <div class="my-3 text-center"> 
      <h2 class="my-3">Registro de Usuarios</h2>
                    <!--Contenedor de registro Admin-->
                    <!-- Formulario de registro de usuarios -->
      <form action="api_usuarios2.php" method="post">
        <div class="my-2">
          <label for="nombre">Nombre Completo:</label>
          <input type="text" id="nombre" name="nombre" required><br>
        </div>

        <div>
          <label for="correo">Correo Electrónico:</label>
          <input type="email" id="correo" name="correo" required><br>
        </div>

        <div class="my-2">
          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" required><br>
        </div>

        <div class="my-2">
          <label for="contraseña">Contraseña:</label>
          <input type="password" id="contraseña" name="contraseña" required><br>
        </div>

        <div class="my-2">
          <label for="confirmarContraseña">Confirmar Contraseña:</label>
          <input type="password" id="confirmarContraseña" name="confirmarContraseña" required><br>
        </div>

        <div class="my-2">
          <label for="tipoUsuario">Tipo de Usuario:</label>
          <select id="tipoUsuario" name="tipoUsuario" required><br>
            <option value="1">Administrador</option>
            <option value="2">Personal de Laboratorio</option>
            <option value="3">Docente</option>
            <option value="4">Alumno</option>
          </select><br>
        </div>

        <input type="submit" value="Registrar">
      </form>
    </div>
    <hr size="8px" color="black" />
  
                    <!--Listado de usuarios-->

    <div class="container mt-3">
      <h2>Listado de Usuarios</h2>
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Teléfono Móvil</th>
            <th>Tipo de Usuario</th>
          </tr>
        </thead>
        <tbody>
          <?php include 'tabla_usuarios.php' ?>
          <!--
          <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
          </tr> -->
        </tbody>
      </table>
    </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>