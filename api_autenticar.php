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



?>