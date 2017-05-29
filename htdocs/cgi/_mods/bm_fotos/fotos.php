<?php
class fotos{
	public $id_foto, $legenda, $imagem;
	
	public function __construct(){}	
	public function busca($id){
		$tabela = "fotos";
		$campos = "*";
		$condicao = "WHERE id_foto = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_foto = $id;
		$this->legenda = $dados['legenda'];
                $this->imagem = $dados['imagem'];
	}
	public function __destruct(){}
}
?>