<?php



    ob_start();



	@session_start();



	require_once('../model/DB.php'); 	



	require_once('../util/util.php'); 	

	

	require_once('../util/email/config.php');



	



	// salvar 



	//echo "controller: ".$_REQUEST['acao'];
	
	
	$_REQUEST['p']['salario'] = str_replace(".","",$_REQUEST['p']['salario']); 
	$_REQUEST['p']['salario'] = str_replace(",",".",$_REQUEST['p']['salario']); 
	
	
	$_REQUEST['p']['data_admissao'] = convertDataMysql($_REQUEST['p']['data_admissao']);



	if($_REQUEST['acao'] == "Salvar")	



	{



		


		if($_REQUEST['id']){



			if($_REQUEST['objeto'] == "calculosbrasil" ){
			
			DB::atualizarPeloCampo($_REQUEST['objeto'],$_REQUEST['p'],"id_usuario",$_REQUEST['id']);	
			
			}
			else {
			
			DB::atualizar($_REQUEST['objeto'],$_REQUEST['p'],$_REQUEST['id']);	
			
			}
			
			



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


	//#####################################################################################################################################
	// GRAVA UM NOVO REGISTRO
	//#####################################################################################################################################
			

			if($_REQUEST['objeto'] == "erp_empresa")
			$_REQUEST['p']['id_pessoa'] = $_SESSION['id_pessoa'];

			
			
			if($_REQUEST['objeto'] == "erp_pessoa"){



				$pe['email']['valor'] = $_POST['p']['email'];



				$pe['email']['tipo']  = "=";



				$aza = DB::listar("erp_pessoa",$pe," order by id");



				$dados = $aza[0];



				



				



				if($dados){



					$msg = "EMAIL JA CADASTRADO";



				}



			}



			// Verifica CPF



			if($_REQUEST['objeto'] == "erp_pessoa"){



				$pe['cpf']['valor'] = $_POST['p']['cpf'];



				$pe['cpf']['tipo']  = "=";



				$aza = DB::listar("erp_pessoa",$pe," order by id");



				$dados = $aza[0];


				if($dados){



					$msg = "CPF JA CADASTRADO";



					$_REQUEST['pagina'] = "novo_cadastro";



				}



			}



			if($msg == "") {


				$msg = DB::salvar($_REQUEST['objeto'],$_REQUEST['p']);
				
				

				//$msg = " CADASTRADO COM SUCESSO";



				



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



				



				if($_REQUEST['objeto'] == "curriculo"){



					$_SESSION['id_curriculo'] = DB::ultimoId("curriculo");



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



		// excluir - $tabela - $id



		if($_REQUEST['objeto'] == 'usuario'){



			DB::limpaUsuarioPerfil($_REQUEST['id']);	



		}



		



		//verifica se existe projetos relacionados ao edital, mantendo integridade do banco



		if($_REQUEST["objeto"]=="curriculo"){



			DB::limpaMestreDetalhe("idioma", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("experiencia", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("qualificacao", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("curso", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("complemento", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("formacao", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("curriculo_habilidade", "id_curriculo", $_REQUEST['id']);



			DB::limpaMestreDetalhe("curriculo_objetivo", "id_curriculo", $_REQUEST['id']);			



		}



		



		



		if($msg == ""){



			$aa = DB::excluir($_REQUEST['objeto'],$_REQUEST['id']);



			$msg = "EXCLUIDO COM SUCESSO!";



		}



		if($_REQUEST['pagina'])



			header("location: ../view/".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	



		else



			header("location: ../view/cad_".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);	



	}



	



	// #####################################################################################



	// Autorizar Fotos



	// #####################################################################################



	



	if($_REQUEST['acao'] == "AF")	



	{



	



		$_REQUEST['p']['visivel'] = "A";



		DB::atualizar($_REQUEST['objeto'],$_REQUEST['p'],$_REQUEST['id']);	







		if($_REQUEST['pagina'])



			header("location: ../view/".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	



		else



			header("location: ../view/cad_".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);	



	}



	







	



		



		if($_REQUEST['acao'] == "esqueci_senha"){



			



			$p['cpf']['valor'] = $_REQUEST['cpf'];



			$p['cpf']['tipo']  = "=";



		



			$aza = DB::listar("usuario",$p," order by id");



	



			$dados = $aza[0];



			



				



			$usuario = DB::procurar('usuario',$dados['id']);



			$emailDestino = $usuario['email'];



			$nomeDestino = $usuario['nome'];



			$html = "<h1>Sua senha e</h1>";



			$texto = "senha para acesso ao sistema ".$usuario['senha'];



					



			enviar($emailDestino,$nomeDestino,$html,$texto);



				



			$msg = "encaminharemos em instantes a senha para seu email cadastrado no sistema";



			header("location: ../view/".$_REQUEST['pagina'].".php&msg=".$msg);



			



		}



	



?>