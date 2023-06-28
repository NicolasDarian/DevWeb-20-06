<!DOCTYPE html>
<html lang="en">
<head>
<?php
    require_once('../classes/triangulo.class.php');
    require_once('../classes/quadro.class.php');
    $triangulo = new Triangulo('', 1, 1, 1, 'x', 'x', 1);

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $teditando = null;

    if ($id > 0) {
        $dados = $triangulo->listar(1, $id);
        $teditando = new Triangulo($dados[0]['id'], $dados[0]['lado1'], $dados[0]['lado2'], $dados[0]['lado3'], $dados[0]['cor'], $dados[0]['un'],$dados[0]['id_quadro']);
        }
            ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Triângulos</title>
    <style>
        .desenho {
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Triângulos</h1>
    <b><a href="../index.php">Quadro</a><b>  |  <b><a href="../quadrado/index.php">Quadrado</a><b>  |  </b><a href="../retangulo/index.php">Retangulo</a><b>  |  </b><a href="../circulo/index.php">Circulo</a>
    <section>
        <form action="acaotriangulo.php" method="post">
            <label for="id">Id:</label>
            <input readonly type="text" name="id" id="id" value="<?php echo isset($teditando) ? $teditando->getId() : 0 ?>">
            <label for="lado1">Lado 1:</label>
            <input type="text" name="lado1" id="lado1" value="<?php echo isset($teditando) ? $teditando->getLado1() : '' ?>">
            <label for="lado2">Lado 2:</label>
            <input type="text" name="lado2" id="lado2" value="<?php echo isset($teditando) ? $teditando->getLado2() : '' ?>">
            <label for="lado3">Lado 3:</label>
            <input type="text" name="lado3" id="lado3" value="<?php echo isset($teditando) ? $teditando->getLado3() : '' ?>">
            <label for="cor">Cor:</label>
            <input type="color" name="cor" id="cor" value="<?php echo isset($teditando) ? $teditando->getCor() : '' ?>">
            <label for="un">UN:</label>
            <select name="un" id="un">
                <option value="">Selecione</option>
                <option value="cm" <?php  if($teditando) if ($teditando->getUn() == 'cm') echo 'selected'; ?>>Centímetros</option>
                <option value='px' <?php  if($teditando) if ($teditando->getUn() == 'px') echo 'selected'; ?>  >Pixel</option>
                <option value='%' <?php  if($teditando) if ($teditando->getUn() == '%') echo 'selected'; ?> >Porcentagem</option>
                <option value='vh' <?php  if($teditando) if ($teditando->getUn() == 'vh') echo 'selected'; ?> >View Port Height</option>
                <option value='vw' <?php  if($teditando) if ($teditando->getUn() == 'vw') echo 'selected'; ?> >View Port Width</option>
            </select>
            <label for="id_quadro">Quadro:</label>
            <select name="id_quadro" id="id_quadro">
                <?php
                $quadro = new Quadro("", "");
                $lista = $quadro->listar();
                foreach ($lista as $item) {
                $selecao = '';
                if ($teditando) {
                if ($teditando->getQuadro() == $item['id']) {
                $selecao = 'selected';
                        }
                    }
                echo "<option value='". $item['id'] ."' $selecao>". $item['nome'] ."</option>";
                    }
                    ?>
                </select>
            <button name="acao" type="submit" id="acao" value="salvar">Salvar</button>
            <?php  if($teditando){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
        </form>

        <?php if ($teditando) { ?>
            <br>
            <div>
                <b>Área: <?php echo $teditando->calcularArea(); ?> <?php echo $teditando->getUn(); ?></b><br>
                <b>Perímetro: <?php echo $teditando->calcularPerimetro(); ?> <?php echo $teditando->getUn(); ?></b><br>
            </div>
        <?php } ?>
    </section>
    <hr>
    <div style="height: 70vw">
        <?php
        $lista = $triangulo->listar();
        foreach ($lista as $item) {
            $t = new Triangulo($item['id'], $item['lado1'], $item['lado2'], $item['lado3'], $item['cor'], $item['un'],$item['id_quadro']);
            echo '<a draggable="true" href="index.php?id=' . $t->getId() . '">';
            echo $t->desenhar();
            echo '</a>';
        }
        ?>
    </div>
</body>
</html>
