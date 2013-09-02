
<?php if (!isset($_GET["g"])) { ?>
<div data-role="header" class="header">                     
    <h1>VideoLocadora</h1>
    <div data-role="navbar">
        <ul>                        
            <li><a href="?p=acervo" class="ui-btn-active ui-state-persist">Acervo</a></li>
            <li><a href="?p=historico">Histórico</a></li>
            <li><a href="?p=renovacao">Renovação</a></li>
        </ul>
    </div>          
</div>

<div data-role="content" class="content_div">
    <h1>Gênero</h1>            
    <ul data-role="listview" data-inset="true" data-filter="true">
        <?php
            $sql = "select * from genero order by nome";
            $result = mysql_query($sql);
            while ($genero = mysql_fetch_object($result)) {
                echo utf8_encode("<li><a href='?p=acervo&g=$genero->gencodigo'>$genero->nome</a></li>");
            }
        //<li><a href="?p=acervo&g=1">Ação</a></li>
        ?>
    </ul>
<?php } else {  ?>
<div data-role="header" class="header">
    <a href="#" data-icon="back" data-rel="back">Voltar</a>
    <h1>VideoLocadora</h1>
    <div data-role="navbar">
        <ul>                        
            <li><a href="?p=acervo" class="ui-btn-active ui-state-persist">Acervo</a></li>
            <li><a href="?p=historico">Histórico</a></li>
            <li><a href="?p=renovacao">Renovação</a></li>
        </ul>
    </div>
    <a href="#" data-icon="check" onclick="$('#reservar').submit()">Reservar</a>
    
</div>
<div data-role="content" class="content_div">
    <div data-role="collapsible-set">

        <form action="?p=reservar" method="POST" id="reservar">
            <input type="hidden" id="genero" name="genero" value="<?= $_GET['g'] ?>" />
            <?php
            $sql = "select * from midia where genero_codigo = ". $_GET['g'] . " order by titulo";
            $result = mysql_query($sql);
            while ($midia = mysql_fetch_object($result)) {
                echo utf8_encode("
                    <div data-role='collapsible'>                                             
                        <h3>
                            <input type='checkbox' name='filmes[]' id='$midia->midcodigo' value='$midia->midcodigo'>  
                            <label for='$midia->midcodigo'>$midia->titulo</label>
                        </h3>
                        <p>
                            <img />
                            $midia->descricao
                        </p>
                    </div>
                    ");
            }
            ?>
        </form>        
    </div>                                       
</div>
<!--<div data-role="footer" data-position="fixed">
  <a href="#" data-icon="back" data-rel="back">Voltar</a>-->
<?php } ?>