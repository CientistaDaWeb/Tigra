<style>
    td, th{
        font-size: 80% !important;
    }
</style>
<?php
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$con = new database2();
$sql = 'SELECT c.*, u.nome FROM tg_creditos c, tg_clientes u WHERE MONTH(c.data) = "'.$mes.'" AND YEAR(c.data) = "'.$ano.'"
    AND c.id_tg_cliente = u.id_tg_cliente ORDER BY c.data ASC';
$contas = $con->query($sql);
echo '<h2>'.$mes.'/'.$ano.'</h2>';
if($contas && $contas->num_rows > 0) {
    $pagamento = array('1'=>'aguardando', 'pago');
    echo '<h2>Créditos</h2>';
    echo '<table border="1" cellspacing="0" celspadding="0">';
    echo '<thead><tr>
        <th>Cliente</th>
        <th>Vencimento</th>
        <th>Valor</th>
        <th>Valor Pago</th>
        <th>descrição</th>
        <th>Status</th>
        </tr><thead><tbody>';
    while($conta = $contas->fetch_assoc()) {
        $totaldp += $conta['valor_pago'];
        $totaldr += $conta['valor'];
        echo '<tr>';
        echo '<td>'.$conta['nome'].'</td>';
        echo '<td>'.ajustadata($conta['data'],'site').'</td>';
        echo '<td>R$ '.number_format($conta['valor'],2).'</td>';
        echo '<td>R$ '.number_format($conta['valor_pago'],2).'</td>';
        echo '<td>'.$conta['descritivo'].'</td>';
        echo '<td>'.$pagamento[$conta['status']].'</td>';
        echo '<tr>';
    }
    echo '</tbody><tfoot><tr><th colspan="2">Totais</th><td>R$ '.number_format($totaldr,2).'</td><td>R$ '.number_format($totaldp,2).'</td><td colspan="2">R$ '.number_format(($totaldp-$totaldr)*(-1),2).'</td></tr></tfoot>';
    echo '</table>';
}
$sql = 'SELECT c.*, u.fornecedor FROM tg_debitos c, tg_fornecedores u WHERE MONTH(c.data) = "'.$mes.'" AND YEAR(c.data) = "'.$ano.'"
    AND c.id_tg_fornecedore = u.id_tg_fornecedore ORDER BY c.data ASC';
$contas = $con->query($sql);
$totalcp = 0;
$totalcr = 0;
if($contas && $contas->num_rows > 0) {
    $pagamento = array('1'=>'aguardando', 'pago');
    echo '<h2>Débitos</h2>';
    echo '<table border="1" cellspacing="0" celspadding="0">';
    echo '<thead><tr>
        <th>Fornecedor</th>
        <th>Vencimento</th>
        <th>Valor</th>
        <th>Valor Pago</th>
        <th>descrição</th>
        <th>Status</th>
        </tr><thead><tbody>';
    while($conta = $contas->fetch_assoc()) {
        $totalcp += $conta['valor_pago'];
        $totalcr += $conta['valor'];
        echo '<tr>';
        echo '<td>'.$conta['fornecedor'].'</td>';
        echo '<td>'.ajustadata($conta['data'],'site').'</td>';
        echo '<td>R$ '.number_format($conta['valor'],2).'</td>';
        echo '<td>R$ '.number_format($conta['valor_pago'],2).'</td>';
        echo '<td>'.$conta['descritivo'].'</td>';
        echo '<td>'.$pagamento[$conta['status']].'</td>';
        echo '<tr>';
    }
    echo '</tbody><tfoot><tr><th colspan="2">Totais</th><td>R$ '.number_format($totalcr,2).'</td><td>R$ '.number_format($totalcp,2).'</td><td>R$ '.number_format($totalcp-$totalcr,2).'</td></tr></tfoot>';
    echo '</table>';
    echo '<p>Lucro: R$ '.number_format($totaldp - $totalcp,2,',','.').'</p>';
}