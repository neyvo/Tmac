<?php

    ob_start();
	@session_start();
	require_once('../model/DB.php'); 	
	require_once('../util/util.php'); 	


	// salvar 
	//echo "controller: ".$_REQUEST['acao'];
	
			$pe['excluido'] = "*";
			
			DB::atualizar($_REQUEST['obj'],$pe,$_REQUEST['id']);	
			
			$msg = "EXCLUIDO COM SUCESSO";

		if($_REQUEST['pag'])

			header("location: ../pages/".$_REQUEST['pag'].".php?msg=".$msg."&".$_REQUEST['retorno']);	
		else

			header("location: ../pages/".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);	

?>