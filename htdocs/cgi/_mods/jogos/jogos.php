<?php
class jogos{
 var $id_jogo, $id_time_casa, $id_time_fora, $placar_fora, $placar_casa, $data, $hora, $estadio, $rodada;

    public function __construct(){
    }
	
	public function busca($id){
		$tabela = 'jogos';
		$campos = '*';
		$condicao = "WHERE id_jogo = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_jogo = $id;
		$this->id_time_casa = $dados['id_time_casa'];
		$this->id_time_fora = $dados['id_time_fora'];
		$this->placar_casa = $dados['placar_casa'];
        $this->placar_fora = $dados['placar_fora'];
        $this->data = $dados['data'];
		$this->hora = $dados['hora'];
        $this->estadio = $dados['estadio'];
		$this->rodada = $dados['rodada'];
	}
	
	public function __destruct(){
		
	}
}
?>