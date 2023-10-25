<?php

require 'flight/Flight.php';

// Configuración para la conexión con la base de datos
const DRIVER = 'mysql';
const HOST = 'localhost';
const PORT = 3306;
const DATABASE = 'api_usuarios';
const USER = 'root';
const PASS = '';
const URL = DRIVER . ':host=' . HOST . ';port=' . PORT . ';dbname=' . DATABASE;

Flight::register('db', 'PDO', array(URL, USER, PASS));

Flight::route('/', function() {
    Flight::jsonp(["Api de usuarios"]);
});

Flight::route('GET /usuarios', function () {
    $sentencia = Flight::db()->prepare("SELECT * FROM usuarios");
    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();
    Flight::json($datos);
});

Flight::route('POST /usuarios', function () {
    $request = Flight::request();

    // Validar los datos del usuario
    $nombre = $request->data->nombre;
    $apellido = $request->data->apellido;
    $direccion = $request->data->direccion;
    $correo_electronico = $request->data->correo_electronico;
    $genero = $request->data->genero;
    $estado = $request->data->estado;
    $fecha_nacimiento = $request->data->fecha_nacimiento;
    $hora_registro = $request->data->hora_registro;
    
    // Preparar la sentencia SQL
    $sql = "INSERT INTO usuarios (nombre, apellido, direccion, correo_electronico, genero, estado, fecha_nacimiento, hora_registro) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Ejecutar la sentencia SQL
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$nombre);
    $sentencia->bindParam(2,$apellido);
    $sentencia->bindParam(3,$direccion);
    $sentencia->bindParam(4,$correo_electronico);
    $sentencia->bindParam(5,$genero);
    $sentencia->bindParam(6,$estado);
    $sentencia->bindParam(7,$fecha_nacimiento);
    $sentencia->bindParam(8,$hora_registro);
    $sentencia->execute();

    Flight::jsonp(["Usuario agregado"]);
    //$sentencia->execute([$nombre, $apellido, $direccion, $correo_electronico, $genero, $estado, $fecha_nacimiento, $hora_registro]);
});

Flight::route('DELETE /usuarios', function () {
    $id=(Flight::request()->data->id);

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$id);
    $sentencia->execute();
    
    Flight::jsonp(["Usuario borrado"]);
});

Flight::route('PUT /usuarios', function () {
    // Recoger los datos del usuario
    $id = (Flight::request()->data->id);
    $nombre = (Flight::request()->data->nombre);
    $apellido = (Flight::request()->data->apellido);
    $direccion = (Flight::request()->data->direccion);
    $correo_electronico = (Flight::request()->data->correo_electronico);
    $genero = (Flight::request()->data->genero);
    $estado = (Flight::request()->data->estado);
    $fecha_nacimiento = (Flight::request()->data->fecha_nacimiento);
    $hora_registro = (Flight::request()->data->hora_registro);

    // Preparar la sentencia SQL
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, direccion = ?, correo_electronico = ?, 
    genero = ?, estado = ?, fecha_nacimiento = ?, hora_registro = ? WHERE id = ?";

    // Ejecutar la sentencia SQL
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->execute([$nombre, $apellido, $direccion, $correo_electronico, $genero, $estado, $fecha_nacimiento, $hora_registro, $id]);

    Flight::jsonp(["Usuario modificado"]);
});

Flight::route('GET /usuarios/@id', function ($id) {
    $sentencia = Flight::db()->prepare("SELECT * FROM usuarios WHERE id = ?");
    $sentencia->bindParam(1,$id);
    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();
    Flight::json($datos);
});

Flight::start();
