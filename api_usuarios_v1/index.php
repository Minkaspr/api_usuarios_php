<?php
// Configuracion para la conexion con la base de datos
const DRIVER = 'mysql';
const HOST = 'localhost';
const PORT = 3306;
const DATABASE = 'api_usuarios';
const USER = 'root';
const PASS = '';
const URL = DRIVER . ':host=' . HOST . ';port=' . PORT . ';dbname=' . DATABASE;

try {
    // Establecer la conexión con la base de datos
    $conexion = new PDO(URL, USER, PASS);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establecer el tipo de contenido a JSON
    header("Content-Type: application/json");
    // Obtener el método HTTP de la solicitud
    $metodo = $_SERVER['REQUEST_METHOD'];

    // Recuperamos la URL <> EndPoint y buscamos el id
    $path = isset($_SERVER['PATH_INFO'])? $_SERVER['PATH_INFO'] : '/';
    $buscarId = explode('/', $path);
    // Recuperamos el id 
    $id = ($path !== '/') ? end($buscarId) : null;

    // Dependiendo del método HTTP, ejecutar la función correspondiente
    switch($metodo){
        // SELECT
        case 'GET':
            // a http://localhost/api_usuarios/index.php/ ||  http://localhost/api_usuarios/index.php/1
            consultar($conexion, $id);
            break;
        // INSERT
        case 'POST':
            // http://localhost/api_usuarios/
            insertar($conexion);
            break;
        // UPDATE
        case 'PUT':
            // http://localhost/api_usuarios/index.php/10
            actualizar($conexion, $id);
            break;
        // DELETE
        case 'DELETE':
            // http://localhost/api_usuarios/index.php/11
            borrar($conexion, $id);
            break;
        default:
            echo "Metodo no permitido";
            break;
    }
} catch(PDOException $e) {
    echo "Conexión no establecida: " . $e->getMessage();
}

// Función para consultar datos de la base de datos
function consultar($conexion, $id){
    // Si no se proporciona un id, seleccionar todos los usuarios. 
    // De lo contrario, seleccionar el usuario con el id proporcionado.
    $sql = ($id === null) ? "SELECT * FROM usuarios" : "SELECT * FROM usuarios WHERE id = $id";
    $resultado = $conexion->query($sql);

    if($resultado){
        $datos = array();
        while($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
            $datos[] = $fila;
        }
        echo json_encode($datos);
    }
}

// Función para insertar un nuevo usuario en la base de datos
function insertar($conexion){
    // Obtener los datos del cuerpo de la solicitud y decodificar el JSON a un array asociativo
    $dato = json_decode(file_get_contents('php://input'),true);
    // Extraer los valores del array asociativo
    $nombre = $dato['nombre'];
    $apellido = $dato['apellido'];
    $direccion = $dato['direccion'];
    $correo_electronico = $dato['correo_electronico'];
    $genero = $dato['genero'];
    $estado = $dato['estado'];
    $fecha_nacimiento = $dato['fecha_nacimiento'];
    $hora_registro = $dato['hora_registro'];

    // Preparar la consulta SQL para insertar un nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, direccion, correo_electronico, genero, estado, fecha_nacimiento, hora_registro) 
            VALUES (:nombre, :apellido, :direccion, :correo_electronico, :genero, :estado, :fecha_nacimiento, :hora_registro)";
    $statement = $conexion->prepare($sql);

    // Vincular los valores a los parámetros de la consulta SQL e intentar ejecutarla
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apellido', $apellido);
    $statement->bindParam(':direccion', $direccion);
    $statement->bindParam(':correo_electronico', $correo_electronico);
    $statement->bindParam(':genero', $genero);
    $statement->bindParam(':estado', $estado);
    $statement->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $statement->bindParam(':hora_registro', $hora_registro);

    if ($statement->execute()){
        $dato['id'] = $conexion->lastInsertId();
        echo json_encode($dato);
    } else {
        echo json_encode(array('error'=>'Error al crear usuario'));
    }
}

// Función para actualizar un usuario existente en la base de datos
function actualizar($conexion, $id) {
    // Obtener los datos del cuerpo de la solicitud y decodificar el JSON a un array asociativo
    $dato = json_decode(file_get_contents('php://input'),true);
    $nombre = $dato['nombre'];
    $apellido = $dato['apellido'];
    $direccion = $dato['direccion'];
    $correo_electronico = $dato['correo_electronico'];
    $genero = $dato['genero'];
    $estado = $dato['estado'];
    $fecha_nacimiento = $dato['fecha_nacimiento'];
    $hora_registro = $dato['hora_registro'];
    
    // Preparar la consulta SQL para actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, direccion = :direccion, correo_electronico = :correo_electronico, genero = :genero, estado = :estado, fecha_nacimiento = :fecha_nacimiento, hora_registro = :hora_registro WHERE id = :id";
    $sentencia = $conexion->prepare($sql);

    // Vincular los valores a los parámetros de la consulta SQL e intentar ejecutarla
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':apellido', $apellido);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':correo_electronico', $correo_electronico);
    $sentencia->bindParam(':genero', $genero);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':hora_registro', $hora_registro);
    $sentencia->bindParam(':id', $id);

    if ($sentencia->execute()){
        echo json_encode(array('mensaje'=>'Usuario actualizado correctamente'));
    } else {
        echo json_encode(array('error'=>'Error al actualizar usuario'));
    }

}

// Función para borrar un usuario existente en la base de datos
function borrar($conexion, $id){
    // Preparar la consulta SQL para borrar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $resultado = $conexion -> query($sql);

    if($resultado){
        echo json_encode(array('mensaje' => 'Usuario borrado'));
    } else {
        echo json_encode(array('error' => 'Error al borrar usuario'));
    }
}

?>