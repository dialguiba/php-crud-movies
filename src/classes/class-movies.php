<?php

require_once 'class-connection.php';

class Movie {
    private $name;
    private $genre;
    private $director;
    private $year;

    public function __construct($name, $genre, $director, $year) {
        $this->name = $name;
        $this->genre = $genre;
        $this->director = $director;
        $this->year = $year;
        $this->connection = new Connection();
        $this->connection = $this->connection->connect();
    }

    public function saveMovie() {
        $sql = "INSERT INTO movies (name,genre,director,year) VALUES (?,?,?,?)";
        $insert = $this->connection->prepare($sql);
        $arrData = array(
            $this->name, $this->genre, $this->director, $this->year,
        );
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->connection->lastInsertId();
        return $idInsert;
    }

    public static function obtainMovies() {
        $conexion = new Connection();
        $conexion = $conexion->connect();
        $sql = "SELECT * FROM movies";
        $execute = $conexion->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        $request = json_encode($request);
        return $request;
    }

    public static function obtainMovie($indice) {
        $conexion = new Connection();
        $conexion = $conexion->connect();
        $sql = "SELECT * FROM movies WHERE id=$indice";
        $execute = $conexion->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        $request = json_encode($request);
        return $request;
    }

    public function updateMovie($indice) {
        $sql = "INSERT INTO movies (name,genre,director,year) VALUES (?,?,?,?) WHERE id=$indice";
        $insert = $this->connection->prepare($sql);
        $arrData = array(
            $this->name, $this->genre, $this->director, $this->year,
        );
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->connection->lastInsertId();
        return $idInsert;
    }

    public static function deleteMovie($indice) {
        $conexion = new Connection();
        $conexion = $conexion->connect();
        $sql = "DELETE FROM movies WHERE id=$indice";
        $delete = $conexion->prepare($sql);
        $resDelete = $delete->execute($arrData);
        /* $idDelete = $conexion->lastDeleteId(); */
        return "deleted";
    }

    /**
     * Get the value of name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of genre
     */
    public function getGenre() {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */
    public function setGenre($genre) {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of director
     */
    public function getDirector() {
        return $this->director;
    }

    /**
     * Set the value of director
     *
     * @return  self
     */
    public function setDirector($director) {
        $this->director = $director;

        return $this;
    }

    /**
     * Get the value of year
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * Set the value of year
     *
     * @return  self
     */
    public function setYear($year) {
        $this->year = $year;

        return $this;
    }

    public function __toString() {
        return $this->name . " " . $this->genre . " (" . $this->director . "," . $this->year . ")";
    }
}

?>