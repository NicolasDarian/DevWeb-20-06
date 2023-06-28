<?php
abstract class Forma {
    private $id = 0;
    private $lado;
    private $cor;
    private $un;
    private $quadro;

    public function __construct($pid, $plado, $pcor, $pun, $pquadro) {
        $this->setId($pid);
        $this->setLado($plado);
        $this->setCor($pcor);
        $this->setUn($pun);
        $this->setQuadro($pquadro);
    }



    public function setUn($un) {
        if ($un != '') {
            $this->un = $un;
        } else {
            throw new Exception('Unidade de medida inválida. Selecione uma unidade válida.');
        }
    }

    public function getUn() {
        return $this->un;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLado() {
        return $this->lado;
    }

    public function setLado($lado) {
        if ($lado > 0) {
            $this->lado = $lado;
        } else {
            throw new Exception('Lado da forma inválido. Informe um valor maior que 0.');
        }
    }

    public function getCor() {
        return $this->cor;
    }

    public function setCor($cor) {
        if ($cor != '') {
            $this->cor = $cor;
        } else {
            throw new Exception('Cor da forma inválida. Informe uma cor.');
        }
    }

    public function getQuadro(){
        return $this->quadro;
    }
    
    public function setQuadro($quadro){
        $this->quadro = $quadro;
    }

    public abstract function desenhar();
    public abstract function calcularArea();
    public abstract function calcularPerimetro();
    public abstract function inserir();
    public abstract function excluir();
    public abstract function editar();
}

?>
