<?php
class anotacoes{
	public $id_anotacoe, $titulo, $texto, $data, $fk_tg_usuario;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'anotacoes';
		$campos = '*';
		$condicao = "WHERE id_anotacoe = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_anotacoe = $id;
		$this->titulo = $dados['titulo'];
		$this->texto = $dados['texto'];
		$this->data = $dados['data'];
	}
	
	public function __destruct(){
		
	}
}
?>