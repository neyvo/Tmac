<?php
	
    ob_start();
	@session_start();

	require_once('../model/DB.php'); 	

	if($_REQUEST['acao'] == "Salvar")	
	{
				$_REQUEST['objeto'] = "foto";
				$_REQUEST['p']['visivel'] = "B";
				
				DB::salvar($_REQUEST['objeto'],$_REQUEST['p']);
				
				$msg = "CADASTRADO COM SUCESSO";
				
				if($_REQUEST['p']['tipo'] == "Foto"){
					if($_FILES['arquivo']){				
						$ext = end(explode(".",$_FILES['arquivo']['name'])); 	
						$id = DB::ultimoId($_REQUEST['objeto']);
						$nome = $_REQUEST['objeto']."_".$id.".".$ext;
						$dir = "../style/fotos/".$nome;
						if(is_uploaded_file($_FILES['arquivo']['tmp_name'])){
							if((move_uploaded_file($_FILES['arquivo']['tmp_name'],$dir))){
								$pp['foto'] = $nome;
								DB::atualizar($_REQUEST['objeto'],$pp,$id);					
							}
							else					
								$msg = "ERRO NO ENVIO DO ARQUIVO!";
						}else{
							$msg = "ARQUIVO INVALIDO!";
						}					
					}
				}
				
			
		
		
		
		header("location: ../".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	
		
			
			
	}
	
	if($_REQUEST['acao'] == "Excluir")	
	{
		$_REQUEST['objeto'] = "foto";
		unlink("../style/fotos/".$_REQUEST['a']);
		$aa = DB::excluir($_REQUEST['objeto'],$_REQUEST['id']);
		$msg = "EXCLUIDO COM SUCESSO!";
		header("location: ../".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	
	}	
	
	// #####################################################################################
	// Definir Logo
	// #####################################################################################
	
	if($_REQUEST['acao'] == "LOGO")	
	{
		$_REQUEST['p']['foto'] = $_REQUEST['f'];
		DB::atualizar("empresa",$_REQUEST['p'],$_REQUEST['id']);	
		$msg = "LOGO DEFINIDA";

		header("location: ../meuperfil.php?msg=".$msg);	
	}

		
		
?>