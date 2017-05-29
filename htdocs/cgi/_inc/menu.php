<div id="topo_lateral">
<a href="http://www.ween.com.br" title="Ween Web Solutions" target="_blank">Ween Web Solutions</a>
</div>
<div class="menu_nav">
<?php
$tcat = 'asd';
$categorias = $con_tigra->executa("SELECT * FROM tg_cat_modulos WHERE fk_tg_cliente = $_SESSION[id_tg_cliente] ORDER BY categoria");
if($categorias && mysqli_num_rows($categorias)>0){
	while($categoria = mysqli_fetch_assoc($categorias)){
		$modulos = $con_tigra->executa("SELECT * FROM tg_catxmodulos WHERE fk_tg_cat_modulo = $categoria[id_tg_cat_modulo]");	
		if($modulos && mysqli_num_rows($modulos)>0){
			while($modulo = mysqli_fetch_assoc($modulos)){
				$permissoes = $con_tigra->executa("SELECT * FROM tg_permissoes WHERE fk_tg_cat_modulo = $categoria[id_tg_cat_modulo] AND fk_tg_modulo = $modulo[fk_tg_modulo] AND fk_tg_usuario = $_SESSION[id_tg_usuario]");
				$classe = "";
				if($permissoes && mysqli_num_rows($permissoes)>0){
					$modiulo = $con_tigra->executa("SELECT * FROM tg_modulos WHERE id_tg_modulo = $modulo[fk_tg_modulo] ORDER BY modulo");
					$modiulo = mysqli_fetch_assoc($modiulo);
					if($tcat != $categoria['id_tg_cat_modulo']){
					?>
                    <a class="menuitem categoria"><img src="<?=$url_base?>/_img/modulos/categorias/<?=$categoria['icone']?>" width="165" height="40" alt="<?=$categoria['nome']?>" /></a>
                    <div class="submenu">
                    	<ul>
                    <?php
					}
					if($modiulo['pasta'] == $mod){
						$classe = "class='selecionado'";
					}
					?>
                        	<li><a href="<?=$url_base?>/cgi/<?=$modiulo['pasta']?>" title="<?=$modiulo['tooltip_msg']?>" <?=$classe?>><img src="<?=$url_base?>/_img/modulos/icones/<?=$modiulo['icone']?>" width="165" height="50" alt="<?=$modulo['tooltip_msg']?>" /></a></li>
                     <?php
                     $tcat = $categoria['id_tg_cat_modulo'];
				}				
			}		
		}
		if($tcat == $categoria['id_tg_cat_modulo']){
		?>
        </ul>
        </div>
        <?
		}
	}				
}
?>
    <div id="ween">
        <p>Tigra 0.98.6 Beta</p>
        <p>Desenvolvido por:</p><p> <a href="http://www.ween.com.br"><img src="<?=$url_base?>/_img/ween.gif" title="Ween Web Solutions" /></a></p>
        <p>Todos os direitos reservados.</p>
    </div>
</div>
