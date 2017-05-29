<?php
extract($_POST);
require_once('vestibulares.php');
require_once('_classe/class.upload.php');
require_once('_classe/ftp.class.php');

$objeto = new vestibulares();
$objeto->id_vestibulare = limpadados($id_vestibulare);
$objeto->semestre = limpadados($semestre);
$objeto->edicao = limpadados($edicao);
$objeto->ano = limpadados($ano);
$objeto->insc_data_inicio = limpadados(ajustadata($insc_data_inicio,'banco'));
$objeto->insc_data_fim = limpadados(ajustadata($insc_data_fim,'banco'));
$objeto->gabarito = limpadados($gabarito);
$objeto->gabarito_data = limpadados(ajustadata($gabarito_dt,'banco')).' '.limpadados($gabarito_hora);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->valor_promocional = limpadados($valor_promocional);
$objeto->data_promocional = limpadados(ajustadata($data_promocional,'banco'));
$objeto->valor = limpadados($valor);

if($_FILES['manual_candidato']['size'] > 0) {
$upload = new upload($_FILES['manual_candidato']);
    if ($upload->uploaded) {
        $pasta['servidor'] = '../tmp_up/'.$_SESSION['id_tg_usuario'];
        $pasta['cliente'] = '_arquivos/vestibulares';

        $upload->process($pasta['servidor']);
        $ftp = new ClsFTP();
        $ftp->put($pasta['cliente'].'/'.$upload->file_dst_name, $pasta['servidor'].'/'.$upload->file_dst_name);
        $objeto->manual_candidato = $upload->file_dst_name;
    }
}
$id = limpadados($id_vestibulare);
$tg_mod_tabela = 'vestibulares';
$tg_mod_tipo = 'Vestibular';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');