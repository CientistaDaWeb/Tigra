<?php
class vestibulares {
    public $id_vestibulare, $semestre, $edicao, $ano, $insc_data_inicio, $insc_data_fim, $gabarito, $gabarito_data, $data, $valor_promocional, $data_promocional, $valor, $manual_candidato;

    public function __construct() {
    }

    public function busca($id) {
        $con = new database2();
        $query = 'SELECT * FROM vestibulares WHERE id_vestibulare = '.$id;
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_vestibulare = $id;
        $this->semestre = $dados['semestre'];
        $this->edicao = $dados['edicao'];
        $this->ano = $dados['ano'];
        $this->insc_data_inicio = $dados['insc_data_inicio'];
        $this->insc_data_fim = $dados['insc_data_fim'];
        $this->gabarito = $dados['gabarito'];
        $this->gabarito_data = $dados['gabarito_data'];
        $this->data = $dados['data'];
        $this->valor = $dados['valor'];
        $this->data_promocional = $dados['data_promocional'];
        $this->valor_promocional = $dados['valor_promocional'];
        $this->manual_candidato = $dados['manual_candidato'];
    }

    public function __destruct() {
    }
}