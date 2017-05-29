<?php
session_start();
$url_base = 'http://'.$_SERVER['HTTP_HOST'];

require_once('../cgi/_inc/function.php');
require_once('../cgi/_classe/database.php');
$con = new database();

$url = $_SERVER['REQUEST_URI'];
$var = explode('/', $url);
$id_tg_cliente = $var[2];

if($_POST['id_tg_cliente']){
	$_SESSION['id_tg_cliente'] = $_POST['id_tg_cliente'];
}
if($id_tg_cliente){
	$_SESSION['id_tg_cliente'] = decripfy($id_tg_cliente,'id_tg_cliente');
}

$tem = false;
if($_SESSION['id_tg_cliente']){
	$clientes = $con->executa("SELECT * FROM tg_clientes WHERE id_tg_cliente = $_SESSION[id_tg_cliente]");
	if($clientes && mysqli_num_rows($clientes) == 1){
		$cliente = mysqli_fetch_assoc($clientes);
		$_SESSION['cliente'] = $cliente['nome'];
		$dias_avaliacao = 0;
		if($cliente['avaliacao'] == 1){
			$data = $cliente['data'];
			$data = split("-", $data);
			$data_banco = ($data[0]*365)+($data[1]*30)+ $data[2] + 30;
			$data_atual= (date("Y")*365)+(date("m")*30)+date("d");
			$dias_avaliacao = $data_banco - $data_atual;
		}
	}
}
require_once('../cgi/_inc/header.php');
?>
<script type="text/javascript">
$(document).ready(function() { 
   $("#tg_usuario").focus();
	function valida_login(){
		var formStats;
		var campo_focus;
		$(".obrigatorio").each(function () {
			if($(this).val() == ""){
				campo_focus = $(this);
				$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> está em branco.");
				$("#botao_warning").html("<input type='button' id='close_warning' value='OK' />");
				$("#warning").show();
				$(this).addClass("invalid");
				formStats = false;
				return false;
			}else{
				$(this).removeClass("invalid");
				formStats = true;
			}
      });
		$("#close_warning").click(function(){
			$("#warning").hide();
			campo_focus.focus();
		});
		return formStats;
	};	
	var login_options = {
		beforeSubmit: valida_login,
		target: "#stats",
		url: "action.php",
		type: "POST",
		success: function(resposta){
			$("#stats").html(resposta);
			$("#warning").show();
		}
	};
	$('#tg_login').submit(function() { 
		$("#stats").html("Aguarde...");
		$(this).ajaxSubmit(login_options); 
		return false;
	});
});
</script>
<div id="transparente">
</div>
<div id="login">
<?php
	if($_SESSION['cliente'] && $dias_avaliacao >= 0){
?>
	<form name="tg_login" id="tg_login" method="post">
    <table>
        <tr>
            <td><div id="logo"><img src="../_img/clientes/<?=$cliente['logotipo']?>" /></div></td>
        </tr>
        <tr>
            <th>Usuário:</th>
        </tr>
        <tr>
            <td><input type="text" maxlength="25" name="tg_usuario" id="tg_usuario" title="Usuário" class="inpute obrigatorio" /></td>
        </tr>
        <tr>
            <th>Senha:</th>
        </tr>
        <tr>
            <td><input type="password" maxlength="25" name="tg_senha" id="tg_senha" title="Senha" class="inpute obrigatorio" /></td>
        </tr>
		<?php
        if($dias_avaliacao > 0){
		?>
        <tr>
        	<th style="color:#F00; font-size:70%; text-align:center;">Restam <?=$dias_avaliacao?> dias para avaliação.</th>
        </tr>
        <?php
		}
		?>
        <tr>
            <td><input type="submit" value="" id="bt_acessar" /></td>
        </tr>
    </table>
    </form>
    <?php
	}else{
	?>
    <div id="logo"><img src="../_img/clientes/ween.gif" /></div>
    <div id="sem_permissao">
    <?php
		if(!$_SESSION['cliente']){
	?>
    	Sessão Expirada.<br /><br />
        Acesse o Tigra através do link fornecido ou atráves do seu site.    
    <?php
		}else{
		?>
        O período de avaliação terminou.<br /><br />
        Ligue para (54) 3055-3125 para contratar o serviço.
        <?php	
		}
	}
	?>
	</div>
</div>
<?php
require_once('../cgi/_inc/footer.php');
?>