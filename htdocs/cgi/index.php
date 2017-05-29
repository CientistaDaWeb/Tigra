<?php

require_once('_inc/secure.php');
require_once('_inc/function.php');
$start=timer('start', '');
require_once('_inc/config.php');
require_once('_inc/header.php');
require_once('_classe/database.php');
$con_tigra = new database();
require_once('_classe/database2.php');
$con_cliente = new database2();
require_once('_classe/pagination_class.php');
?>
<script>
/*############### Mostra o tempo que falta para expirar a Sess�o ################*/
function fim_sessao(){
	var txt_tempo_sec = document.getElementById("fim_sessao_sec");
	var txt_tempo = document.getElementById("fim_sessao");
	
	var temp_sec = parseInt(txt_tempo_sec.value)-1;
	var minutos = parseInt(temp_sec/60);
	var segundos = temp_sec%60;
	if(segundos<10){
		segundos = "0"+segundos;	
	}
	if(temp_sec > 0){
		var tempo = "Auto sair em: "+minutos+":"+segundos;
	}else{
		var tempo = "Saindo";
		window.location='<?=$url_base?>/cgi/yEgEBAxIRMxERHaAylL80CGj3bV4aQryHLg=';
	}
	
	txt_tempo_sec.value = temp_sec;
	txt_tempo.value = tempo;
	setTimeout("fim_sessao()",1000);
}

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "searchreplace, paste",
	theme_advanced_buttons1: "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|undo,redo,|,link,unlink,code,|,pasteword,|,search,replace,|,forecolor,backcolor,removeformat",
	theme_advanced_buttons2:'',
	theme_advanced_buttons3:'',
	theme_advanced_buttons4:'',
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	language : "pt"
});
<?php
if($pagina != 'action'){
?>
$(document).ready(function(){
	fim_sessao();
	//$(document).pngFix();
});
<?php
}
?>
</script>
<div id="site">
    <div id="menu">
    	<div class="menuLinhaEsq"></div>
        <div class="menuContent">
          <? require_once('_inc/menu.php') ?>
        </div>
    </div>
    <div id="topo">
		<a class="btn_topo" href="<?=$url_base?>/cgi/"><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_home.gif" alt="Home" /></a>
        <a class="btn_topo" href="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>" target="_blank"><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_meu_site.gif" alt="Meu Site" /></a>
        <a class="btn_topo" href="<?=$url_base?>/cgi/CEwAgETMDEhEDGs5yb0FMn+fDN+ietG+yYo="><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_ajuda.gif" alt="Ajuda" /></a>
        <a class="btn_topo" href="<?=$url_base?>/cgi/hITEiIwIhEhIgIuvA9twbYoEMfnbkkolKiK1fPETnSGReHGl1IX2TJ66"><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_pol_privacidade.gif" alt="Politica de Pricacidade" /></a>
        <a class="btn_topo" href="<?=$url_base?>/cgi/iIQMxACMgIzEAMdie2UW3QVoHnOE3aQaPiM="><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_contato.gif" alt="Contato" /></a>
        <a class="btn_topo" href="<?=$url_base?>/cgi/yEgEBAxIRMxERHaAylL80CGj3bV4aQryHLg="><img src="<?=$url_base?>/cgi/_css/_img/btn/btn_sair.gif" alt="Sair" /></a>
    </div>
    <div id="conteudo">
        <?php
        require_once('_inc/alert.php');
        ?>
		<?php
        if(file_exists("_mods/$tg_mod/$pagina.php")){
			if($pagina === 'form'){
			?>
            <script type="text/javascript">
			$(document).ready(function(){
				crir.init();
			});
			</script>
			<?php
			}
			$uneed_permits = array('inicio', 'logout', 'duvidas', 'politica_privacidade', 'contato');
			if(!in_array($tg_mod, $uneed_permits)){
				$seila = $con_tigra->executa("SELECT * FROM tg_modulos WHERE pasta = '$mod'");	
				if($seila && mysqli_num_rows($seila)>0){
					$seila = mysqli_fetch_assoc($seila);
					require_once("_inc/megavalidator.php");
				}
				if($passou){
					if($pagina == 'form'){
					?>
                    <script type="text/javascript" src="<?=$url_base?>/cgi/_js/validator.js"> </script>
                    <?	
					}
					echo("<div id='tit_mod'><img src='$url_base/_img/modulos/titulos/$seila[titulo]' /></div>");
					require_once("_mods/$tg_mod/$pagina.php");
				}else{
					require_once('666.php');
				}
			}else{
	            require_once("_mods/$tg_mod/$pagina.php");
			}
        } else {
            require_once('404.php');
        }
        ?>  
    </div>
    <div id="direita">	
		<p><input type="text" id="fim_sessao" value="<?=session_cache_expire()?>" readonly="readonly">
        <input id="fim_sessao_sec" type="text" value="<?=(intval(session_cache_expire())*60)-60?>"></p>
        <p id="tempo_carregar">P&aacute;gina gerada em<br /><?=$stopcount=timer('finalize',$start)?> segundos.</p>
		<div id="tigra"></div>
    </div>
</div>
<?php
require_once('_inc/footer.php');
?>
