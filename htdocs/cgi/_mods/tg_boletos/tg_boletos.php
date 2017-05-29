<?php
class tg_boletos{
	public $id_tg_boleto, $id_tg_cliente, $data, $valor, $status, $data_vencimento, $descritivo;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_boletos';
		$campos = '*';
		$condicao = "WHERE id_tg_boleto = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_boleto = $id;
		$this->id_tg_cliente = $dados['id_tg_cliente'];
		$this->data = $dados['data'];
		$this->valor = $dados['valor'];
                $this->data_vencimento = $dados['data_vencimento'];
		$this->descritivo = $dados['descritivo'];
	}
	
	public function __destruct(){
		
	}
}
?>