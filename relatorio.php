<html>
<head>
    <title>Relatório Vendas</title>
    <?php include('./conectaBD.php')?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
    <form action="relatorio.php?botao=gravar" method="post" name="cliente_aluga">
        <table width="95%" border="10" align="center">
                <tr>
                    <td colspan=5 align="center">Relatório de locação</td>
                </tr>
                <tr>
                    <td width="9%" align="right">Codigo do Cliente:</td>
                    <td width="30%"><input type="numeric" name="FK_CLIENTE_CODIGO"  /></td>
                    <td width="12%" align="right">Placa Do carro</td>
                    <td width="26%"><input type="text" name="FK_VEICULO_PLACA" size="3" /></td>
                    <td width="12%" align="right">Data do pedido</td>
                    <td width="26%"><input type="date" name="DATA" size="3" /></td>
                    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
                </tr>
        </table>
    </form>

<?php if (isset($_POST['botao']) && $_POST['botao'] == "Gerar") { 

                $FK_CLIENTE_CODIGO = $_POST ['FK_CLIENTE_CODIGO'];
                $FK_VEICULO_PLACA  = $_POST ['FK_VEICULO_PLACA'];
                $DATA              = $_POST ['DATA'];

                $query = "SELECT cliente.NOME, veiculo.MODELO, veiculo.PLACA, cliente_aluga.DATA
                FROM cliente 
                INNER JOIN cliente_aluga ON cliente.CODIGO = cliente_aluga.FK_CLIENTE_CODIGO
                INNER JOIN veiculo ON veiculo.PLACA = cliente_aluga.FK_VEICULO_PLACA";
                $query .= ($FK_CLIENTE_CODIGO ? " AND cliente.CODIGO LIKE '%$FK_CLIENTE_CODIGO%' " : "");
                $query .= ($FK_VEICULO_PLACA ? " AND veiculo.PLACA LIKE '%$FK_VEICULO_PLACA%' " : "");
                $query .= ($DATA ? " AND cliente_aluga.DATA LIKE '%$DATA%' " : "");
                $query .= " ORDER BY cliente.NOME";
            
                $result = mysqli_query($mysqli, $query);
                if ($result) {
                    
  ?>
          <table width="95%" border="1" align="center">
              <tr bgcolor="#9999FF">
                  <th width="25%">Nome do Cliente</th>
                  <th width="20%">Modelo do Veículo</th>
                  <th width="20%">Data Retirada</th>
              </tr>
              <tr><a href="index.php">HOME</a></tr>
  <?php
          while ($coluna = mysqli_fetch_assoc($result)) {
  ?>
              <tr>
                  <td><?php echo $coluna['NOME']; ?></td>
                  <td><?php echo $coluna['MODELO']; ?></td>
                  <td><?php echo $coluna['DATA']; ?></td>
              </tr>
  <?php
          }
      } else {
          echo "Erro na consulta: " . mysqli_error($mysqli);
      }
  }
  ?>