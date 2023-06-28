<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$lado = isset($_POST['lado'])?$_POST['lado']:0;
$cor = isset($_POST['cor'])?$_POST['cor']:'';
$un = isset($_POST['un'])?$_POST['un']:'';
$acao = isset($_POST['acao'])?$_POST['acao']:'';
$id_quadro = isset($_POST['id_quadro']) ? $_POST['id_quadro'] : 0;
if ($acao == 'salvar'){
    try{
        require_once('../classes/quadrado.class.php');
        $quadrado = new Quadrado($id,$lado,$cor,$un,$id_quadro);
        if ($id > 0)
            $quadrado->editar();
        else
            $quadrado->inserir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        require_once('../classes/quadrado.class.php');
        $quadrado = new Quadrado($id,$lado,$cor,$un, $id_quadro);
        $quadrado->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}
?>  