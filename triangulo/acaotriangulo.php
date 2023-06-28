<?php
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$lado1 = isset($_POST['lado1']) ? $_POST['lado1'] : 0;
$lado2 = isset($_POST['lado2']) ? $_POST['lado2'] : 0;
$lado3 = isset($_POST['lado3']) ? $_POST['lado3'] : 0;
$cor = isset($_POST['cor']) ? $_POST['cor'] : '';
$un = isset($_POST['un']) ? $_POST['un'] : '';
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
$id_quadro = isset($_POST['id_quadro']) ? $_POST['id_quadro'] : 0;

require_once('../classes/triangulo.class.php');

if ($acao == 'salvar') {
    try {
        $triangulo = new Triangulo($id, $lado1, $lado2, $lado3, $cor, $un,$id_quadro);
        if ($id > 0)
            $triangulo->editar();
        else
            $triangulo->inserir();
        header('location:index.php');
    } catch (Exception $e) {
        echo "Erro ao inserir: " . $e->getMessage();
    }
} else if ($acao == 'excluir') {
    try {
        $triangulo = new Triangulo($id, $lado1, $lado2, $lado3, $cor, $un,$id_quadro);
        $triangulo->excluir();
        header('location:index.php');
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
