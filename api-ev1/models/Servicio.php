<?php
class Servicio {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerServicios() {
        $query = "SELECT id, nombre, descripcion FROM servicios";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $servicios = [];
        foreach ($result as $servicio) {
            if (empty($servicio['descripcion'])) {
                $servicio['descripcion'] = "Descripción no disponible";
            }
            $servicios[] = $servicio;
        }

        return $servicios;
    }

    public function insertarServicio($nombre, $descripcion) {
        $query = "INSERT INTO servicios (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function actualizarServicio($id, $nombre, $descripcion) {
        $query = "UPDATE servicios SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function eliminarServicio($id) {
        $query = "DELETE FROM servicios WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>