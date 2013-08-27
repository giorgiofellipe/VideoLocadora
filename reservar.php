<div data-role="header" class="header">
    <a href="#" data-icon="back" data-rel="back" id="voltar" name="voltar">Voltar</a>
    <h1>VideoLocadora</h1>
    <div data-role="navbar">
        <ul>                        
            <li><a href="?p=acervo" class="ui-btn-active ui-state-persist">Acervo</a></li>
            <li><a href="?p=historico">Histórico</a></li>
            <li><a href="?p=renovacao">Renovação</a></li>
        </ul>
    </div>
    <a href="#" data-icon="check" onclick="$('#reservar').submit()">Confirmar</a>
    
</div>
<div data-role="content" class="content_div">
    <?php if (isset($_POST['date'])) {
              $insert = "insert into reserva (
                            datareserva,
                            clicodigo) 
                         values ('".
                            $_POST['date']."',".
                            $_SESSION['usuario'].")";
              if (!mysql_query($insert)) { 
                  echo mysql_error();
              }
              $id = mysql_insert_id();
              $aFilmes = explode(",",$_POST['resfilmes']);
              foreach($aFilmes as $value) {
                  if ($value != 0) {
                      $insert = "insert into reserva_midia (
                                      rescodigo,
                                      midcodigo) 
                                  values (". 
                                      $id .",".
                                      $value.")";
                     if (!mysql_query($insert)) { 
                        echo mysql_error();
                     }
                  }
              }
              echo "<p>Reserva efetuada com sucesso, retire seus filmes no dia reservado!</p>";
          } else if (isset($_POST['filmes'])) { 
                $filmes = "0";
                foreach ($_POST['filmes'] as $value) {
                    $filmes .= ", " . $value;
                } ?>
    <form action="#" method="POST" id="reservar">
        <input type="hidden" name="resfilmes" id="resfilmes" value="<?= $filmes ?>"/>
    <ul data-role="listview">
        <li data-role="list-divider">Confirma reserva?</li>
        <li data-role="list-divider">Data</li>
            <input type="date" name="date" id="date" value="" class="ui-input-text ui-body-c" value="">
        <li data-role="list-divider">Filmes</li>
        <?php 
            
            $sql = "SELECT 
                      *
                    from midia
                    where midcodigo in ($filmes)
                    order by titulo";
            $result = mysql_query($sql);
            while ($midia = mysql_fetch_object($result)) {
                echo utf8_encode("<li>$midia->titulo</li>");
            }
        ?>
    </ul>
    </form>
    <?php } else { 
             echo "<p>Nenhum filme foi selecionado.</p>";
          }
    ?>
</div>