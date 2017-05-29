<?php
class tg_cat_modulos{
	public $id_tg_cat_modulo, $fk_tg_cliente, $categoria, $icone;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_cat_modulos';
		$campos = '*';
		$condicao = "WHERE id_tg_cat_modulo = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_cat_modulo = $id;
		$this->fk_tg_cliente = $dados['fk_tg_cliente'];
		$this->categoria = $dados['categoria'];
		$this->icone = $dados['icone'];		
	}
	
	public function __destruct(){
		
	}
}
?>