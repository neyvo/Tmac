<?php
	
	ob_start();
	@session_start();

	require_once('../model/DB.php'); 	
	require_once('../util/util.php'); 	
	require_once('../util/email/config.php');
	
	// ============================================================
	// Enviar e-mail pedido pentente
	
	if($_REQUEST['acao'] == "SENHA")	
	{
		
		
		$senha = DB::procurarPeloCampo("adm_cadastro","cpf",$_REQUEST['cpf']);
		
		$msg = "<table border='1'>
    <tr>
      <th>NOME</th><td>".$senha['nome']."</td>
	</tr>  
    <tr>
      <th>CPF</th><td>".$senha['cpf']."</td>
	</tr>  
    <tr>
      <th>SENHA</th><td>".$senha['senha']."</td>
	</tr>
	</table>
	PJA BRASIL - www.pjabrasil.com.br
	";

	
	if($senha['email']){
		sendMail("PJA BRASIL - ESQUECI A SENHA",$msg, "contato@pjabrasil.com.br","contato", $senha['email'], $senha['nome']);			
	} else{	
		$erro = "?erro=NAO ENCONTRADO";
	}
	
	header("location: ../sucesso_esqueci.php".$erro);	
		
	}
	
	
	
?>