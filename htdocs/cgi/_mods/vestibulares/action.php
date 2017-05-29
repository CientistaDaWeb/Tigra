<?php
extract($_POST);
require_once('vestibulares.php');
require_once('_classe/upload.php');

$objeto = new fac_vestibulares();
$objeto->id_fac_vestibulare = limpadados($id_fac_vestibulare);
$objeto->semestre = limpadados($semestre);
$objeto->ano = limpadados($ano);
$objeto->imagem = limpadados($imagem);
$objeto->divulgacao_data_inicio = limpadados(ajustadata($divulgacao_data_inicio,'banco'));
$objeto->divulgacao_data_fim = limpadados(ajustadata($divulgacao_data_fim,'banco'));
$objeto->insc_data_inicio = limpadados(ajustadata($insc_data_inicio,'banco'));
$objeto->insc_data_fim = limpadados(ajustadata($insc_data_fim,'banco'));
$objeto->gabarito = limpadados($gabarito);
$objeto->gabarito_data_inicio = limpadados(ajustadata($gabarito_data,'banco')).' '.limpadados($gabarito_hora);
$objeto->manual_candidato = limpadados($manual_candidato);
$objeto->data = limpadados(ajustadata($data,'banco'));

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 600;
	$up->img_height = 1030;

    $up->tmb_width = 200;
	$up->tmb_height = 200;

	$up->cli_img_dir = '_img/vestibulares/';
    $up->cli_tmb_dir = 'thumbs/';

    $up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}
if($_FILES['manual_candidato']['size'] > 0){
	$up = new upload($_FILES['manual_candidato']);
	$up->cli_img_dir = '_arquivos/vestibulares/';
    $up->send_file();
    print_r($up);
	$objeto->manual_candidato = $up->img_db_name;
}

$id = limpadados($id_fac_vestibulare);
$tg_mod_tabela = 'fac_vestibulares';
$tg_mod_tipo = 'Vestibular';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>