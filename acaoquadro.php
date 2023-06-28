<?php
    require_once('classes/quadro.class.php');

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if ($acao == 'salvar') {
        $quadro = new Quadro($id, $nome);
        try {  
            if ($id == 0) {
                if ($quadro->inserir()) {
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: index.php");
                    exit();
                }
            } else {
                try {
                    if ($quadro->editar()) {
                        header("Location: index.php");
                        exit();
                    } else {
                        header("Location: index.php");
                        exit();
                    }
                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else if ($acao == 'excluir') {
        $quadro = new Quadro($id, $nome);
        try {
            if ($quadro->excluir()) {
                header("Location: index.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
?>
