<?php
require_once('forma.class.php');
require_once('database.class.php');

class Circulo extends Forma {
    public function __construct($id, $raio, $cor, $un, $pquadro) {
        parent::__construct($id, $raio, $cor, $un, $pquadro);
    }

    public function inserir() {
        $sql = 'INSERT INTO circulo (raio, cor, un, id_quadro)
                VALUES (:raio, :cor, :un, :id_quadro)';
        $params = array(
            ':raio' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM circulo';
        switch($tipo){
            case 1: $sql .= ' WHERE id = :info'; break;
            case 2: $sql .= ' WHERE cor LIKE :info'; break;
            case 3: $sql .= ' WHERE id_quadro = :info'; break;
        }
    
        $params = array();
        if ($tipo > 0) {
            $params = array(':info' => $info);
        }
    
        return Database::listar($sql, $params);
    }
    

    public function excluir() {
        $sql = 'DELETE FROM circulo
                WHERE id = :id';
        $params = array(':id' => $this->getId());
        return Database::executar($sql, $params);
    }

    public function editar() {
        $sql = 'UPDATE circulo
                SET raio = :raio,
                    cor = :cor,
                    un = :un,
                    id_quadro = :id_quadro
                WHERE id = :id';
        $params = array(
            ':id' => $this->getId(),
            ':raio' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

        public function desenhar() {
            $desenho = "<div draggable='true' class='desenho'
                         style='width:{$this->getLado()}{$this->getUn()};
                         height:{$this->getLado()}{$this->getUn()};
                         border-radius:50%;
                         background-color:{$this->getCor()}'></div>";
            return $desenho;
        }
        
        public function calcularArea() {
            $area = 3.14 * pow($this->getLado(), 2);
            return $area;
        }
        
        public function calcularPerimetro() {
            $perimetro = 2 * 3.14 * $this->getLado();
            return $perimetro;
        }
    }