<?php
class informativos{
	public $id_informativo, $nome, $mes, $ano, $descricao, $arquivo, $slug;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'informativos';
		$campos = '*';
		$condicao = "WHERE id_informativo = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_informativo = $id;
        $this->nome = $dados['nome'];
		$this->mes = $dados['mes'];
        $this->ano = $dados['ano'];
		$this->descricao = $dados['descricao'];
		$this->arquivo = $dados['arquivo'];
        $this->slug = $dados['slug'];
	}
	
	public function __destruct(){
		
	}
}
?>