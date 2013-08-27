<?php 
    include_once("conexao.php");
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['usuario'] = 3;
    
    function nova_data($data){
        $data = explode(" ", $data);
        $data = explode("-", $data[0]);
        $data[2]=$data[2]+3;
        $nova_data = $data[2].'/'.$data[1].'/'.$data[0];
        return $nova_data;
    }
    function formatar_data($data){
        $data = explode(" ", $data);
        $data = explode("-", $data[0]);
        $nova_data = $data[2].'/'.$data[1].'/'.$data[0];
        return $nova_data;
    }
    
?>
<!DOCTYPE html> 
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>VideoLocadora</title> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>

</head>
<body>  
<div data-role="page">

    <?php
        if (!isset($_GET["p"]) || empty($_GET["p"])) {
            include_once("acervo.php"); 
        } else {
            include_once($_GET["p"].".php"); 
        }
    ?>
	
	</div>                                               
	
	<!--<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="professores.html">Professores</a></li>
				<li><a href="seletivo.html">Seletivo</a></li>
				<li><a href="contato.html">Contato</a></li>
			</ul>
		</div>
	</div>  -->
</div>        
</body>
</html>
