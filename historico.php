<div data-role="header" class="header">
    <h1>VideoLocadora</h1>
    <div data-role="navbar">
        <ul>                        
            <li><a href="?p=acervo">Acervo</a></li>
            <li><a href="?p=historico" class="ui-btn-active ui-state-persist">Histórico</a></li>
            <li><a href="?p=renovacao">Renovação</a></li>
        </ul>
    </div>
</div>

<div data-role="content" class="content_div">
    <ul data-role="listview" data-inset="true">
    <?php
    $sql = "SELECT 
              *
            from locacao
            join funcionario
            on funcionario.funcodigo  = locacao.funcodigo
            where clicodigo = ". $_SESSION['usuario'] ."
            order by datalocacao desc";
    $result = mysql_query($sql);
    while ($locacao = mysql_fetch_object($result)) {
        $sql2 = "SELECT 
                  *
                 from locacao_midia
                 join midia
                   on midia.midcodigo = locacao_midia.midcodigo
                 where loccodigo = $locacao->loccodigo
                 order by locacao_midia.midcodigo desc";
        $result2 = mysql_query($sql2);
        while ($locacao_midia = mysql_fetch_object($result2)) {
            (empty($midiaslocadas)) ? $midiaslocadas = "": $midiaslocadas .= ", ";
            $midiaslocadas .= $locacao_midia->titulo;
        }
        if ($locacao->situacao == 0) {
            $devolvido = "Em Aberto" ;
        } else {
            $devolvido = $locacao->datadevolvido;
        }
        echo utf8_encode("
            <li>
                <h3>Dia: $locacao->datalocacao</h3>
                <p>Responsavel: $locacao->nome</p>
                <p>Devolvido: $devolvido</p>
                <p>Titulos Locados: $midiaslocadas </p>
                <!--<p class='ui-li-aside'><strong>8:24h</strong></p>-->
            </li>");
    }
    ?>
    </ul>    