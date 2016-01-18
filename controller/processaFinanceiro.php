<?php

    ob_start();

	@session_start();

	require_once('../model/DB.php'); 	

	require_once('../util/util.php'); 	
	
	require_once('../util/email/config.php');

	

	// salvar 

	//echo "controller: ".$_REQUEST['acao'];			$_REQUEST['p']['saldo'] = str_replace(".","",$_REQUEST['p']['saldo']); 	$_REQUEST['p']['saldo'] = str_replace(",",".",$_REQUEST['p']['saldo']); 
	$_REQUEST['p']['valor'] = str_replace(".","",$_REQUEST['p']['valor']); 	$_REQUEST['p']['valor'] = str_replace(",",".",$_REQUEST['p']['valor']); 		$_REQUEST['p']['data'] = convertDataMysql($_REQUEST['p']['data']);
	if($_REQUEST['acao'] == "Salvar")	
	{
		

		if($_REQUEST['id']){

			DB::atualizar($_REQUEST['objeto'],$_REQUEST['p'],$_REQUEST['id']);	

			$msg = "ATUALIZADO COM SUCESSO";

			if($_FILES['arquivo']['name']){				

				$ext = end(explode(".",$_FILES['arquivo']['name'])); 	

				$id = $_REQUEST['id'];

				$nome = $_REQUEST['objeto']."_".$id.".".$ext;

				$dir = "../view/fotos/".$nome;

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



			if($_REQUEST['objeto2']){

				if($_REQUEST['valor_mestre'] == "")

					$_REQUEST['valor_mestre'] = DB::ultimoId($_REQUEST['objeto']);



				DB::limpaMestreDetalhe($_REQUEST['objeto2'],$_REQUEST['campo_mestre'],$_REQUEST['valor_mestre']);

				$perfis = $_REQUEST['campos'];

				if($perfis)

				foreach($perfis as $pe){

					$per[$_REQUEST['campo_detalhe']] = $pe;

					$per[$_REQUEST['campo_mestre']] = $_REQUEST['valor_mestre'];

					DB::salvar($_REQUEST['objeto2'],$per);
					
					$ci = DB::procurar("adm_curso",$pe);
					$cursos_x .= "Curso: ".$ci['nome']." <br>";

				}

			}

		}

		else{
			if($msg == "") {
				DB::salvar($_REQUEST['objeto'],$_REQUEST['p']);
				$msg = "CADASTRADO COM SUCESSO";
				if($_FILES['arquivo']['name']){				

					$ext = end(explode(".",$_FILES['arquivo']['name'])); 	

					$id = DB::ultimoId($_REQUEST['objeto']);

					$nome = $_REQUEST['objeto']."_".$id.".".$ext;

					$dir = "../view/fotos/".$nome;

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

				

				if($_REQUEST['objeto2']){

					if($_REQUEST['valor_mestre'] == "")

						$_REQUEST['valor_mestre'] = DB::ultimoId($_REQUEST['objeto']);

					

					$perfis = $_REQUEST['campos'];

					if($perfis)

						foreach($perfis as $pe){

							$per[$_REQUEST['campo_detalhe']] = $pe;

							$per[$_REQUEST['campo_mestre']] = $_REQUEST['valor_mestre'];

							DB::salvar($_REQUEST['objeto2'],$per);						

						}

				}
			}

		}

		if($_REQUEST['pagina'])
			 header("location: ../view/".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	
		else
			header("location: ../view/".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);							
	}
	if($_REQUEST['acao'] == "Excluir")	
	{
		if($msg == ""){

			$aa = DB::excluir($_REQUEST['objeto'],$_REQUEST['id']);

			$msg = "EXCLUIDO COM SUCESSO!";

		}

		if($_REQUEST['pagina'])

			header("location: ../view/".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	

		else

			header("location: ../view/cad_".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);	

	}

?>