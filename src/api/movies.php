<?php

header("Content-Type: application/json");

include_once "../classes/class-movies.php";

switch ($_SERVER['REQUEST_METHOD']) {
case 'POST':
    $_POST = json_decode(file_get_contents('php://input'), true);
    $movie = new Movie($_POST["name"], $_POST["genre"], $_POST["director"], $_POST["year"]);
    $insert = $movie->saveMovie();
    echo "Pelicula Guardada con ID=" . $insert;
    break;
case 'GET':
    if (isset($_GET['id'])) {
        $movie = Movie::obtainMovie($_GET['id']);
        echo ($movie);
    } else {
        $movies = Movie::obtainMovies();
        echo ($movies);
    }
    break;
case 'PUT':
    $_PUT = json_decode(file_get_contents('php://input'), true);
    $user = new User($_PUT['nombre'], $_PUT['apellido'], $_PUT['fechaNacimiento'], $_PUT['pais']);
    $user->actualizarUsuario($_GET['id']);
    $resultado["mensaje"] = "Actualizar pelicula con el id: " . $_GET['id'] . ", Informacion a actualizar: " . json_encode($_PUT);
    echo json_encode($resultado);
    break;
case 'DELETE':
    Movie::deleteMovie($_GET["id"]);
    $resultado["mensaje"] = "Eliminada pelicula con el id: " . $_GET['id'];
    echo json_encode($resultado);
    break;
}

?>