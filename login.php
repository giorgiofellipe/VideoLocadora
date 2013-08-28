<?php 
    include_once("conexao.php");
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once("conexao.php");
?>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>VideoLocadora</title> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head> 

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