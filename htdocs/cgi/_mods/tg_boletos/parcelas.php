<?php
$parcelas = $_POST['parcelas'];
$valor = $_POST['valor'];
$diaPagamento = $_POST['diaPagamento'];
$diasPagamento = $_POST['diasPagamento'];
if($parcelas != 'undefined') {
    $parcela = number_format($valor/$parcelas,2,'.','');
    echo '<table>';
    $j = 0;
    for($i=0; $i<$parcelas; $i++) {
        if($i==0) {
            $data1 = mktime(0,0,0, date(m), date(d)+$diasPagamento, date(Y));
            if(date('d', $data1)<=$diasPagamento){
                $j=$j+ceil($diasPagamento/30);
            }
            $data = date('d/m/Y',$data1);
        }else {
            $data1 = mktime(0,0,0, date(m)+$j, $diaPagamento, date(Y));
            $data = date('d/m/Y',$data1);
        }
        echo '<tr>';
        echo '<td><input type="text" name="datap[]" value="'.$data.'"></td>';
        echo '<td><input type="text" name="valorp[]" class="valorp" value="'.$parcela.'"></td>';
        echo '</tr>';
        $j++;
    }
    echo '</table>';
}else {
    echo 'Preencha todos os campos';
}