<?php

ob_start();
@session_start();

require_once('../model/DB.php'); 	
require_once('../util/util.php'); 	


	// salvar 
	//echo "controller: ".$_REQUEST['acao'];

	if($_REQUEST['acao'] == "Salvar")	
	{


		$_REQUEST['p']['excluido'] = "N";

		if($_REQUEST['p']['data_nascimento']) {
				//$_REQUEST['p']['data_nascimento'] = convertDataMysql($_REQUEST['p']['data_nascimento']);
				
			}
			
		if($_REQUEST['p']['data']) {
				$_REQUEST['p']['data'] = convertDataMysql($_REQUEST['p']['data']);
				
			}
			
		if($_REQUEST['p']['valor']) {
				$_REQUEST['p']['valor'] = str_replace(".","",$_REQUEST['p']['valor']);
				$_REQUEST['p']['valor'] = str_replace(",",".",$_REQUEST['p']['valor']);
				
		}	
                
                //echo $_REQUEST['p']['data_nascimento'];

	//#####################################################################################################################################
	// ATUALIZA UM REGISTRO
	//#####################################################################################################################################
		
		if($_REQUEST['id']){
	
			DB::atualizar($_REQUEST['objeto'],$_REQUEST['p'],$_REQUEST['id']);					
			$msg = "ATUALIZADO COM SUCESSO";

			if($_FILES['arquivo']['name']){				

				$ext = end(explode(".",$_FILES['arquivo']['name'])); 	
				$id = $_REQUEST['id'];
				$nome = $_REQUEST['objeto']."_".$id.".".$ext;
				$dir = "../pages/fotos/".$nome;

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
			
			if($msg == "") {
			//echo "<hr>msg dentro: ".$msg; 

                            $insc = true;
                            
                            if($_REQUEST['objeto'] == 'inscricao'){
                                
                                $insc = DB::verificarInscricao($_REQUEST['p']['id_atleta'],$_REQUEST['p']['id_torneio'],$_REQUEST['p']['id_categoria']);
                            }   
                            
                            if($insc){
                               DB::salvar($_REQUEST['objeto'],$_REQUEST['p']);					
				
                               $msg = " CADASTRADO COM SUCESSO";
                            }
                            else {
                                $msg = " ERRO - INSCRICAO JA EFETUADA";
                            }


				if($_FILES['arquivo']['name']){	

					$ext = end(explode(".",$_FILES['arquivo']['name'])); 	
					$id = DB::ultimoId($_REQUEST['objeto']);
					$nome = $_REQUEST['objeto']."_".$id.".".$ext;
					$dir = "../pages/fotos/".$nome;

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
		}
		
                if($_REQUEST['pagina'])

			header("location: ../pages/".$_REQUEST['pagina'].".php?msg=".$msg."&".$_REQUEST['retorno']);	

		else
			header("location: ../pages/".$_REQUEST['objeto'].".php?msg=".$msg."&".$_REQUEST['retorno']);	

	
  }
 
?>