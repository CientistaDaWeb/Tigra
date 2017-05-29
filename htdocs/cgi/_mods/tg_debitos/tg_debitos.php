<?php
class tg_debitos{
	public $id_tg_debito, $id_tg_fornecedore, $data, $valor, $data_pago, $valor_pago, $status, $descritivo;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_debitos';
		$campos = '*';
		$condicao = "WHERE id_tg_debito = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_debito = $id;
		$this->id_tg_fornecedore = $dados['id_tg_fornecedore'];
		$this->data = $dados['data'];
		$this->valor = $dados['valor'];
                $this->data_pago = $dados['data_pago'];
		$this->valor_pago = $dados['valor_pago'];
		$this->status = $dados['status'];
		$this->descritivo = $dados['descritivo'];
	}
	
	public function __destruct(){
		
	}
}
?>