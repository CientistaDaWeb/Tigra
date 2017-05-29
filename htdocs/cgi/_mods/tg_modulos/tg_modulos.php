<?php
class tg_modulos{
	public $id_tg_modulo, $modulo, $pasta, $icone, $titulo, $descricao, $tooltip_msg, $sql_tabela, $mensalidade;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_modulos';
		$campos = '*';
		$condicao = "WHERE id_tg_modulo = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_modulo = $id;
		$this->modulo = $dados['modulo'];
		$this->pasta = $dados['pasta'];
		$this->icone = $dados['icone'];
		$this->titulo = $dados['titulo'];
		$this->descricao = $dados['descricao'];
		$this->tooltip_msg = $dados['tooltip_msg'];
		$this->sql_tabela = $dados['sql_tabela'];
		$this->mensalidade = $dados['mensalidade'];
	}
	
	public function __destruct(){
		
	}
}
?>