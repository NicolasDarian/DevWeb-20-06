<?php
require_once('../classes/retangulo.class.php');
require_once('../classes/quadro.class.php');
$retangulo = new Retangulo('', 1, 1, 'x', 'x', 1);

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$reditando = null;

if ($id > 0) {
    $dados = $retangulo->listar(1, $id);
    $reditando = new Retangulo($dados[0]['id'], $dados[0]['base'], $dados[0]['altura'], $dados[0]['cor'], $dados[0]['un'],$dados[0]['id_quadro']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Retângulos</title>
    <style>
        .desenho{
            border:1px solid black;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Cadastro de retângulos</h1>
    <b><a href="../index.php">Quadro</a><b>  |  <b><a href="../triangulo/index.php">Triângulo</a><b>  |  </b><a href="../quadrado/index.php">Quadrado</a><b>  |  </b><a href="../circulo/index.php">Círculo</a>
    <section>
        <form action="acaoretangulo.php" method='post'>
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value="<?php echo isset($reditando)?$reditando->getId():0 ?>">
            <label for="base">Base:</label>
            <input type="text" name='base' id='base' value="<?php echo isset($reditando)?$reditando->getLado() : '' ?>">
            <label for="altura">Altura:</label>
            <input type="text" name='altura' id='altura' value="<?php echo isset($reditando)?$reditando->getAltura() : '' ?>">
            <label for="un">UN:</label>
            <select name='un' id='un'>
                <option value=''>Selecione</option>
                <option value='cm' <?php  if($reditando) if ($reditando->getUn() == 'cm') echo 'selected'; ?> >Centímetros</option>
                <option value='px' <?php  if($reditando) if ($reditando->getUn() == 'px') echo 'selected'; ?>  >Pixel</option>
                <option value='%' <?php  if($reditando) if ($reditando->getUn() == '%') echo 'selected'; ?> >Porcentagem</option>
                <option value='vh' <?php  if($reditando) if ($reditando->getUn() == 'vh') echo 'selected'; ?> >View Port Height</option>
                <option value='vw' <?php  if($reditando) if ($reditando->getUn() == 'vw') echo 'selected'; ?> >View Port Width</option>
            </select>
            <label for="cor">Cor:</label>
            <input type="color" name='cor' id='cor' value='<?php  if($reditando) echo $reditando->getCor(); ?>'>
            <label for="id_quadro">Quadro:</label>
            <select name="id_quadro" id="id_quadro">
                <?php
                $quadro = new Quadro("", "");
                $lista = $quadro->listar();
                foreach ($lista as $item) {
                $selecao = '';
                if ($reditando) {
                if ($reditando->getQuadro() == $item['id']) {
                $selecao = 'selected';
                        }
                    }
                echo "<option value='". $item['id'] ."' $selecao>". $item['nome'] ."</option>";
                    }
                    ?>
                </select>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
        <?php if($reditando){ ?>
    <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
    <?php } ?>
        </form>

        <?php if ($reditando) { ?>
            <br>
            <div>
                <b>Área: <?php echo $reditando->calcularArea(); ?> <?php echo $reditando->getUn(); ?></b><br>
                <b>Perímetro: <?php echo $reditando->calcularPerimetro(); ?> <?php echo $reditando->getUn(); ?></b><br>
            </div>
        <?php } ?>
    </section>
    <hr>
    <div style='height:70vw'>
    <?php
        
        $lista = $retangulo->listar();
        foreach($lista as $item){
            $q = new Retangulo($item['id'], $item['base'], $item['altura'], $item['cor'], $item['un'],$item['id_quadro']);
            echo '<a draggable="true" href="index.php?id='.$q->getId().'">';
            echo $q->desenhar();
            echo '</a>';
        }
    ?>
    </div>
</body>
</html>
