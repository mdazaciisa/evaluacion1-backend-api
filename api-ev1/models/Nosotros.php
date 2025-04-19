<?php
class Nosotros {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerNosotros() {
        $query = "SELECT id, titulo, descripcion FROM nosotros";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $nosotros = [];
        foreach ($result as $seccion) {
            $seccion_formateada = [
                'titulo' => [
                    'esp' => $seccion['titulo']
                ],
                'descripcion' => [
                    'esp' => $seccion['descripcion']
                ]
            ];
            $nosotros[] = $seccion_formateada;
        }

        return $nosotros;
    }

    public function insertarSeccion($titulo, $descripcion) {
        $query = "INSERT INTO nosotros (titulo, descripcion) VALUES (:titulo, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function actualizarSeccion($id, $titulo, $descripcion) {
        $query = "UPDATE nosotros SET titulo = :titulo, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function eliminarSeccion($id) {
        $query = "DELETE FROM nosotros WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
