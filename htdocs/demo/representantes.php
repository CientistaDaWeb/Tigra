<?php
$estados[] = 'RS';
$estados[] = 'SP';
$estados[] = 'SC';
$estados[] = 'PR';
$estados[] = 'RJ';
$estados[] = 'ES';
$estados[] = 'AM';
$estados[] = 'AC';
$estados[] = 'DF';
$estado = $baseURL[3];
?>
<script type="text/javascript">
    var flashvars = {
        activeState : '<?php echo $estado; ?>',
        lkn : '/demo/representantes/',
        states: '<?php echo implode(',',$estados); ?>'
    };
    var params = {};
    var attributes = {};

    params.menu = "false";
    params.wmode = "transparent";

    swfobject.embedSWF("http://ween.com.br/_swf/mapa.swf", "representantes", "350", "350", "6.0.0", "http://ween.com.br/_swf/expressInstall.swf", flashvars, params, attributes);
</script>
<h3>Selecione o estado que deseja consultar os representantes:</h3>
<div id="representantes">
    Se o mapa não aparecer, deve haver algum problema com o seu navegador!
</div>