<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        body, input{
            background-color: #FFF0F5  ;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<div class="container">
        <div class="row">
            <br></br>
            <div class="col-6 offset-md-3">
                <a href="index.php"><button>Listar</button></a>
                <a href="cad.php"><button>Novo</button></a>
<br><br>
<form action="acao.php" method="post">
    <input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>
    <input required=true   type="text" name="placa" id="placa" value="<?php if ($acao == "editar") echo $dados['placa']; ?>"><br>
    <input required=true   type="text" name="modelo" id="modelo" value="<?php if ($acao == "editar") echo $dados['modelo']; ?>"><br>
    <input required=true   type="text" name="ano" id="ano" value="<?php if ($acao == "editar") echo $dados['ano']; ?>"><br>
    <input required=true   type="text" name="preco" id="preco" value="<?php if ($acao == "editar") echo $dados['preco']; ?>"><br>
    <input required=true   type="date" name="data_inserção" id="data_inserção" value="<?php if ($acao == "editar") echo $dados['data_inserção']; ?>"><br>
    <input type="radio" name="estado" value="v" <?php if($acao == "editar")if($dados['estado']==1) echo "checked"; ?>>Vendido<br>
        <input type="radio" name="estado" value="nv" <?php if($acao == "editar") if($dados['estado']==0) echo "checked"; ?>>A venda<br>
    <br><button type="submit" name="acao" id="acao" value="salvar" class='btn btn-danger'>Salvar</button>
    </div>
        </div>
</form>
</body>
</html>