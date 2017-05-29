<?php
extract($_POST);
require_once("_mods/jogos/jogos.php");

$objeto = new jogos();
$objeto->id_jogo = limpadados($id_jogo);
$objeto->placar_casa = limpadados($placar_casa);
$objeto->placar_fora = limpadados($placar_fora);

$query = 'UPDATE apostas SET pontos = 0 WHERE id_jogo = '.$id_jogo;
$con_cliente->query($query);

$query = 'SELECT * FROM jogos WHERE id_jogo = '.$id_jogo;
$jogo = $con_cliente->query($query);
if($jogo && $jogo->num_rows > 0){
    $jogo = $jogo->fetch_assoc();
    if($placar_casa > $placar_fora){
        if($jogo['conferido'] == 1){
            /* Ageita a classificacao do time de casa */
            $query = 'UPDATE classificacoes SET vitorias = (vitorias + 1), gols_pro = (gols_pro + '.$placar_casa.'), gols_contra = (gols_contra + '.$placar_fora.'), pontos = (pontos + 3), jogos = (jogos + 1) WHERE id_time = ' .$jogo['id_time_casa'].' AND id_campeonato = '.$jogo['id_campeonato'];
            $con_cliente->query($query);
            /* Ageita a classificacao do time de fora */
            $query = 'UPDATE classificacoes SET derrotas = (derrotas + 1), gols_contra = (gols_contra + '.$placar_casa.'), gols_pro = (gols_pro + '.$placar_fora.'), jogos = (jogos + 1) WHERE id_time = ' .$jogo['id_time_fora'].' AND id_campeonato = '.$jogo['id_campeonato'];
            $con_cliente->query($query);
        }
        /*  Pontua as apostas que acertaram o andamento do jogo */
        $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa > apostas.placar_fora';
        $con_cliente->query($query);

        /* Pega o número de apostas que jogaram no mesmo placar */
        $query = 'SELECT count(id_jogo) as total FROM apostas WHERE apostas.placar_casa > apostas.placar_fora AND id_jogo = '.$jogo['id_jogo'];
        $acertos = $con_cliente->query($query);
        $acertos = $acertos->fetch_assoc();
    }else{
        if($placar_casa == $placar_fora){
            if($jogo['conferido'] == 1){
                /* Ageita a classificacao dos 2 times */
                $query = 'UPDATE classificacoes SET empates = (empates + 1), gols_pro = (gols_pro + '.$placar_casa.'), gols_contra = (gols_contra + '.$placar_fora.'), pontos = (pontos + 1), jogos = (jogos + 1) WHERE id_time = ' .$jogo['id_time_casa'].' OR id_time = '.$jogo['id_time_fora'].' AND id_campeonato = '.$jogo['id_campeonato'];
                $con_cliente->query($query);
            }
            /* Pontua as apostas que acertaram o andamento do jogo */
            $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa = apostas.placar_fora';
            $con_cliente->query($query);
            /* Pega o número de apostas que jogaram no mesmo placar */
            $query = 'SELECT count(id_jogo) as total FROM apostas WHERE apostas.placar_casa = apostas.placar_fora AND id_jogo = '.$jogo['id_jogo'];
            $acertos = $con_cliente->query($query);
            $acertos = $acertos->fetch_assoc();
        }else{
            if($jogo['conferido'] == 1){
                /* Ageita a classificacao do time de casa */
                $query = 'UPDATE classificacoes SET derrotas = (derrotas + 1), gols_pro = (gols_pro + '.$placar_casa.'), gols_contra = (gols_contra + '.$placar_fora.'), jogos = (jogos + 1) WHERE id_time = ' .$jogo['id_time_casa'].' AND id_campeonato = '.$jogo['id_campeonato'];
                $con_cliente->query($query);
                /* Ageita a classificacao do time de fora */
                $query = 'UPDATE classificacoes SET vitorias = (vitorias + 1), gols_contra = (gols_contra + '.$placar_casa.'), gols_pro = (gols_pro + '.$placar_fora.'), pontos = (pontos + 3), jogos = (jogos + 1) WHERE id_time = ' .$jogo['id_time_fora'].' AND id_campeonato = '.$jogo['id_campeonato'];
                $con_cliente->query($query);
            }
            /*  Pontua as apostas que acertaram o andamento do jogo */
            $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa < apostas.placar_fora';
            $con_cliente->query($query);
            
            /* Pega o número de apostas que jogaram no mesmo placar */
            $query = 'SELECT count(id_jogo) as total FROM apostas WHERE apostas.placar_casa < apostas.placar_fora AND id_jogo = '.$jogo['id_jogo'];
            $acertos = $con_cliente->query($query);
            $acertos = $acertos->fetch_assoc();
        }
    }

    /* Pontua as apostas */
    $query = 'SELECT count(id_jogo) as total FROM apostas WHERE id_jogo = '.$jogo['id_jogo'];
    $totalapostas = $con_cliente->query($query);
    $totalapostas = $totalapostas->fetch_assoc();

    $bonus = 10 - round($acertos['total']/$totalapostas['total']*10);

    /* Pontua as apostas que acertaram em cheio */
    $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + '.$bonus.') WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa = '.$placar_casa.' AND apostas.placar_fora = '.$placar_fora;
    $con_cliente->query($query);

    /* Pontua os que acertaram a diferença no placar */
    $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa - apostas.placar_fora = '.($placar_casa - $placar_fora);
    $con_cliente->query($query);

    /* Pontua os que acertaram o placar de casa */
    $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_casa = '.$placar_casa;
    $con_cliente->query($query);

    /* Pontua os que acertaram o placar de fora */
    $query = 'UPDATE apostas, apostadores SET apostas.pontos = (apostas.pontos + (apostadores.vip*4)) WHERE apostadores.id_apostadore = apostas.id_apostadore AND apostas.id_jogo = '.$jogo['id_jogo'].' AND apostas.placar_fora = '.$placar_fora;
    $con_cliente->query($query);

    /* Marca o jogo como conferido*/
    $query = 'UPDATE jogos SET conferido = 2, placar_casa = '.$placar_casa.', placar_fora = '.$placar_fora.' WHERE id_jogo = '.$jogo['id_jogo'];
    $con_cliente->query($query);
}
$tg_link = "$url_base/cgi/$mod";
?>
<script>
	window.location = '<?=$tg_link?>';
</script>