<?php
require_once './models/Nosotros.php';

class NosotrosController {
    private $nosotros;

    public function __construct($db)
    {
        $this->nosotros = new Nosotros($db);
    }

    public function obtenerNosotros() {
        $secciones = $this->nosotros->obtenerNosotros();
        echo json_encode(["data" => $secciones]);
    }

    public function insertarSeccion($titulo, $descripcion) {
        if ($this->nosotros->insertarSeccion($titulo, $descripcion)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Sección creada con éxito"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear la sección"]);
        }
    }

    public function actualizarSeccion($id, $titulo, $descripcion) {
        if ($this->nosotros->actualizarSeccion($id, $titulo, $descripcion)) {
            echo json_encode(["mensaje" => "Sección actualizada con éxito"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar la sección"]);
        }
    }

    public function eliminarSeccion($id) {
        if ($this->nosotros->eliminarSeccion($id)) {
            echo json_encode(["mensaje" => "Sección eliminada con éxito"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo eliminar la sección"]);
        }
    }
}
?>