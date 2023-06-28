<?php
require_once('forma.class.php');
require_once ('database.class.php');

class Triangulo extends Forma{
    private $lado2;
    private $lado3;

    public function __construct($id, $lado1, $lado2, $lado3, $cor, $un, $pquadro){
        parent::__construct($id, $lado1, $cor, $un, $pquadro);
        $this->setLado2($lado2);
        $this->setLado3($lado3);
    }

    public function setLado2($lado2){
        if ($lado2 > 0){
            $this->lado2 = $lado2;
        }else
            throw new Exception('Valor para o lado 2 inválido.');
    }

    public function setLado3($lado3){
        if ($lado3 > 0){
            $this->lado3 = $lado3;
        }else
            throw new Exception('Valor para o lado 3 inválido.');
    }

    public function setLado1($lado1){
        if ($lado1 > 0){
            parent::setLado($lado1);
        }else
            throw new Exception('Valor para o lado 1 inválido.');
    }

    public function getLado1(){
        return parent::getLado();
    }

    public function getLado2(){
        return $this->lado2;
    }

    public function getLado3(){
        return $this->lado3;
    }

    public function inserir(){
        $sql = 'INSERT INTO triangulo (lado1, lado2, lado3, cor, un, id_quadro)
                     VALUES (:lado1,:lado2,:lado3, :cor, :un, :id_quadro)';
        $params = array(':lado1'=>$this->getLado1(),
                        ':lado2'=>$this->getLado2(),
                        ':lado3'=>$this->getLado3(),
                        ':cor'=>$this->getCor(),
                        ':un'=>$this->getUn(),
                        ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM triangulo 
                  WHERE id = :id';         
         $params = array(':id'=>$this->getId());         
         return Database::executar($sql, $params);
    }

    public function editar(){
        $sql = 'UPDATE triangulo
                    SET lado1 = :lado1,
                        lado2 = :lado2,
                        lado3 = :lado3,
                        cor  = :cor,
                        un   = :un,
                        id_quadro = :id_quadro
                  WHERE   id = :id';
        $params = array(':id'=>$this->getId(),
                        ':lado1'=> $this->getLado1(),
                        ':lado2'=> $this->getLado2(),
                        ':lado3'=> $this->getLado3(),
                        ':cor'=> $this->getCor(),
                        ':un'=> $this->getUn(),
                        ':id_quadro'=>$this->getQuadro());
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = '') {
        $sql = 'SELECT * FROM triangulo';
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
        $desenho = "<div draggable='true' class='desenho' style='width: 0;
         height: 0; border-left: " . $this->getLado1() . $this->getUn() . "
          solid transparent; border-right: " . $this->getLado2() . $this->getUn() . " solid transparent; border-bottom: "
           . $this->getLado3() . $this->getUn() . " solid " . $this->getCor() . ";'></div>";
        return $desenho;
    }

    public function calcularArea(){
        $semiperimetro = ($this->getLado1() + $this->getLado2() + $this->getLado3()) / 2;
        $area = sqrt($semiperimetro * ($semiperimetro - $this->getLado1()) * ($semiperimetro - $this->getLado2()) * ($semiperimetro - $this->getLado3()));
        return $area;
    }

    public function calcularPerimetro(){
        return $this->getLado1() + $this->getLado2() + $this->getLado3();
    }
}
?>
