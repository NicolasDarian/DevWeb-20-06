<?php
require_once('../classes/circulo.class.php');
require_once('../classes/quadro.class.php');
$circulo = new Circulo('', 1, 'x', 'x', 1);

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$ceditando = null;

if ($id > 0) {
    $dados = $circulo->listar(1, $id);
    $ceditando = new Circulo($dados[0]['id'], $dados[0]['raio'], $dados[0]['cor'], $dados[0]['un'],$dados[0]['id_quadro']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Círculos</title>
    <style>
        .desenho {
            border: 1px solid black;
            display: inline-block;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Cadastro de círculos</h1>
    <b><a href="../index.php">Quadro</a><b>  |  <b><a href="../triangulo/index.php">Triângulo</a><b>  |  </b><a href="../retangulo/index.php">Retângulo</a><b>  |  </b><a href="../quadrado/index.php">Quadrado</a>
    <section>
        <form action="acaocirculo.php" method="post">
            <label for="id">Id:</label>
            <input readonly type="text" name="id" id="id" value="<?php echo isset($ceditando) ? $ceditando->getId() : 0 ?>">
            <label for="raio">Raio:</label>
            <input type="text" name="raio" id="raio" value="<?php echo isset($ceditando) ? $ceditando->getLado() : '' ?>">
            <label for="un">UN:</label>
            <select name="un" id="un">
                <option value="">Selecione</option>
                <option value="cm" <?php if ($ceditando) if ($ceditando->getUn() == 'cm') echo 'selected'; ?>>Centímetros</option>
                <option value="px" <?php if ($ceditando) if ($ceditando->getUn() == 'px') echo 'selected'; ?>>Pixel</option>
                <option value="%" <?php if ($ceditando) if ($ceditando->getUn() == '%') echo 'selected'; ?>>Porcentagem</option>
                <option value="vh" <?php if ($ceditando) if ($ceditando->getUn() == 'vh') echo 'selected'; ?>>View Port Height</option>
                <option value="vw" <?php if ($ceditando) if ($ceditando->getUn() == 'vw') echo 'selected'; ?>>View Port Width</option>
            </select>
            <label for="cor">Cor:</label>
            <input type="color" name="cor" id="cor" value="<?php if ($ceditando) echo $ceditando->getCor(); ?>">
            <label for="id_quadro">Quadro:</label>
            <select name="id_quadro" id="id_quadro">
                <?php
                $quadro = new Quadro("", "");
                $lista = $quadro->listar();
                foreach ($lista as $item) {
                $selecao = '';
                if ($ceditando) {
                if ($ceditando->getQuadro() == $item['id']) {
                $selecao = 'selected';
                        }
                    }
                echo "<option value='". $item['id'] ."' $selecao>". $item['nome'] ."</option>";
                    }
                    ?>
                </select>
            <button type="submit" value="salvar" name="acao" id="acao">Salvar</button>
            <?php if ($ceditando) { ?>
                <button type="submit" value="excluir" name="acao" id="acao">Excluir</button>
            <?php } ?>
        </form>

        <?php if ($ceditando) { ?>
            <br>
            <div>
                <b>Área: <?php echo $ceditando->calcularArea(); ?> <?php echo $ceditando->getUn(); ?></b><br>
                <b>Perímetro: <?php echo $ceditando->calcularPerimetro(); ?> <?php echo $ceditando->getUn(); ?></b><br>
            </div>
        <?php } ?>
    </section>
    <hr>
    <div style="height: 70vw">
    <?php
        $lista = $circulo->listar();
        foreach ($lista as $item) {
            $c = new Circulo($item['id'], $item['raio'], $item['cor'], $item['un'],$item['id_quadro']);
            echo '<a draggable="true" href="index.php?id='.$c->getId().'">';
            echo $c->desenhar();
            echo '</a>';
        }
    ?>
    </div>
</body>
</html>
