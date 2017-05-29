<?php 
class vestibulares_inscricoes {
    public $id_vestibulares_inscricoe, $id_vestibulare,	$nome, $sexo, $nascimento, $cpf, $rg, $orgaoExp, $dataEmissao, $endereco, $numero, $complemento, $bairro, $cep, $cidade, $uf, $foneRes, $foneCom, $cel, $email, $curso1, $curso2, $curso3, $curso4, $curso5, $curso6, $deficiencia, $qualDef, $enem, $enemInsc, $enemAno, $idade, $estadoCivil, $naturalidade, $nacionalidade, $nomeMae, $tipoEm, $preVest, $qtsVest, $curSup, $curS, $sit, $fator, $renda, $atividade, $lang, $langS, $prof, $empresaTab, $comoSoube, $csQual, $data_cadastro;

    public function __construct() {

    }
    public function busca($id) {
        $query = 'SELECT * FROM vestibulares_inscricoes WHERE id_vestibulares_inscricoe = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        if($rs && $rs->num_rows > 0) {
            $dados = mysqli_fetch_assoc($rs);
            $this->id_vestibulares_inscricoe = $id;
            $this->id_vestibulare = $dados['id_vestibulare'];
            $this->nome = $dados['nome'];
            $this->sexo = $dados['sexo'];
            $this->nascimento = $dados['nascimento'];
            $this->cpf = $dados['cpf'];
            $this->rg = $dados['rg'];
            $this->orgaoExp = $dados['orgaoExp'];
            $this->dataEmissao = $dados['dataEmissao'];
            $this->endereco = $dados['endereco'];
            $this->numero = $dados['numero'];
            $this->complemento = $dados['complemento'];
            $this->bairro = $dados['bairro'];
            $this->cep = $dados['cep'];
            $this->cidade = $dados['cidade'];
            $this->uf = $dados['uf'];
            $this->foneRes = $dados['foneRes'];
            $this->foneCom = $dados['foneCom'];
            $this->cel = $dados['cel'];
            $this->email = $dados['email'];
            $this->curso1 = $dados['curso1'];
            $this->curso2 = $dados['curso2'];
            $this->curso3 = $dados['curso3'];
            $this->curso4 = $dados['curso4'];
            $this->curso5 = $dados['curso5'];
            $this->curso6 = $dados['curso6'];
            $this->deficiencia = $dados['deficiencia'];
            $this->qualDef = $dados['qualDef'];
            $this->enem = $dados['enem'];
            $this->enemInsc = $dados['enemInsc'];
            $this->enemAno = $dados['enemAno'];
            $this->idade = $dados['idade'];
            $this->estadoCivil = $dados['estadoCivil'];
            $this->naturalidade = $dados['naturalidade'];
            $this->nacionalidade = $dados['nacionalidade'];
            $this->nomeMae = $dados['nomeMae'];
            $this->tipoEm = $dados['tipoEm'];
            $this->preVest = $dados['preVest'];
            $this->qtsVest = $dados['qtsVest'];
            $this->curSup = $dados['curSup'];
            $this->curS = $dados['curs'];
            $this->sit = $dados['sit'];
            $this->fator = $dados['fator'];
            $this->renda = $dados['renda'];
            $this->atividade = $dados['atividade'];
            $this->lang = $dados['lang'];
            $this->langS = $dados['langS'];
            $this->prof = $dados['prof'];
            $this->empresaTab = $dados['empresaTab'];
            $this->comoSoube = $dados['comoSoube'];
            $this->csQual = $dados['csQual'];
            $this->data_cadastro = $dados['data_cadastro'];
        }
    }
    public function __destruct() {

    }
}