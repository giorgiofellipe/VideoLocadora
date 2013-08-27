<div data-role="header" class="header">
    <a href="#" data-icon="back" data-rel="back">Voltar</a>
    <h1>VideoLocadora</h1>
    <div data-role="navbar">
        <ul>            
            <li><a href="?p=acervo">Acervo</a></li>
            <li><a href="?p=historico">Histórico</a></li>
            <li><a href="?p=renovacao" class="ui-btn-active ui-state-persist">Renovação</a></li>
        </ul>
    </div>
    <a data-icon="check" onclick="$('#renovar').submit()">Renovar</a>
</div>
<div data-role="content" class="content_div">
    <form name="renovar" id="renovar" method="POST" action="#">
        <?php
        
        if(isset($_POST['filme'])){
            $update = ($_POST['filme']);
            foreach ($update as $valor){
                $auxiliar = explode(",",$valor);
                $data = explode("/",$auxiliar[1]);
                $data[2] = substr($data[2], 2);
                $data = $data[2].$data[1].$data[0];
                $sql = "update locacao_midia set datadevolucao = {$data}, situacao = 2
                    where locacao_midia.midcodigo = $auxiliar[0]";
                mysql_query($sql);
            }
        }
        $sql = "select * from locacao_midia 
                join midia on midia.midcodigo = locacao_midia.midcodigo
            where locacao_midia.situacao = 0";
            $result = mysql_query($sql);
            while ($renovacao = mysql_fetch_object($result)){
        ?>
        <ul data-role="listview" data-inset="true">
            <div data-role="collapsible"> 
                <h3>
                    <input type="checkbox" name="filme[]" id="<?=$renovacao->midcodigo?>" value="<?=$renovacao->midcodigo.",".nova_data($renovacao->datadevolucao)?>">  
                    <label for="<?=$renovacao->midcodigo?>"><?=$renovacao->titulo;?><p class="ui-li-aside"><strong><?=formatar_data($renovacao->datadevolucao)?></strong></p></label>
                </h3>
                <p>Nova Data de devolucao: <strong><?=nova_data($renovacao->datadevolucao)?></strong></p>
            </div>
        </ul>
        <?php
        }
        ?>
    </form>
</div>