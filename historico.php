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
            order by datalocacao desc
            limit 5";
    $result = mysql_query($sql);
    while ($locacao = mysql_fetch_object($result)) {
        $sql2 = "SELECT 
                  *
                 from locacao_midia
                 join midia
                   on midia.midcodigo = locacao_midia.midcodigo
                 where loccodigo = $locacao->loccodigo
                 order by titulo";
        $result2 = mysql_query($sql2);
        while ($locacao_midia = mysql_fetch_object($result2)) {
            (empty($midiaslocadas)) ? $midiaslocadas = "": $midiaslocadas .= ", <br />";
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
                <p><strong>Responsavel:</strong> $locacao->nome</p>
                <p><strong>Devolvido:</strong> $devolvido</p>
                <p><strong>Titulos Locados:</strong> <br /> $midiaslocadas </p>
                <!--<p class='ui-li-aside'><strong>8:24h</strong></p>-->
            </li>");
    }
    ?>
    </ul>
</div>
<div data-role="content" class="content_div">
    <ul data-role="listview" data-inset="true">
        <?php
        $sql3 = "SELECT 
                   * 
                 from reserva 
                 where reserva.clicodigo =" .$_SESSION['usuario'] .
               " order by datareserva desc
                 limit 3";
        $result3 = mysql_query($sql3);
        while ($reserva = mysql_fetch_object($result3)){
            $sql4 = "SELECT 
                       * 
                     from reserva_midia
                     join midia
                       on midia.midcodigo = reserva_midia.midcodigo
                     where reserva_midia.rescodigo = $reserva->rescodigo
                     order by titulo ";
            $result4 = mysql_query($sql4);
            while ($reserva_midia = mysql_fetch_object($result4)){
                (empty($midiasReservadas)) ? $midiasReservadas = "": $midiasReservadas .= ", <br />";
                $midiasReservadas .= utf8_encode($reserva_midia->titulo);
            }
            echo "<li>
                    <h3>Dia: ".formatar_data($reserva->datareserva)."</h3>
                    <p><strong>Titulo(s) Reservado(s):</strong> <br /> $midiasReservadas</p>
                  </li>";
        }
        ?>
    </ul>
</div>