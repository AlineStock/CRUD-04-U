<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id']) ? $_POST['id'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO vendas VALUES(DEFAULT, ?, ?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $dados['placa']);
        $stmt->bindValue(2, $dados['modelo']);
        $stmt->bindValue(3, $dados['ano']);
        $stmt->bindValue(4, $dados['preco']);
        $stmt->bindValue(5, $dados['data_inserção']);
        $stmt->bindValue(6, $dados['estado']);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE vendas SET placa = ?, modelo = ?, ano = ?, preco = ?, data_inserção = ?, estado = ? WHERE id = ?');
        $stmt->bindValue(1, $dados['placa']);
        $stmt->bindValue(2, $dados['modelo']);
        $stmt->bindValue(3, $dados['ano']);
        $stmt->bindValue(4, $dados['preco']);
        $stmt->bindValue(5, $dados['data_inserção']);
        $stmt->bindValue(6, $dados['estado']);
        $stmt->bindValue(7, $codigo);
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from vendas WHERE id = :codigo');
        $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
        $codigoD = $codigo;
        $stmt->execute();
        header("location:index.php");

    }


    // Busca um item pelo código no BD
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM vendas WHERE id = '$codigo'");
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
        return $linha;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['placa'] = $_POST['placa'];
        $dados['modelo'] = $_POST['modelo'];
        $dados['ano'] = $_POST['ano'];
        $dados['preco'] = $_POST['preco'];
        $dados['data_inserção'] = $_POST['data_inserção'];
        $dados['estado'] = $_POST['estado']=="v" ? True : False;
        return $dados;
    }
?>