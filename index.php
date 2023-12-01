<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/personal.css">
    <title>Inicio de Sesión</title>
</head>
<body>
      
    <div class="containerOne container p-5 mx-auto my-5 text-white shadow-lg bg-white border border-light rounded">
        <h2 class="text-center primary_color"> Inicia Sesión</h2>
        
        <form action="autenticar.php" method="POST">
            <div class="form-floating mt-3">
                <input type="text" class="form-control mb-3 border border-success" id="correo" placeholder="Correo Electrónico" name="correo">
                <label for="correo">Correo electrónico</label>
              </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control form-control-lg border border-success" id="contraseña" placeholder="Enter password" name="contraseña">
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label primary_color">
                <input class="form-check-input" type="checkbox" name="remember">Recuerdame
                </label>
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
        </form>
    </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>