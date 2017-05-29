<?php
class eventos_fotos{
	public $id_eventos_foto, $fk_evento, $legenda, $foto;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'eventos_fotos';
		$campos = '*';
		$condicao = "WHERE id_eventos_foto = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_eventos_foto = $id;
		$this->fk_evento = $dados['fk_evento'];
		$this->legenda = $dados['legenda'];
		$this->foto = $dados['foto'];
	}
	
	public function __destruct(){
		
	}
}
?>