<?php
class vestibulares_boletos {
    public $id_vestibulares_boleto, $id_vestibulares_inscricoe, $num_doc, $preco, $pago, $nossonumero;
    public function __construct() {

    }

    public function busca($id) {
        $tabela = 'vestibulares_boletos';
        $campos = '*';
        $condicao = "WHERE id_vestibulares_boleto = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_vestibulares_boleto = $id;
        $this->id_vestibulares_inscricoe = $dados['id_vestibulares_inscricoe'];
        $this->num_doc = $dados['num_doc'];
        $this->preco = $dados['preco'];
        $this->pago = $dados['pago'];
        $this->nossonumero = $dados['nossonumero'];
    }

    public function __destruct() {

    }
}