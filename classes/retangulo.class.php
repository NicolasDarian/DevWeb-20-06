<?php
require_once('forma.class.php');
require_once ('database.class.php');

class Retangulo extends Forma
{
    private $altura;

    public function __construct($id, $base, $altura, $cor, $un , $pquadro)
    {
        parent::__construct($id, $base, $cor, $un, $pquadro);
        $this->setAltura($altura);
    }

    public function setAltura($altura)
    {
        if ($altura > 0) {
            $this->altura = $altura;
        } else {
            throw new Exception('Valor para a altura inválido.');
        }
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function inserir()
    {
        $sql = 'INSERT INTO retangulo (base, altura, cor, un , id_quadro) 
        VALUES (:base, :altura, :cor, :un, :id_quadro)';
        $params = array(
            ':base' => $this->getLado(),
            ':altura' => $this->getAltura(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

    public function excluir()
    {
        $sql = 'DELETE FROM retangulo WHERE id = :id';
        $params = array(':id' => $this->getId());
        return Database::executar($sql, $params);
    }

    public function editar()
    {
        $sql = 'UPDATE retangulo
         SET base = :base,
            altura = :altura,
            cor = :cor,
            un = :un,
            id_quadro = :id_quadro
          WHERE id = :id';
        $params = array(
            ':id' => $this->getId(),
            ':base' => $this->getLado(),
            ':altura' => $this->getAltura(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = '')
    {
        $sql = 'SELECT * FROM retangulo';
        switch ($tipo) {
            case 1:
                $sql .= ' WHERE id = :info';
                break;
            case 2:
                $sql .= ' WHERE cor LIKE :info';
                break;
            case 3:
                $sql .= ' WHERE id_quadro = :info';
                break;

        }
        $params = array();
        if ($tipo > 0) {
            $params = array(':info' => $info);
        }
        return Database::listar($sql, $params);
    }

    public function desenhar()
{
    $desenho = "<div draggable='true' class='desenho' style='width: " . $this->getAltura() . $this->getUn() . "; height: " . $this->getLado() . $this->getUn() . "; background-color: " . $this->getCor() . ";'></div>";
    return $desenho;
}

    public function calcularArea()
    {
        return $this->getLado() * $this->getAltura();
    }

    public function calcularPerimetro()
    {
        return 2 * ($this->getLado() + $this->getAltura());
    }
}
?>