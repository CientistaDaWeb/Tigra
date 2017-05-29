<?php
class opcoes_caracteristicas{
	public $id_opcoes_caracteristica, $id_caracteristicas_categoria, $opcao, $opc;
	
	public function __construct(){}
	public function busca($id){
		$tabela = "opcoes_caracteristicas";
		$campos = "*";
		$condicao = "WHERE id_opcoes_caracteristica = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
        $this->id_opcoes_caracteristica = $id;
		$this->id_caracteristicas_categoria = $dados['id_caracteristicas_categoria'];
		$this->opcao = $dados['opcao'];
        $this->opc = $dados['opc'];
	}
	
	public function __destruct(){}
}
?>