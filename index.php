<!DOCTYPE html>
<?php 
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Lista de Marcas";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$campo  = isset($_POST['campo']) ? $_POST['campo'] : "modelo";

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
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <br></br>
            <div class="col-6 offset-md-3">
    <br>
    <a href="cad.php"><button>Novo</button></a>
    <br><br>
    <form method="post">
        <input type="radio" name="campo" value="modelo" <?php if($campo=="modelo") echo "checked"?>>Modelo<br>
        <input type="radio" name="campo" value="preco" <?php if($campo=="preco") echo "checked"?>>Preço<br>
    <input type="text" name="consulta" id="consulta" value="<?php echo $consulta; ?>">
    <input type="submit" value="Pesquisar">
    </form>
    
    <br>
    <table border="1">
       <tr><th>Código</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Preço</th> 
        <th>Estado</th>
        <th>Parcelados em 38x</th>
        <th>Parcelados em 48x</th>
        <th>Tempo no estoque</th>
        <th>Detalhes</th> 
        <th>Alterar</th> 
        <th>Excluir</th> 
    </tr>
    <?php 
    $pdo = Conexao::getInstance();
    if ($campo=="modelo") {
        if ($consulta!="") {
            $consulta = $pdo->query("SELECT * FROM vendas WHERE modelo LIKE '$consulta%';");
        }else{
            $consulta = $pdo->query("SELECT * FROM vendas ORDER BY modelo;");
        }
    }else{
        if ($consulta!="") {
            $consulta = $pdo->query("SELECT * FROM vendas WHERE preco = '$consulta' ;");
        }else{
            $consulta = $pdo->query("SELECT * FROM vendas ORDER BY preco;");
        }
    }
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        $parcela38 = round($linha['preco']/38, 2);
        $parcela48 = round($linha['preco']/48, 2);
        $estado = $linha['estado']==1 ? "Vendido" : "A venda";
        $tempo = (strtotime(date("Y/m/d")) - strtotime($linha['data_inserção']))/60/60/24;
        ?>
        <tr>
            <td><?php echo $linha['id']; ?></td>
            <td><?php echo $linha['placa']; ?></td>
            <td><?php echo $linha['modelo']; ?></td>
            <td><?php echo $linha['preco']; ?></td>
            <td><?php echo $estado; ?></td>
            <td><?php echo $parcela38; ?></td>
            <td><?php echo $parcela48; ?></td>
            <td><?php echo $tempo; ?></td>
            <td><a href='show.php?id=<?php echo $linha['id'];?>'>Descrever</a></td>
            <td><a href='cad.php?acao=editar&codigo=<?php echo $linha['id'];?>'>Editar</a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['id'];?>')">Deletar</a></td>
        </tr>
    <?php } ?>       
    </table>
    </div>
        </div>
    
</body>
</html>
