<?php
class Nodo {
    public $data;
    public $siguiente;
    public $anterior;

    public function __construct($data) {
        $this->data = $data;
        $this->siguiente = null;
        $this->anterior = null;
    }
}

class ListaDoble {
    public $cabeza;
    public $cola;

    public function __construct() {
        $this->cabeza = null;
        $this->cola = null;
    }

    public function insertar($data) {
        $nuevoNodo = new Nodo($data);
        if ($this->cabeza === null) {
            $this->cabeza = $nuevoNodo;
            $this->cola = $nuevoNodo;
        } else {
            $this->cola->siguiente = $nuevoNodo;
            $nuevoNodo->anterior = $this->cola;
            $this->cola = $nuevoNodo;
        }
    }

    public function cargarDesdeMySQL($resultado) {
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $this->insertar($fila);
            }
        }
    }

    public function ordenarPor($campo) {
        if ($this->cabeza === null) return;

        $cambiado = true;
        while ($cambiado) {
            $cambiado = false;
            $actual = $this->cabeza;

            while ($actual->siguiente !== null) {
                if ($actual->data[$campo] > $actual->siguiente->data[$campo]) {
                    $temp = $actual->data;
                    $actual->data = $actual->siguiente->data;
                    $actual->siguiente->data = $temp;
                    $cambiado = true;
                }
                $actual = $actual->siguiente;
            }
        }
    }
}
?>