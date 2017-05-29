<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
var buscando = 'Buscando';
var modulo = "<?=$mod?>";
function pagination(page){
    $('#page_contents').empty();
    $('#page_contents').append(buscando);
    var palavra = document.getElementById("searchtext").value;
    $.ajax({
		type: "POST",
		url: "/cgi/_mods/<?=$tg_mod?>/data.php?noob="+ new Date().getTime(),
		data: "page="+escape(page)+"&searchtext="+escape(palavra)+"&modulo="+(modulo),
		success: function(msg){
			$('#page_contents').empty();
			$("#page_contents").append(msg);
		}
	});
};
function busca(palavra){
    $('#page_contents').empty();
    $('#page_contents').append(buscando);
    $.ajax({
		type: "POST",
		url: "/cgi/_mods/<?=$tg_mod?>/data.php?noob="+ new Date().getTime(),
		data: "searchtext="+escape(palavra)+"&page=0&modulo="+(modulo),
		success: function(msg){
			$('#page_contents').empty();
			$("#page_contents").append(msg);
		}
	});
}
</script>
<form id="upload_tag" enctype="multipart/form-data" method="POST">
<div>
    <table>
        <tr>
            <td class="tit_campo" colspan="2">Lista de alunos:</td>
        </tr>
        <tr>
            <td><input type="file" id="arquivo" name="arquivo" class="inpute"  value="Procurar"/></td>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/importa_alunos.php','alunos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Adicionar</button></td>
        </tr>
    </table>
</div>
<div id="alunos">
</div>
</form>

<form action="<?=$url_base?>/cgi/<?=$mod?>/action/" method="post" id="form_deletar" onsubmit="return valida_deletar();">
<table id="table_botoes">
    <tr>
        <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td id="selectall"><input type="checkbox" name="select_all" id="select_all" onchange="check_all()" />
        <label for="select_all" id="label_select_all">Selecionar / Deselecionar</label>
        </td>
    </tr>
    <tr>
        <td>Buscar <input type="text" name="search_text" id="searchtext" value="<?=$searchText?>" class="inpute medio" /></td>
    </tr>
</table>
<div id="page_contents">
    <noscript>
        Habilite o javascript no seu navegador!
    </noscript>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
    pagination(0);
    });
</script>
			