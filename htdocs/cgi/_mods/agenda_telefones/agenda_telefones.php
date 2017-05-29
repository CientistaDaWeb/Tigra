<?php
class agenda_telefones{
	public $id_agenda_telefone, $nome, $empresa, $tel_res, $tel_com, $tel_cel, $email, $fk_tg_usuario, $status;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'agenda_telefones';
		$campos = '*';
		$condicao = "WHERE id_agenda_telefone = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_agenda_telefone = $id;
		$this->nome = $dados['nome'];
		$this->empresa = $dados['empresa'];
		$this->tel_res = $dados['tel_res'];
		$this->tel_com = $dados['tel_com'];
		$this->tel_cel = $dados['tel_cel'];
		$this->email = $dados['email'];
		$this->status = $dados['status'];
		$this->fk_tg_usuario = $dados['fk_tg_usuario'];
	}
	
	public function __destruct(){
		
	}
}
?>