<?php
  ob_start();
  @session_start();
	require_once('../model/DB.php');
	require_once('../util/util.php');


	// verificar login	
	$p['usuario']['valor'] = $_POST['email'];
	$p['usuario']['tipo']  = "=";
	$p['senha']['valor'] = $_POST['senha'];
	$p['senha']['tipo']  = "=";
			
	$aza = DB::listar("usuario",$p," order by id");
	
	$dados = $aza[0];
	
	//echo $_POST['login'];
	
	
// verificando se encontrou registros do login e senha no banco de dados.
if ($dados) { 
    
	
	if ($dados['situacao']!='A') {
	   echo "<SCRIPT LANGUAGE='JAVASCRIPT'>";
	   echo "alert('Sua conta esta inativa. Favor entrar em contato com o Administrador do Sistema');";
	   echo "window.location.replace('../login_meuperfil.php');";
	   echo "</SCRIPT>";
	} else {
	
	// registrando a session.
		$_SESSION['id_usuario'] = $dados["id"];
		$_SESSION['nome'] = $dados["nome"];
		$_SESSION['login'] = $dados["login"];
		$_SESSION['email'] = $dados["usuario"];
		$_SESSION['perfil'] = $dados['perfil'];
		$_SESSION['id_empresa'] = $dados['id_empresa'];
		
		header("location:../meuperfil.php");
				
	}
} else { 
	header("location:../login_meuperfil.php?erro=1".$p['usuario']['valor'].$p['senha']['valor']);

}

?>