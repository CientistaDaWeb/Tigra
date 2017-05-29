<?php
require_once('alunos.php');
if ($id) {
    $pesquisa = new alunos();
    $pesquisa->busca($id);
    $id_setor = $pesquisa->id_setor;
    $matricula = $pesquisa->matricula;
    $nome = $pesquisa->nome;
}
?>
<h2>Histórico Escolar</h2>
<h3><?php echo $nome; ?> - <?php echo $matricula; ?></h3>
<?php
$query = 'SELECT * FROM setors WHERE id_setor = ' . $id_setor . ' LIMIT 0,1';
$setores = $con_cliente->query($query);
if ($setores && $setores->num_rows > 0) {
    while ($setore = $setores->fetch_assoc()) {
        $setor = $setore['slug'];
    }
}
$id_tg_cliente = $_SESSION['id_tg_cliente'];
$con = new database();
$query = 'SELECT * FROM tg_clientes WHERE id_tg_cliente =' . $id_tg_cliente;
$cliente = $con->query($query);
$cliente = mysqli_fetch_assoc($cliente);
$dominio = decripfy($cliente['dominio'], 'h0s7');
$pasta = '/home/serverws/public_html/docs/' . $dominio . '/boletim/' . $setor;
$arquivo = realpath($pasta . '/boletim.csv');
if (is_file($arquivo)) {
    $fp = fopen($arquivo, "r");
    while (($dados = fgetcsv($fp, 0, ";")) !== FALSE) {
        if (str_replace('.', '', $dados[0]) == $matricula) {
            $data = NULL;
            $data['disciplina'] = utf8_encode($dados[3]);
            $data['nota'] = utf8_encode($dados[6]);
            $data['situacao'] = utf8_encode($dados[7]);
            $retorno[] = $data;
        }
    }
    fclose($fp);
    if (isset($retorno)):
        $resposta = '';
        foreach ($retorno AS $item):
            $resposta .= '<h3>' . $item['disciplina'] . '</h3><p>Nota: ' . $item['nota'] . ' - ' . $item['situacao'] . '</p>';
        endforeach;
        echo $resposta;
    else:
        echo '<h3>Histórico não encontrado!</h3>';
    endif;
}else {
    echo '<h3>Arquivo não encontrado!</h3>';
}
?>