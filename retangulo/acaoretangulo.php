<?php
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$base = isset($_POST['base']) ? $_POST['base'] : 0;
$altura = isset($_POST['altura']) ? $_POST['altura'] : 0;
$cor = isset($_POST['cor']) ? $_POST['cor'] : '';
$un = isset($_POST['un']) ? $_POST['un'] : '';
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
$id_quadro = isset($_POST['id_quadro']) ? $_POST['id_quadro'] : 0;

require_once('../classes/retangulo.class.php');

if ($acao == 'salvar') {
    try {
        $retangulo = new Retangulo($id, $base, $altura, $cor, $un, $id_quadro);
        if ($id > 0)
            $retangulo->editar();
        else
            $retangulo->inserir();
        header('location:index.php');
        exit;
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
} else if ($acao == 'excluir') {
    try {
        $retangulo = new Retangulo($id, $base, $altura, $cor, $un, $id_quadro);
        $retangulo->excluir();
        header('location:index.php');
        exit;
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
