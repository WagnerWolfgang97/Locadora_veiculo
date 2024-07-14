<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu pedido</title>
    <?php include('conectaBD.php') ?>
    
    <style>
 header { 
        background-color:rgba(114, 248, 250, 0.5);
        width: auto;
        padding: 50px;
        margin-top: auto;
        font-family:Arial, Helvetica, sans-serif;
        text-align:start ;
        border-style:groove;
        border: thick groove rgba(98,13,181,0.99);
        border-width: 30px;
        margin-bottom: 10px;
        background-image: url(./imagens/controle.png) ;
        background-repeat: no-repeat;
        background-position:right 50%;
        }
        body {
            background-image: url(imagens/containerfoto.png);
            margin: auto;
            margin-left: 10%;
            margin-right: 10%;
            margin-bottom: auto;
            font-family:Arial, Helvetica, sans-serif;

        }
        table {
            font-style: italic;
            background-color:rgba(189, 189, 255, 0.9);
            border-style:groove;
            border: thick groove rgba(98,13,181,0.99);
            border-width: 30px;
            margin-bottom: 10px;
            font-family:Arial, Helvetica, sans-serif;
        }

        table-1 {
        font-family:Arial, Helvetica, sans-serif;
        background-color:rgba(211, 248, 250, 0.9);
        width: 50px;
        padding: 20px;
        font-family:fantasy;
        text-align: center;
        border-style:groove;
        border: thick groove rgba(98,13,181,0.99);
        border-width: 30px;
        margin-bottom: 10px;
        background-repeat: no-repeat;
        background-position:right 50%;
        }

        

    </style>
</head>
<body>
    <header>
            <form action="alugaveiculo.php" method="post" name="form1">
                <table width="95%" border="1">
                    <tr>
                        <td>Faça Seu pedido abaixo</td>
                    </tr>
                    <tr>
                        <td>Digite seu código:</td>
                        <td><input type="numeric" name="FK_CLIENTE_CODIGO"></td>
                    </tr>
                    <tr>
                        <td>Digite a placa de carro desejado:</td>
                        <td><input type="numeric" name="FK_VEICULO_PLACA"></td>
                    <tr>

                        <td>Data da Retirada</td>
                        <td><input type="date" name="DATA"></td>
                    </tr>
                    <td colspan="2" align="rigth">
                        <input type="submit" value="Gravar" name="botao">
                        <input type="reset" value="Limpar" name="botao">
                    </td>
                </table>
                
        
                <br><br><br><br><br><br><br><br>
<table-1>
    <tr>
        <th width="20%">
            <a href="index.php">HOME</a>
        </th>
    </tr>
</table-1>
</body>
</html>

            </form>

    </header>   
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require('conectaBD.php');

        $FK_CLIENTE_CODIGO = $_POST['FK_CLIENTE_CODIGO'];
        $FK_VEICULO_PLACA = $_POST['FK_VEICULO_PLACA'];
        $DATA = $_POST['DATA'];

        $sqlCount = "SELECT QUANTIDADE FROM VEICULO WHERE PLACA = '$FK_VEICULO_PLACA'";
        $resultCount = $mysqli->query($sqlCount);
        $rowCount = $resultCount->fetch_assoc();

        if ($rowCount && $rowCount['QUANTIDADE'] > 0) {

            $sql = "INSERT INTO cliente_aluga (FK_CLIENTE_CODIGO, FK_VEICULO_PLACA, DATA)
                    VALUES ('$FK_CLIENTE_CODIGO', '$FK_VEICULO_PLACA', '$DATA')";

            if ($mysqli->query($sql)) {
                $new_quantity = $rowCount['QUANTIDADE'] - 1;
                $update_sql = "UPDATE VEICULO SET QUANTIDADE = '$new_quantity' WHERE PLACA = '$FK_VEICULO_PLACA'";
                $mysqli->query($update_sql);

                $msg = "Parabéns pela locação do carro, pegue suas chaves na locadora";
            } else {
                $msg = "Erro ao gravar os dados: " . $mysqli->error;
            }
        } else {
            $msg = "Carro não disponível";
        }

        echo $msg;
    }
    ?>
   
</body>
</html>