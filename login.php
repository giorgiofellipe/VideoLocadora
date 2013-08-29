<?php 
    $usuarioValido = false;
    if (isset($_GET['logout']) &&
        !((isset($_POST['codigo']) && isset($_POST['senha'])) && 
          (!empty($_POST['codigo']) && !empty($_POST['senha'])))) {
        session_destroy();
    }
    if ((isset($_POST['codigo']) && isset($_POST['senha'])) && 
        (!empty($_POST['codigo']) && !empty($_POST['senha']))) {
        $sql = "select exists(
                    select 1 
                    from cliente
                    where clicodigo = ". $_POST['codigo'] ."
                    and senha = md5('". $_POST['senha'] ."')
                ) as usuario";
        $result = mysql_query($sql);
        $usuario = mysql_fetch_object($result);  
        if ($usuario->usuario) {
            $usuarioValido = true;
        }
    } else if (isset($_POST['user'])){ 
        echo "
            <div class='alert alert-danger'>
                <strong>Atenção!</strong> Todos os campos devem ser preenchidos.
            </div>";
    }
    if ($usuarioValido)  {
        $_SESSION['usuario'] = $_POST['codigo'];
        include_once('acervo.php');
    } else {
?>
<div data-role="header" class="header">                     
    <h1>VideoLocadora</h1>       
</div>

<div data-role="content" class="content_div">
    <h1>Login</h1>
    <form name="login" id="login" method="POST" action="#">
        <label>Código Usuário</label>
        <input type="text" data-clear-btn="false" name="codigo" id="codigo" value="" autocomplete="off">
        <label>Senha</label>
        <input type="password" data-clear-btn="true" name="senha" id="senha" value="" autocomplete="off">
        <br>
        <input type="submit" value="Entrar">
    </form>
</div>
<?php } ?>