<script type="text/javascript" src="<?=$url_base?>/cgi/_js/validator.js"> </script>
<div id="tit_mod"><img src="<?=$url_base?>/_img/modulos/titulos/contato.jpg" /></div>
<p>Formas de entrar em contato com a Ween Web Solutions:</p>
<p>Pelos fones: (54) 3055-3125 ou (54) 3055-3126.</p>
<p>Pelo e-mail: <a href="mailto:ween@ween.com.br">ween@ween.com.br</a>.</p>
<p>Preenchendo o formulário abaixo.</p>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
<table width="100%">
	<tr>
    	<td class="tit_campo">Tipo de Contato</td>
    </tr>
    <tr>
    	<td><select name="tipo_contato" id="tipo_contato" class="inpute medio">
                <option value="Dúvida">Dúvida</option>
                <option value="Elogio">Elogio</option>
                <option value="Reclamação">Reclamação</option>
                <option value="Sugestão">Sugestão</option>
			</select>
        </td>
    </tr>
	<tr>
    	<td class="tit_campo">Assunto:</td>
    </tr>
    <tr>
    	<td><input type="text" name="assunto" id="assunto" class="inpute gde obrigatorio" title="Assunto"></td>
    </tr>
    <tr>
    	<td class="tit_campo">Mensagem:</td>
    </tr>
    <tr>
    	<td><textarea name="msg" rows="7" class="inpute gde" id="msg" title="Mensagem"></textarea></td>
    </tr>
    <tr>
    	<td><input type="submit" id="bt_enviar" value="Enviar"></td>
    </tr>
</table>
</form>