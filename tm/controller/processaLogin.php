<?php
  ob_start();
  @session_start();

	require_once('../model/DB.php');
	require_once('../util/util.php');


	// verificar login	

	$p['email']['valor'] = $_POST['email'];
	$p['email']['tipo']  = "=";
	$p['senha']['valor'] = $_POST['senha'];
	$p['senha']['tipo']  = "=";

	$aza = DB::listar("atleta",$p,"order by id");

	$dados = $aza[0];

	//echo $_POST['login'];

// verificando se encontrou registros do login e senha no banco de dados.



if ($dados) { 


	if ($dados['ativo']!='S') {

	   echo "<SCRIPT LANGUAGE='JAVASCRIPT'>";
	   echo "alert('Sua conta esta inativa. Favor entrar em contato com o Administrador do Sistema');";
	   echo "window.location.replace('../pages/login.php');";
	   echo "</SCRIPT>";

	} else {

	// registrando a session.

		$_SESSION['id_usuario'] = $dados["id"];
		$_SESSION['nome_usuario'] = $dados["nome"];
		$_SESSION['cpf'] = $dados["cpf"];
		$_SESSION['email'] = $dados["email"];
		$_SESSION['perfil'] = $dados['perfil'];
                $_SESSION['foto'] = $dados['foto'];
                $_SESSION['email'] = $dados['email'];
                $_SESSION['telefone'] = $dados['telefone'];
                


                
		if($dados['perfil'] == "ADMINISTRADOR"){
			header("location:../pages/index.php");
		}
		else{	
			header("location:../pages/index.php");
		}
	}

} else { 
	header("location:../pages/login.php?erro=1");
}

?>