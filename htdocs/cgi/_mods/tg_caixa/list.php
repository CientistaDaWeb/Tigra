<?php
extract($_POST);
if($ano_inicio && $ano_fim) {
    $con = new database2();

    $sql = 'UPDATE tg_caixas SET debito_pago = 0, debito_devedor = 0, credito_pago = 0, credito_devedor = 0';
    $con->query($sql);

    // Débitos não pagos
    $sql = 'SELECT SUM(valor) as total, MONTH(data) AS mes, YEAR(data) AS ano
    FROM tg_debitos
    WHERE YEAR(data) BETWEEN '.$ano_inicio.' AND '.$ano_fim.'
    AND status = 1
    GROUP BY mes, ano
    ORDER BY ano, mes';
    $lista = $con->query($sql);
    while($conta = $lista->fetch_assoc()) {
        $sql = 'UPDATE tg_caixas SET debito_devedor = "'.$conta['total'].'" WHERE mes = '.$conta['mes'].' AND ano = '.$conta['ano'];
        $con->query($sql);
    }

    // Débitos pagos
    $sql = 'SELECT SUM(valor_pago) as total, MONTH(data_pago) AS mes, YEAR(data_pago) AS ano
    FROM tg_debitos
    WHERE YEAR(data) BETWEEN "'.$ano_inicio.'" AND "'.$ano_fim.'"
    AND status = 2
    GROUP BY mes, ano
    ORDER BY ano, mes';
    $lista = $con->query($sql);
    while($conta = $lista->fetch_assoc()) {
        $sql = 'UPDATE tg_caixas SET debito_pago = "'.$conta['total'].'" WHERE mes = '.$conta['mes'].' AND ano = '.$conta['ano'];
        $con->query($sql);
    }

    // Créditos não pagos
    $sql = 'SELECT SUM(valor) as total, MONTH(data) AS mes, YEAR(data) AS ano
    FROM tg_creditos
    WHERE YEAR(data) BETWEEN "'.$ano_inicio.'" AND "'.$ano_fim.'"
    AND status = 1
    GROUP BY mes, ano
    ORDER BY ano, mes';
    $lista = $con->query($sql);
    while($conta = $lista->fetch_assoc()) {
        $sql = 'UPDATE tg_caixas SET credito_devedor = "'.$conta['total'].'" WHERE mes = '.$conta['mes'].' AND ano = '.$conta['ano'];
        $con->query($sql);
    }

    // Créditos pagos
    $sql = 'SELECT SUM(valor_pago) as total, MONTH(data_pago) AS mes, YEAR(data_pago) AS ano
    FROM tg_creditos
    WHERE YEAR(data) BETWEEN "'.$ano_inicio.'" AND "'.$ano_fim.'"
    AND status = 2
    GROUP BY mes, ano
    ORDER BY ano, mes';
    $lista = $con->query($sql);
    while($conta = $lista->fetch_assoc()) {
        $sql = 'UPDATE tg_caixas SET credito_pago = "'.$conta['total'].'" WHERE mes = '.$conta['mes'].' AND ano = '.$conta['ano'];
        $con->query($sql);
    }

    $sql = 'SELECT * FROM tg_caixas WHERE ano BETWEEN "'.$ano_inicio.'" AND "'.$ano_fim.'" ORDER BY ano, mes';
    $movimentacao = $con->query($sql);
    echo '<table border="1" cellspacing="0" celspadding="0">
        <tr>
            <th>M/A</th>
            <th>Déb. Pago</th>
            <th>Déb. Ñ Pago</th>
            <th>Total</th>
            <th>Créd. Pago</th>
            <th>Créd. Ñ Pago</th>
            <th>Total</th>
            <th>Lucro</th>
            <th>Est.</th>
            <th>Luc. Ac.</th>
            <th>Est Ac.</th>
        </tr>';
    while($movimento = $movimentacao->fetch_assoc()) {
        $totalD = $movimento['debito_pago']+$movimento['debito_devedor'];
        $totalC = $movimento['credito_pago']+$movimento['credito_devedor'];
        $lucro = $movimento['credito_pago'] - $movimento['debito_pago'];
        $estimativa = $totalC - $totalD;
        $lucroA += $lucro;
        $estimativaA += $estimativa;
        echo '<tr>
            <td>'.$movimento['mes'].'/'.$movimento['ano'].'</td>
            <td>'.number_format($movimento['debito_pago'],2,',','.').'</td>
            <td>'.number_format($movimento['debito_devedor'],2,',','.').'</td>
            <td>'.number_format($totalD,2,',','.').'</td>
            <td>'.number_format($movimento['credito_pago'],2,',','.').'</td>
            <td>'.number_format($movimento['credito_devedor'],2,',','.').'</td>
            <td>'.number_format($totalC,2,',','.').'</td>
            <td>'.number_format($lucro,2,',','.').'</td>
            <td>'.number_format($estimativa,2,',','.').'</td>
            <td>'.number_format($lucroA,2,',','.').'</td>
            <td>'.number_format($estimativaA,2,',','.').'</td>
        </tr>';
    }
    echo '</table><hr />';
    ?>
<style>
    td, th{
        font-size: 80% !important;
    }
    </style>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['barchart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create our data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'x');
        data.addColumn('number', 'Crédito');
        data.addColumn('number', 'Débito');
        data.addColumn('number', 'Lucro');
        data.addColumn('number', 'Estimativa');
        data.addColumn('number', 'Lucro Acumulado');
        data.addColumn('number', 'Estimativa Acumulada');
    <?php
    $movimentacao = $con->query($sql);
    $lucroA = 0;
    $estimativaA = 0;
    while($movimento = $movimentacao->fetch_assoc()) {
        $totalD = $movimento['debito_pago']+$movimento['debito_devedor'];
        $totalC = $movimento['credito_pago']+$movimento['credito_devedor'];
        $lucro = $movimento['credito_pago'] - $movimento['debito_pago'];
        $estimativa = $totalC - $totalD;
        $lucroA += $lucro;
        $estimativaA += $estimativa;
        ?>
                data.addRow([
                    "<?php echo $movimento['mes'].'/'.$movimento['ano'] ?>",
        <?php echo number_format($movimento['credito_pago'],2,',','.'); ?>,
        <?php echo number_format($movimento['debito_pago'],2,',','.'); ?>,
        <?php echo number_format($lucro,2,',','.'); ?>,
        <?php echo number_format($estimativa,2,',','.'); ?>,
        <?php echo number_format($lucroA,2,',','.'); ?>,
        <?php echo number_format($estimativaA,2,',','.'); ?>,
                    ]);
        <?php
    }
    ?>

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                chart.draw(data, {width: 560, height: 700, is3D: true, title: 'Caixa da Ween'});
            }
</script>
<div id="chart_div">

</div>
<hr />
    <?php
}
?>
<h2>Gerar Caixa</h2>
<form method="POST">
    <table>
        <tr>
            <th>Ano de inicio:</th>
            <td><select name="ano_inicio">
                    <?php for($i=2009; $i<2015; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }?>
                </select></td>
            <th>Ano de fim:</th>
            <td><select name="ano_fim">
                    <?php for($i=2009; $i<2015; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }?>
                </select></td>
        </tr>
        <tr>
            <th colspan="4">
                <button type="submit">
                    Gerar Caixa
                </button>
            </th>
        </tr>
    </table>
</form>
<hr />
<h2>Relatório Mensal</h2>
<form action="<?=$url_base?>/cgi/<?=$mod?>/relatorio" method="post">
    <table>
        <tr>
            <th>Mês:</th>
            <td><select name="mes">
                    <?php for($i=1; $i<13; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }?>
                </select></td>
            <th>Ano:</th>
            <td><select name="ano">
                    <?php for($i=2009; $i<2015; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }?>
                </select></td>
        </tr>
        <tr>
            <th colspan="4">
                <button type="submit">
                    Gerar Relatório
                </button>
            </th>
        </tr>
    </table>
</form>