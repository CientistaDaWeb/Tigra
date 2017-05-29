<?php
class fac_vestibulares{
	public $id_fac_vestibulare, $semestre, $ano, $imagem, $insc_data_inicio, $insc_data_fim, $divulgacao_data_inicio, $divulgacao_data_fim, $gabarito, $gabarito_data_inicio, $gabarito_data_fim, $data;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'fac_vestibulares';
		$campos = '*';
		$condicao = "WHERE id_fac_vestibulare = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_fac_vestibulare = $id;
		$this->semestre = $dados['semestre'];
		$this->ano = $dados['ano'];
		$this->imagem = $dados['imagem'];
        $this->divulgacao_data_inicio = $dados['divulgacao_data_inicio'];
        $this->divulgacao_data_fim = $dados['divulgacao_data_fim'];
        $this->insc_data_inicio = $dados['insc_data_inicio'];
        $this->insc_data_fim = $dados['insc_data_fim'];
        $this->gabarito = $dados['gabarito'];
        $this->gabarito_data_inicio = $dados['gabarito_data_inicio'];
        $this->gabarito_data_fim = $dados['gabarito_data_fim'];
        $this->data = $dados['data'];
	}
	
	public function __destruct(){
		
	}
}
?>