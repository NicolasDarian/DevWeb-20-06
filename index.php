<!DOCTYPE html>
<html lang="en">
<head>
<?php
    require_once('acaoquadro.php');
    require_once('classes/quadro.class.php'); 

    $quadro = new Quadro(1, '');

    $qeditando = null;

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    if ($id > 0){
        $dados = $quadro->listar(1,$id);
        $qeditando = new Quadro($dados[0]['id'],$dados[0]['nome']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
            $id = $_POST['id'];
            header("Location: index.php?acao=editar&id=$id");
            exit();
        }
    }
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadro</title>
    <style>
        .desenho {
        }

        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
<b><a href="triangulo/index.php">Triângulo</a><b>  |  <b><a href="quadrado/index.php">Quadrado</a><b>  |  </b><a href="retangulo/index.php">Retângulo</a><b>  |  </b><a href="circulo/index.php">Círculo</a>
<form action="acaoquadro.php" method="post">   
    <label for="id">ID</label>
    <input type="text" name="id" id="id" readonly value="<?php echo isset($qeditando)?$qeditando->getId():0 ?>">                       
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control" value="<?php if($qeditando) echo $qeditando->getNome(); ?>"> 
    <button type="submit" class="btn btn-primary" name="acao" value="salvar"><?= ($qeditando) ? 'Editar' : 'Salvar'; ?></button>
</form>
<br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cor</th>
            <th>Unidade</th>
            <th>Desenho</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $lista = $quadro->listar();
        foreach ($lista as $item) {
            $q = new Quadro($item['id'], $item['nome']);
            foreach ($q->getFormas() as $forma) {
                echo '<tr>
                    <td>'.$q->getId().'</td>
                    <td>'.$q->getNome().'</td>
                    <td>'.$forma->getCor().'</td>
                    <td>'.$forma->getUn().'</td>
                    <td>'.$forma->desenhar().'</td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="id" value="' . $q->getId() . '">
                            <button type="submit" class="btn btn-primary" name="acao" value="editar">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="acaoquadro.php" method="post" onsubmit="return confirm(\'Tem certeza que deseja excluir este quadro?\')">
                            <input type="hidden" name="id" value="' . $q->getId() . '">
                            <button type="submit" class="btn btn-danger" name="acao" value="excluir">Excluir</button>
                        </form>
                    </td>
                </tr>';
            }
        }
        ?>
    </tbody>
</table>
</body>
</html>
