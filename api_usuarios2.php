<?php 

$host="localhost";
$usuario="root";
$password="";
$basededatos="gestion_de_laboratorio";

    // Prueba de conexion
    // Creacion de objeto $conexion a partir de la clase 'mysqli'
$conexion= new mysqli($host, $usuario, $password, $basededatos);

    // comprobar la conexion, si hay un error entonces:
if ($conexion->connect_error){
    // Mostrar mensaje y concatenar el error
    die ("Conexión no establecida". $conexion->connect_error);
}

    // Recibir informacion atraves de una solicitud
    // Devuelve un archivo JSON para consultar resultados
header("Content-Type: application/json");

    // Forma en que el servidor o API recibe datos
$metodo= $_SERVER['REQUEST_METHOD'];    // REQUEST_METHOD devuelve que metodos se estan usando en el momento



    /* Si hay algo en el PATH_INFO entonces asignalo a la variable $path
        de lo contrario se pone un slash '/' */
$path= isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';  // Retorna el PATH

    // Buscar dentro de la URL 
$buscarId= explode('/', $path); // Busca en el PATH o toda la URL

    // Si hay algo en '/' vamos a obetener toda la informacion relacionada en ese dato $buscarId
    // De lo contrario se pone un 'null'
$id= ($path!=='/') ? end($buscarId):null;  // Se utiliza el id recuperado en las funciones posteriores


    // Validaciones en una serie de casos a $motodo
switch ($metodo){

    // Consulta SELECT
    case 'GET':
        //echo "Consulta de registros - GET";
        consulta($conexion);
        break;
    // INSERT
    case 'POST':
        insertar($conexion);
        //echo "Insertar de registros - POST";
        break;
    // UPDATE
    case 'PUT':
        actualizar($conexion, $id);
        break;
    // DELETE
    case 'DELETE':
        //echo "Borrado de registros - DELETE";
        borrar($conexion, $id);
        break;
    default:
        echo "Método no permitido";    
        break;
}

    // utiliza como dato la recepcion de la conexion
function consulta($conexion){
    // Variable $sql que contendrá la consulta
    $sql= "SELECT * FROM usuarios";
    // Resultado de la consulta se guada en $resultado
    $resultado= $conexion->query($sql);

    // Validacion del resultado
    if($resultado){
        // Almacenar informacion y mostrarla
        $datos= array();
        while($fila= $resultado->fetch_assoc()){
            // La informacion de fetch_assoc la almacenamos en $datos cuando venga de la $fila
            $datos[]=$fila;
        }
        // Transforma los datos recibidos desde la BD en $datos en un formato json
        echo json_encode($datos);
    }
}

function insertar($conexion){

    // EVALUAMOS antes de insertar, garantizamos que esté llegando la informacion
    //$datos= json_decode(file_get_contents('php://input'), true);
    $nombre= $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $tipoUsuario = $_POST['tipoUsuario'];

        // Verifica si las contraseñas coinciden
    if ($contraseña !== $confirmarContraseña) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
        exit; // Detiene el registro si las contraseñas no coinciden
    }

    $sqlPersona = "INSERT INTO personas (nombreCompleto, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    $sqlUsuario = "INSERT INTO usuarios (fk_id_persona, fk_id_tipoUsuarios, contraseña) VALUES ((SELECT id_persona FROM personas WHERE correo = '$correo' LIMIT 1), '$tipoUsuario', '$contraseña')";
    
    if ($conexion->query($sqlPersona) === TRUE && $conexion->query($sqlUsuario) === TRUE) {
        echo "¡Usuario registrado exitosamente!";
        // Redirecciona al panel_admin.php después de 2 segundos
        header("refresh:2;url=panel_admin.php");
    } else {
        echo "Error: " . $sqlPersona . "<br>" . $conexion->error;
        // Redirecciona al panel_admin.php después de 2 segundos
        header("refresh:2;url=panel_admin.php");
    }
    /*$resultado= $conexion->query($sql);

    if ($resultado){
        // Si hay un resultado, entonces mostramos el dato que se insertó
        $dato['id'] = $conexion->insert_id;     // devuelve el ultimo ID insertado
        echo json_encode($dato);
    }else{
        echo json_encode(array('error'=>'Error el crear usuario'));
    }*/
}
function borrar($conexion, $id){

    // echo "El id a borrar es: ". $id;
    $sql= "DELETE FROM usuarios WHERE id = $id";
    $resultado= $conexion->query($sql);

    if ($resultado){
        echo json_encode(array('mensaje'=>'Usuario eliminado'));
    }else{
        echo json_encode(array('error'=>'Error el eliminar usuario'));
    }
}
function actualizar($conexion, $id){

    // Obtencion del dato
    $dato= json_decode(file_get_contents('php://input'), true);
    $nombre= $dato['nombre'];

    // Verificar el dato
    echo "El id a editar es: ". $id. " con el dato ". $nombre;

    // Actualizar en la BD
    $sql= "UPDATE usuarios SET nombre = '$nombre' WHERE id = $id";
    $resultado= $conexion->query($sql);

    // Informe de consulta
    if ($resultado){
        echo json_encode(array('mensaje'=>'Usuario actualizado'));
    }else{
        echo json_encode(array('error'=>'Error el actualizar usuario'));
    }
}
?>