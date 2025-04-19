<?php
require_once './models/Servicio.php';

class ServicioController {
    private $servicio;

    public function __construct($db)
    {
        $this->servicio = new Servicio($db);
    }

    public function obtenerServicios() {
        $servicios = $this->servicio->obtenerServicios();
        echo json_encode(["data" => $servicios]);
    }

    public function insertarServicio($nombre, $descripcion) {
        if ($this->servicio->insertarServicio($nombre, $descripcion)) {
            http_response_code(201); 
            echo json_encode(["mensaje" => "Servicio creado con éxito"]);
        } else {
            http_response_code(500); 
            echo json_encode(["mensaje" => "No se pudo crear el servicio"]);
        }
    }

    public function actualizarServicio($id, $nombre, $descripcion) {
        if ($this->servicio->actualizarServicio($id, $nombre, $descripcion)) {
            echo json_encode(["mensaje" => "Servicio actualizado con éxito"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar el servicio"]);
        }
    }

    public function eliminarServicio($id) {
        if ($this->servicio->eliminarServicio($id)) {
            echo json_encode(["mensaje" => "Servicio eliminado con éxito"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo eliminar el servicio"]);
        }
    }
}
?>